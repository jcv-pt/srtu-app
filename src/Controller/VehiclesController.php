<?php

namespace App\Controller;

use App\Controller\AppController;

class VehiclesController extends AppController {

    public function add() {

        //Load puppet

        $this->loadComponent('ScopePuppet');

        //Save post

        if ($this->request->is('post')) {

            $model = $this->Vehicles->newEntity();
            $model = $this->Vehicles->patchEntity($model, $this->request->data);

            if ($this->Vehicles->save($model)) {

                $this->set('data', [
                    'state' => 'success',
                    'msg' => __('Veiculo guardado com succeso.'),
                    'closeUrl' => '#/app/vehicles/manage'
                ]);

                return;
            }

            $this->set('data', [
                'state' => 'error',
                'msg' => __('Veiculo não pode ser guardado.'),
                'errors' => $model->errors()
            ]);

            return;
        }

        //Render view
    }

    public function manage() {

        //Just renders
    }

    public function position(){
        
        //Just renders
        
    }
    
    public function get() {

        //Get Action
        
        if($this->request->params['pass'][0]=="list"){
        
            //Load puppet

            $this->loadComponent('ScopePuppet');

            //Get Action

            $data = $this->Vehicles->find('all');

            $out = [];

            foreach ($data as $item) {
                $out[] = [
                    $item->id,
                    $item->name,
                    $item->plate,
                    $item->signature,
                    '<a href="#/app/vehicles/position/'.$item->id.'" class="btn btn-primary">'.__('Ver Posição do Veiculo').'</a> '.
                    '<button onclick="' . $this->ScopePuppet->run(
                        'manageVehicles', 
                        'delete', 
                        $item->id
                    ) . '" class="btn btn-danger">' . __('Eliminar') . '</button>'
                ];
            }

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        
        }
        
        if($this->request->params['pass'][0]=="location"){
             
            $this->LoadModel('Locations');
        
            $data = $this->Locations->find('all')->where(['id_vehicle' => $this->request->params['pass'][1]])->first();

            $out = [];

            if(isset($data->id_vehicle))
                $out = [
                    'id' => $data->id_vehicle,
                    'lat' => $data->lat,
                    'lon' => $data->lon,
                    'route' => $data->route,
                    'direction' => $data->direction,
                    'speed' => $data->speed
                ];

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        }
        
        if($this->request->params['pass'][0]=="info"){
        
            $data = $this->Vehicles->find('all')->where(['id' => $this->request->params['pass'][1]])->first();

            $out = [];

            if(isset($data->id))
                $out = [
                    'id' => $data->id,
                    'name' => $data->name,
                    'plate' => $data->plate,
                ];

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        }

        return;
    }

    public function delete() {

        //Load puppet

        $this->loadComponent('ScopePuppet');

        if ($this->request->params['pass'][0] == "do") {

            //Delete method

            if (!is_numeric($this->request->params['pass'][1])) {
                $this->set('data', [
                    'state' => 'error',
                    'title' => __('ID Invalido'),
                    'msg' => __('O Id não é valido'),
                ]);

                return;
            }

            $entity = $this->Vehicles->get($this->request->params['pass'][1]);
            $result = $this->Vehicles->delete($entity, ['cascadeCallbacks' => true]);

            $this->set('data', [
                'state' => 'success',
                'title' => __('Veiculo eliminado'),
                'msg' => __('O veiculo foi eliminado com sucesso.'),
                'closeLabel' => __('Fechar'),
                'closeFunction' => $this->ScopePuppet->execute(
                        "$('#vehiclesTable').DataTable().ajax.reload();"
                ),
                'closeClass' => 'btn-default',
            ]);

            return;
        }
    }

}
