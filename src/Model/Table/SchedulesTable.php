<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SchedulesTable extends Table {

    public function initialize(array $config) {
		
        parent::initialize($config);

        $this->table('schedules');
        $this->displayField('schedule');
        $this->primaryKey('id');
		
        $this->belongsTo('Seasons', [
                'foreignKey' => 'season_id',
        ]);
    }

    public function validationDefault(Validator $validator) {

        $validator
            ->requirePresence('schedule', true, __('Horario não pode ser vazio.'))
            ->notBlank('schedule')
            ->add('schedule', 'validTime', [
                'rule' => function ($value, $context){

                    return (preg_match('/(2[0-3]|[01][0-9]):([0-5][0-9])/', $context['data']['schedule']) === 1 ? true : false);

                },
                'message' => 'Horário não é valido.'
            ])
            ->requirePresence('season_id', true, __('A estação tem de ser definida.'))
            ->notBlank('season_id')
            ->requirePresence('stop_id', true, __('A paragem tem de ser definida.'))
            ->notBlank('stop_id');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }

}
