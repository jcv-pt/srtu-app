<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SeasonsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('seasons');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    public function validationDefault(Validator $validator) {

        $validator
            ->requirePresence('name', true, __('Nome não pode ser vazio.'))
            ->notBlank('name')
            ->requirePresence('date_from', true, __('Data "a partir de" tem de ser defenida.'))
            ->notBlank('date_from')
            ->add('date_from',[
                'date' => [
                    'rule' => function ($value, $context){

                        $d = \DateTime::createFromFormat('Y-m-d', $context['data']['date_from']);
                        
                        return $d && $d->format('Y-m-d') === $context['data']['date_from'];

                    },
                    'message' => 'A data "de" deve estar no formato DD-MM-YYYY.',
                    'allowEmpty' => false
                ],
            ])
            ->requirePresence('date_to', true, __('Data "até" tem de ser defenida.'))
            ->notBlank('date_to')
            ->add('date_to',[
                'date' => [
                    'rule' => function ($value, $context){

                        $d = \DateTime::createFromFormat('Y-m-d', $context['data']['date_to']);
                        
                        return $d && $d->format('Y-m-d') === $context['data']['date_to'];

                    },
                    'message' => 'A data "até" deve estar no formato DD-MM-YYYY.',
                    'allowEmpty' => false
                ],
            ]);       

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }

}
