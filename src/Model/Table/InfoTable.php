<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

class InfoTable extends Table {

    public function initialize(array $config) {
		
        parent::initialize($config);

        $this->table('info');
        $this->primaryKey('id');
        
    }

    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }

}
