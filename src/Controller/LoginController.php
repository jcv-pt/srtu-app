<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class LoginController extends AppController
{
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['display','signin','isloggedin']);
    }
    
    public function display()
    {
        //Just shows
    }
    
    public function signin()
    {

        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            
            if ($user) 
            {
                
                $this->Auth->setUser($user);
                
                //Log
                
                $this->logger(
                        'success',
                        'system',
                        __('[LOGIN][AUTH] Utilizador autenticado ').'('.@$this->request->data['username'].')'
                );
                
                $this->set('request', [
                    'state' => 'success', 
                    'msg' => __('Foi autenticado com sucesso, a redirecionar...'),
                    'img' => '/img/ok.png'
                ]);
                
                return;
            }
            
        }
        
        //Log
        
        $this->logger(
                'warning',
                'system',
                __('[LOGIN][AUTH] Autenticação falhada ').'('.@$this->request->data['username'].')'
        );
                    
        //Send out
        
        $this->set('request', [
            'state' => 'error', 
            'msg' => __('Username ou password não validos.'),
            'img' => '/img/err.png'
        ]);
                    
    }

    public function signout()
    {
        
        //Load puppet
        
        $this->loadComponent('ScopePuppet');
        
        $this->Auth->logout();
                        
        $this->set('data', [
            'state' => 'success', 
            'msg' => __('A sessão foi terminada com sucesso'),
            'closeLabel' => __('Sair'),
            'closeFunction' => $this->ScopePuppet->execute(
               "window.location = \"/\";"
            ),
            'closeClass' => 'btn-primary',
        ]);

        return;
    }
    
    public function logout(){
        
        //Just renders
        
    }
    
    public function isloggedin(){
       
        if ($this->Auth->user())
            $this->set('request', [
                'state' => 'success',
            ]);
        else
            $this->set('request', [
                'state' => 'error',
            ]);

        return;
        
    }
    
    public function forcelogout(){
        
        $this->Auth->logout();
        
        $this->redirect('/');
        
    }
    
    private function logger($type, $session, $text){
        
        //Log action

        $logsTable = TableRegistry::get('Logs');
        $log = $logsTable->newEntity();

        $log->log = $text;
        $log->session = $session;
        $log->type = $type;

        $logsTable->save($log);
        
    }
    
}
