<?php
namespace App\Controller;

use App\Controller\AppController;

class SeasonsController extends AppController
{

    public function add(){
        
        //Save post
        
        if ($this->request->is('post')) {

            $model = $this->Seasons->newEntity();
            $model = $this->Seasons->patchEntity($model, $this->request->data);

            if ($this->Seasons->save($model)) {

                $this->set('data', [
                    'state' => 'success', 
                    'msg' => __('Estação guardada com succeso.'),
                    'closeUrl' => '#/app/seasons/manage'
                ]);

               return;
                
            }
           
            $this->set('data', [
                'state' => 'error', 
                'msg' => __('Estação não pode ser guardada.'),
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

        $data = $this->Seasons->find('all');
		
        $out = [];

        foreach($data as $item)
        {

            $out[] = [
                '#'.$item->id,
                $item->name,
                $item->date_from->format('Y-m-d'),
                $item->date_to->format('Y-m-d'),
                '<button onclick="'.$this->ScopePuppet->run(
                    'view', 
                    'delete', 
                    $item->id
                ).'" class="btn btn-danger">'.__('Eliminar').'</button>'
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
                'title' => __('A eliminar uma estação...'),
                'msg' => __('Está prestes a eliminar uma estação, esta acção não pode ser desfeita, deseja continuar?'),
                'closeLabel' => __('Eliminar'),
                'closeFunction' => $this->ScopePuppet->run(
                    'view', 
                    'deleteConfirmed', 
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
            
            $entity = $this->Seasons->get($this->request->params['pass'][1]);
            $result = $this->Seasons->delete($entity, ['cascadeCallbacks' => true]);

            $this->set('data', [
                'state' => 'success', 
                'title' => __('Estação eliminada'),
                'msg' => __('A estação foi eliminada com sucesso.'),
                'closeLabel' => __('Fechar'),
                'closeFunction' => $this->ScopePuppet->execute(
                    "$('#seasonsTable').DataTable().ajax.reload();"
                ),
                'closeClass' => 'btn-default',
            ]);
            
            return;
            
        }
        
    }
    
    
}

