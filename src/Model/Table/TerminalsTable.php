<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TerminalsTable extends Table {

    public function initialize(array $config) {
		
        parent::initialize($config);

        $this->table('terminals');
        $this->displayField('name');
        $this->primaryKey('id');
        
    }

    public function validationDefault(Validator $validator) {

        $validator
            ->requirePresence('name', true, __('Descricao não pode ser vazio.'))
            ->notBlank('name')
            ->requirePresence('location', true, __('Localização não pode ser vazio.'))
            ->notBlank('location')
            ->requirePresence('authorized', true, __('Autorização não pode ser vazio.'))
            ->notBlank('authorized');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
    
    public function beforeSave($event, $entity, $options) {
        
        //Generate signature
        
        $entity->signature = $this->generateRandomString();
        
    }
    
    private function generateRandomString($length = 25) {
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) 
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        
        return $randomString;
        
    }

}
