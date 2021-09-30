<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class LogsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('logs');
        $this->primaryKey('id');
    }

    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
    
    public function beforeSave($event, $entity, $options) {
        
        //Set fields

        $entity->url = $_SERVER['REQUEST_URI'];
        $entity->ip = $_SERVER['REMOTE_ADDR'];
        $entity->datetime = date("Y-m-d H:i:s");
        
    }
    
    public function afterSave($event, $entity, $options) {
        
        return true;
        
    }

}
