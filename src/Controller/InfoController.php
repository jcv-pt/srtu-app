<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class InfoController extends AppController {

    public function edit() {

        //Update method

        if ($this->request->is('post')) {

            $entityTable = TableRegistry::get('Info');
            $entity = $entityTable->get(1);

            $entity->html = $this->request->data["html"];

            $entityTable->save($entity);

            $this->set('data', [
                'state' => 'success',
                'title' => __('Info actualizada'),
                'msg' => __('As informações uteis foram actualizadas com sucesso.'),
            ]);

            return;
        }
        
        //Get html
        
        $entity = $this->Info->find('all')->where(['id' => 1])->first();
        
        $this->set('html', $entity->html);
        
    }

}
