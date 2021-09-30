<?php

namespace App\Controller;

use Cake\Event\Event;

class ThemeController extends AppController
{
    
    public function initialize() {
        
        parent::initialize();
        
        $this->Auth->allow('display');
        
    }
    
    public function display()
    {
        //Just shows
    }
    
    public function footer()
    {
        //Just shows
    }
    
    public function leftbar()
    {
        //Get user info
        
        $this->loadModel("Users");
        
        $userData = $this->Users->get($this->Auth->user('id'));
        
        $this->set('userData', $userData);
        
    }
    
    public function topbar()
    {
        //Just shows
    }
    
    public function nav()
    {
        //Just shows
    }
    
    public function app()
    {
        //Just shows
    }
    
}
