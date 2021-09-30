<?php
namespace App\Controller;

use App\Controller\AppController;

class StopsController extends AppController
{

    public function add(){
        
        //Load puppet
        
        $this->loadComponent('ScopePuppet');
        
        //Save post

        if ($this->request->is('post')) {

            $model = $this->Stops->newEntity();
            $model = $this->Stops->patchEntity($model, $this->request->data);

            //Save
            
            if ($this->Stops->save($model)) {

                $this->set('data', [
                    'state' => 'success', 
                    'msg' => __('Paragem guardada com succeso.'),
                    'closeFunction' => $this->ScopePuppet->run(
                        'stopsEdit', 
                        'afterAddStop', 
                        ''
                    ),
                    'closeLabel' => __('Fechar'),                
                ]);

               return;
                
            }
            
            $this->set('data', [
                'state' => 'error', 
                'msg' => __('Paragem não pode ser guardada.'),
                'errors' => $model->errors()
            ]);
        
            return;
        }

        //Render view
        
    }
    
    public function manage(){
        
        //Just renders
        
    }
    
    public function edit(){
        
        //Just renders
        
    }
    
    public function view(){
        
        //Just renders
        
    }
    
    public function get(){
        
        //Load puppet
        
        $this->loadComponent('ScopePuppet');
        
        //Get Action

        if($this->request->params['pass'][0]=="routes")
        {
        
            //Load model
            
            $this->loadModel("Routes");
            
            $data = $this->Routes->find('all');
            
            $out = [];

            foreach($data as $route)
            {

                $out[] = [
                    $route->name,
                    $route->number,
                    '<input type="color" value="'.$route->color.'" disabled>',
                    '<a href="#/app/stops/view/'.$route->id.'/up" class="btn btn-primary">'.__('Ver Trajecto de Ida').'</a> '.
                    '<a href="#/app/stops/view/'.$route->id.'/down" class="btn btn-primary">'.__('Ver Trajecto de Volta').'</a> '.
                    '<a href="#/app/stops/edit/'.$route->id.'" class="btn btn-primary">'.__('Gerir').'</a>'
                ];
            }

            $this->set('data', [
                'state' => 'success', 
                'results' => $out ,
            ]);

            return;
            
        }
        
        if($this->request->params['pass'][0]=="locations")
        {
        
            //Load model
            
            $data = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1]])->order('sequence');

            $out = [];

            foreach($data as $item)
            {
                
                $buttons = '<button onclick="'.$this->ScopePuppet->run(
                    'stopsEdit', 
                    'moveStop', 
                    [$item->id, 'up']
                ).'" class="btn btn-default">'.__('Para Cima').'</button> '.'<button onclick="'.$this->ScopePuppet->run(
                    'stopsEdit', 
                    'moveStop', 
                    [$item->id, 'down']
                ).'" class="btn btn-default">'.__('Para Baixo').'</button> '.'<button onclick="'.$this->ScopePuppet->run(
                    'stopsEdit', 
                    'deleteStop', 
                    $item->id
                ).'" class="btn btn-danger">'.__('Eliminar').'</button> ';

                         
                $out[] = [
                    $item->id,
                    $item->location,
                    $item->lat,
                    $item->lon,
                    $item->sequence,
                    $item->direction,
                    $buttons
                ];
            }

            $this->set('data', [
                'state' => 'success', 
                'results' => $out ,
            ]);

            return;
            
        }
        
        if($this->request->params['pass'][0]=="path")
        {
        
            //Load model
            
            $this->loadModel('Routes');
            
            $route = $this->Routes->get($this->request->params['pass'][1]);
            
            $data = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1], 'direction' => $this->request->params['pass'][2]])->order('sequence');

            $out = [];

            foreach($data as $item)
            {                         
                $out[] = [
                    $item->id,
                    $item->location,
                    $item->lat,
                    $item->lon,
                ];
            }

            $this->set('data', [
                'state' => 'success', 
                'color' => $route->color, 
                'number' => $route->number, 
                'results' => $out ,
            ]);

            return;
            
        }
 
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
                'title' => __('A eliminar uma paragem...'),
                'msg' => __('Está prestes a eliminar uma paragem, esta acção não pode ser desfeita, deseja continuar?'),
                'closeLabel' => __('Eliminar'),
                'closeFunction' => $this->ScopePuppet->run(
                    'stopsEdit', 
                    'deleteConfirmedStop', 
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
            
            $entity = $this->Stops->get($this->request->params['pass'][1]);
            $result = $this->Stops->delete($entity, ['cascadeCallbacks' => true]);

            $this->set('data', [
                'state' => 'success', 
                'title' => __('Paragem eliminada'),
                'msg' => __('A paragem foi eliminada com sucesso.'),
                'closeLabel' => __('Fechar'),
                'closeFunction' => $this->ScopePuppet->execute(
                    "$('#lineStopsTable').DataTable().ajax.reload();"
                ),
                'closeClass' => 'btn-default',
            ]);
            
            return;
            
        }
        
    }
    
    public function move(){
        
        //Load puppet
        
        $this->loadComponent('ScopePuppet');
        
        //Move stop
        
        $itemToMove = $this->Stops->find('all')->where([
            'route_id' => $this->request->params['pass'][1],
            'id' => $this->request->params['pass'][2]
        ])->first();

        if($this->request->params['pass'][0]=="up")
        {
            if($itemToMove->sequence > 0)
            {

                //Get element before this one

                $itemToMoveTo = $this->Stops->find('all')->where([
                    'route_id' => $this->request->params['pass'][1],
                    'sequence <' => $itemToMove->sequence
                ])->order('sequence desc')->first();

            }
        }

        if($this->request->params['pass'][0]=="down")
        {

            //Get last element

            $lastElement = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1]])->order('sequence desc')->first();

            if($itemToMove->sequence < $lastElement->sequence)
            {

                //Get element after this one

                $itemToMoveTo = $this->Stops->find('all')->where([
                    'route_id' => $this->request->params['pass'][1],
                    'sequence >' => $itemToMove->sequence
                ])->order('sequence')->first();

            }
        }
        
        $originalPosElement = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1]])->first();
        
        //Swap

        $this->Stops->query()
        ->update()
        ->set(['sequence' => $itemToMoveTo->sequence])
        ->where(['id' => $itemToMove->id])
        ->execute();

        $this->Stops->query()
        ->update()
        ->set(['sequence' => $originalPosElement->sequence])
        ->where(['id' => $itemToMoveTo->id])
        ->execute();

        //Report
        
        $this->set('data', [
            'state' => 'success', 
            'title' => __('Paragem movida'),
            'msg' => __('A paragem foi movida com sucesso.'),
            'closeLabel' => __('Fechar'),
            'closeFunction' => $this->ScopePuppet->execute(
                "$('#lineStopsTable').DataTable().ajax.reload();"
            ),
            'closeClass' => 'btn-default',
        ]);
        
    }
    
    
}

