<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class DashboardController extends AppController
{
    public function initialize() {
        
        parent::initialize();
        
    }
    
    public function display()
    {
        //Just shows
    }
	
	public function get(){
		
		//Get Information

        if($this->request->params['pass'][0]=="info"){
			
			
			//Load models
			
			$this->loadModel('Stops');
			$this->loadModel('Vehicles');
			$this->loadModel('Routes');
			$this->loadModel('Terminals');
			
			//Set info
			
			$out = [];
			
			$out['no_stops'] = $this->Stops->find('all')->count();
			$out['no_vehicles'] = $this->Vehicles->find('all')->count();
			$out['no_routes'] = $this->Routes->find('all')->count();
			$out['no_terminals'] = $this->Terminals->find('all')->count();
			
			$this->set('data', [
                'state' => 'success', 
                'results' => $out ,
            ]);
			
			
		}
		
		
	}
    
}
