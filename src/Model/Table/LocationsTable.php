<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class LocationsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('locations');
        $this->primaryKey('id_vehicle');
    }

    public function validationDefault(Validator $validator) {

        $validator
            ->requirePresence('id_vehicle', true, __('ID veiculo tem de ser definido.'))
            ->notBlank('id_vehicle')
            ->requirePresence('datetime', true, __('Datetime tem de ser definida.'))
            ->notBlank('datetime')
            ->requirePresence('lat', true, __('Latitude não pode ser vazia.'))
            ->notBlank('lat')
            ->requirePresence('lon', true, __('Longitude não pode ser vazia.'))
            ->notBlank('lon')
            ->requirePresence('route', true, __('Route não pode ser vazio.'))
            ->notBlank('route')
            ->requirePresence('direction', true, __('Direction não pode ser vazio.'))
            ->notBlank('direction')
            ->requirePresence('signature', true, __('Signature não pode ser vazia.'))
            ->notBlank('signature')
            ->add('signature',[
                'signature' => [
                    'rule' => function($value, $context){
                
                        //Load vehicles
                
                        $this->loadModel('Vehicles');
                
                        //Lookup signature
                
                        $howMany = $this->Vehicles->find('all')->where(['signature' => $value])->count();
                        
                        if($howMany != 1)
                            return false;
                        
                        return true;
                
                    },
                    'message' => __('A direcçao não e valida.')
                ],
            ]);

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->isUnique(['id_vehicle']));

        return $rules;
    }
    
    public function beforeSave($event, $entity, $options) {
        
        //Set datetime
        
        $entity->datetime = date('Y-m-d H:i:s');
        
    }

}
