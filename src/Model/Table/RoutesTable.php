<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RoutesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('routes');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    public function validationDefault(Validator $validator) {

        $validator
            ->requirePresence('number', true, __('Numero não pode ser vazio.'))
            ->notBlank('number')
            ->add('number',[
                'numeric' => [
                    'rule' => ['numeric'],
                    'message' => __('Numero não e um numero.')
                ],
            ])
            ->add('number', 'uniqueLine', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'O numero de linha tem de ser unico', 
            ])
            ->requirePresence('name', true, __('O nome tem de ser definido.'))
            ->notBlank('name')
            ->requirePresence('color', true, __('A cor tem de ser defenida.'))
            ->notBlank('color')
            ->add('color', 'validHex', [
                'rule' => function ($value, $context){

                    return (preg_match('/^#[a-f0-9]{6}$/i', $context['data']['color']) === 1 ? true : false);

                },
                'message' => 'Cor não é um hex valido.'
            ]);

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->isUnique(['id']));
        
        $rules->add($rules->isUnique(['number']));

        return $rules;
    }

}
