<?php

namespace App\Controller;

use App\Controller\AppController;

class SchedulesController extends AppController {

    public function add() {

        //Load puppet

        $this->loadComponent('ScopePuppet');

        //Save post

        if ($this->request->is('post')) {

            //Bind stop

            $this->request->data['stop_id'] = $this->request->params['pass'][0];

            $model = $this->Schedules->newEntity();
            $model = $this->Schedules->patchEntity($model, $this->request->data);

            if ($this->Schedules->save($model)) {

                $this->set('data', [
                    'state' => 'success',
                    'msg' => __('Horario guardado com succeso.'),
                    'closeLabel' => __('Fechar'),
                    'closeFunction' => $this->ScopePuppet->run(
                            'manageSchedules', 'afterPostData', ''
                    ),
                    'closeClass' => 'btn-default',
                ]);

                return;
            }

            $this->set('data', [
                'state' => 'error',
                'msg' => __('Horario não pode ser guardado.'),
                'errors' => $model->errors()
            ]);

            return;
        }

        //Render view
    }

    public function manage() {

        //Just renders

        if (@$this->request->params['pass'][0] == "route")
            $this->render('manage_route');

        if (@$this->request->params['pass'][0] == "stop") {

            //Set Seasons

            $this->loadModel('Seasons');

            $seasons = $this->Seasons->find('all');

            $this->set(compact('seasons'));

            //Set layout

            $this->render('manage_stop');
        }
    }

    public function get() {

        //Load puppet

        $this->loadComponent('ScopePuppet');

        //Get Action

        if ($this->request->params['pass'][0] == "routes") {

            $this->loadModel("Routes");

            $data = $this->Routes->find('all');

            $out = [];

            foreach ($data as $route) {

                $out[] = [
                    '#' . $route->id,
                    $route->name,
                    $route->number,
                    '<input type="color" value="' . $route->color . '" disabled>',
                    '<a href="#/app/schedules/manage/' . $route->id . '" class="btn btn-primary">' . __('Gerir') . '</a>'
                ];
            }

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        }

        if ($this->request->params['pass'][0] == "stops") {

            $this->loadModel("Stops");

            $data = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1]])->order('sequence');

            $out = [];

            foreach ($data as $item) {
                $out[] = [
                    $item->id,
                    $item->location,
                    $item->sequence,
                    $item->direction,
                    '<a href="#/app/schedules/manage/' . $item->route_id . '/' . $item->id . '" class="btn btn-primary">' . __('Gerir') . '</a>'
                ];
            }

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        }

        if ($this->request->params['pass'][0] == "schedules") {

            $data = $this->Schedules->find('all')->where(['stop_id' => $this->request->params['pass'][1]])->contain('Seasons')->order('schedule');

            $out = [];

            foreach ($data as $item) {
                $out[] = [
                    $item->id,
                    $item->schedule->format('H:i'),
                    $item->season->name,
                    '<button onclick="' . $this->ScopePuppet->run(
                            'manageSchedules', 'delete', $item->id
                    ) . '" class="btn btn-danger">' . __('Eliminar') . '</button>'
                ];
            }

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

            $entity = $this->Schedules->get($this->request->params['pass'][1]);
            $result = $this->Schedules->delete($entity, ['cascadeCallbacks' => true]);

            $this->set('data', [
                'state' => 'success',
                'title' => __('Horario eliminado'),
                'msg' => __('O horario foi eliminado com sucesso.'),
                'closeLabel' => __('Fechar'),
                'closeFunction' => $this->ScopePuppet->execute(
                        "$('#schedulesTable').DataTable().ajax.reload();"
                ),
                'closeClass' => 'btn-default',
            ]);

            return;
        }
    }

}
