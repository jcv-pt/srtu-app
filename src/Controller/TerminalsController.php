<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class TerminalsController extends AppController {

    public function add() {

        //Load puppet

        $this->loadComponent('ScopePuppet');

        //Save post

        if ($this->request->is('post')) {

            $model = $this->Terminals->newEntity();
            $model = $this->Terminals->patchEntity($model, $this->request->data);

            if ($this->Terminals->save($model)) {

                $this->set('data', [
                    'state' => 'success',
                    'msg' => __('Terminal guardado com succeso.'),
                    'closeUrl' => '#/app/terminals/manage'
                ]);

                return;
            }

            $this->set('data', [
                'state' => 'error',
                'msg' => __('Terminal não pode ser guardado.'),
                'errors' => $model->errors()
            ]);

            return;
        }

        //Render view
    }

    public function manage() {

        //Just renders
    }

    public function get() {

        //Load puppet

        $this->loadComponent('ScopePuppet');

        //Get Action

        $data = $this->Terminals->find('all');

        $out = [];

        foreach ($data as $item) {
            
            $buttons =
                '<button onclick="' . $this->ScopePuppet->run(
                    'manageTerminals', 
                    'delete', 
                    $item->id
                ) . '" class="btn btn-danger">' . __('Eliminar') . '</button> ';
            
            if($item->authorized == 0)
                $buttons .=
                    '<button onclick="' . $this->ScopePuppet->run(
                        'manageTerminals', 
                        'authorization', 
                        [$item->id, 'true']
                    ) . '" class="btn btn-success">' . __('Autorizar') . '</button>';
            else
                $buttons .=
                    '<button onclick="' . $this->ScopePuppet->run(
                        'manageTerminals', 
                        'authorization', 
                        [$item->id, 'false']
                    ) . '" class="btn btn-warning">' . __('Revogar') . '</button>';
            
            $out[] = [
                $item->id,
                $item->name,
                $item->location,
                ($item->authorized == 1 ? '<font color="green">'.__('Autorizado').'</font>' : '<font color="red">'.__('Não autorizado').'</font>'),
                $item->signature,
                $buttons
            ];
        }

        $this->set('data', [
            'state' => 'success',
            'results' => $out,
        ]);

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

            $entity = $this->Terminals->get($this->request->params['pass'][1]);
            $result = $this->Terminals->delete($entity, ['cascadeCallbacks' => true]);

            $this->set('data', [
                'state' => 'success',
                'title' => __('Terminal eliminado'),
                'msg' => __('O terminal foi eliminado com sucesso.'),
                'closeLabel' => __('Fechar'),
                'closeFunction' => $this->ScopePuppet->execute(
                        "$('#terminalsTable').DataTable().ajax.reload();"
                ),
                'closeClass' => 'btn-default',
            ]);

            return;
        }
    }
    
    public function authorization() {

        //Load puppet

        $this->loadComponent('ScopePuppet');

        //Update method

        if (!is_numeric($this->request->params['pass'][0])) {
            $this->set('data', [
                'state' => 'error',
                'title' => __('ID Invalido'),
                'msg' => __('O Id não é valido'),
            ]);

            return;
        }

        $entityTable = TableRegistry::get('Terminals');
        $entity = $entityTable->get($this->request->params['pass'][0]);
        
        if($this->request->params['pass'][1]=="true")
            $entity->authorized = 1;
        else
            $entity->authorized = 0;
        
        $entityTable->save($entity);

        $this->set('data', [
            'state' => 'success',
            'title' => __('Terminal actualizado'),
            'msg' => __('O terminal foi actualizado com sucesso.'),
            'closeLabel' => __('Fechar'),
            'closeFunction' => $this->ScopePuppet->execute(
                    "$('#terminalsTable').DataTable().ajax.reload();"
            ),
            'closeClass' => 'btn-default',
        ]);

        return;

    }

}
