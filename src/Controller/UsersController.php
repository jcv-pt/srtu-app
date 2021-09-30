<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
    public function initialize() {
        
        parent::initialize();
    
        $this->Auth->allow(['add', 'login']);
                
    }
    
    public function add()
    {
        $user = $this->Users->newEntity();

        $data = ['id' => 1, 'username' => 'admin', 'password' => 'admin', 'created' => date("Y-m-d")];
        
        $user = $this->Users->patchEntity($user, $data);
        if ($this->Users->save($user)) {
            die("Saved!");
        }
  
        die("Error");
    }
    
    public function login(){
        
        $this->redirect('/');
        
    }

}
