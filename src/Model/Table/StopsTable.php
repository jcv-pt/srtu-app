<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class StopsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('stops');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    public function validationDefault(Validator $validator) {

        $validator
            ->requirePresence('location', true, __('A localizaçao tem de ser definida.'))
            ->notBlank('location')
            ->requirePresence('lat', true, __('Latitude não pode ser vazia.'))
            ->notBlank('lat')
            ->requirePresence('lon', true, __('Longitude não pode ser vazia.'))
            ->notBlank('lon')
            ->requirePresence('direction', true, __('Direcção não pode ser vazia.'))
            ->notBlank('direction')
            ->add('direction',[
                'direction' => [
                    'rule' => ['inList', ['down','up']],
                    'message' => __('A direcçao não e valida.')
                ],
            ])
            ->requirePresence('sequence', true, __('A ordem de ser definida.'))
            ->notBlank('sequence')
            ->add('sequence',[
                'numeric' => [
                    'rule' => ['numeric'],
                    'message' => __('Ordem não e um numero.')
                ],
            ])
            ->requirePresence('route_id', true, __('Route ID tem de ser definida.'))
            ->notBlank('route_id')
            ->add('route_id',[
                'numeric' => [
                    'rule' => ['numeric'],
                    'message' => __('Route ID não e um numero.')
                ],
            ]);

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->isUnique(['id']));
        
        $rules->add($rules->isUnique(['number']));

        return $rules;
    }
    
    public function beforeSave($event, $entity, $options) {
        
        //Check order
        
        if($entity->seq_ref!="")
        {
            
            $record = $this->find('all')->where(['route_id' => $entity->route_id])->order('sequence desc')->first();
            
            if(isset($record->id))
            {
                if($entity->seq_ref=="top")
                    $entity->sequence = 0;
                
                if($entity->seq_ref=="bottom")
                    $entity->sequence = $record->sequence+1;
            }
            
        }
        
    }
    
    public function afterSave($event, $entity, $options) {
        
        //Check order
        
        $items = $this->find('all')->where(['route_id' => $entity->route_id, 'direction' => $entity->direction ])->order('sequence, id');
        
        $count = 1;
        
        foreach($items as $item)
        {
            
            $this->query()
            ->update()
            ->set(['sequence' => $count])
            ->where(['id' => $item->id])
            ->execute();
            
            $count++;
            
        }
        
        return true;
        
    }

}
