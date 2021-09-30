<?php
namespace App\Controller;

use App\Controller\AppController;

class RoutesController extends AppController
{

    public function add(){
        
        //Save post
        
        if ($this->request->is('post')) {

            $model = $this->Routes->newEntity();
            $model = $this->Routes->patchEntity($model, $this->request->data);

            if ($this->Routes->save($model)) {

                $this->set('data', [
                    'state' => 'success', 
                    'msg' => __('Rota guardada com succeso.'),
                    'closeUrl' => '#/app/routes/manage'
                ]);

               return;
                
            }
           
            $this->set('data', [
                'state' => 'error', 
                'msg' => __('Rota não pode ser guardada.'),
                'errors' => $model->errors()
            ]);
        
            return;
        }

        //Render view
        
    }
    
    public function manage(){
        
        //Just renders
        
    }
    
    public function get(){
        
        //Load puppet
        
        $this->loadComponent('ScopePuppet');
        
        //Get Action

        $data = $this->Routes->find('all');
		
        $out = [];

        foreach($data as $route)
        {

            $out[] = [
                '#'.$route->id,
                $route->name,
                $route->number,
                '<input type="color" value="'.$route->color.'" disabled>',
                '<button onclick="'.$this->ScopePuppet->run(
                    'routesView', 
                    'deleteRoute', 
                    $route->id
                ).'" class="btn btn-danger">'.__('Eliminar').'</button> '
            ];
        }

        $this->set('data', [
            'state' => 'success', 
            'results' => $out ,
        ]);

        return;
        
    }
    
    public function delete(){
        
        //Load puppet
        
        $this->loadComponent('ScopePuppet');
        
        //Check if is confirm
        
        if($this->request->params['pass'][0]=="confirm")
        {
            
            //Send confirm dialog
            
            $this->set('data', [
                'state' => 'confirm', 
                'title' => __('A eliminar uma linha...'),
                'msg' => __('Está prestes a eliminar uma linha, esta acção não pode ser desfeita, deseja continuar?'),
                'closeLabel' => __('Eliminar'),
                'closeFunction' => $this->ScopePuppet->run(
                    'routesView', 
                    'deleteConfirmedRoute', 
                    $this->request->params['pass'][1]
                ),
                'closeClass' => 'btn-danger',
            ]);
            
            return;
            
        }
        
        if($this->request->params['pass'][0]=="do")
        {
            
            //Delete method
            
            if(!is_numeric($this->request->params['pass'][1]))
            {
                $this->set('data', [
                    'state' => 'error', 
                    'title' => __('ID Invalido'),
                    'msg' => __('O Id não é valido'),
                ]);
                
                return;
            }
            
            $entity = $this->Routes->get($this->request->params['pass'][1]);
            $result = $this->Routes->delete($entity, ['cascadeCallbacks' => true]);

            $this->set('data', [
                'state' => 'success', 
                'title' => __('Linha eliminada'),
                'msg' => __('A linha foi eliminada com sucesso.'),
                'closeLabel' => __('Fechar'),
                'closeFunction' => $this->ScopePuppet->execute(
                    "$('#routesTable').DataTable().ajax.reload();"
                ),
                'closeClass' => 'btn-default',
            ]);
            
            return;
            
        }
        
    }
    
    
}

