<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class MonitoringController extends AppController {
    
    public function view(){
        
        //Just renders
        
    }

    public function get() {

        //Load puppet
        
        $this->loadComponent('ScopePuppet');
        
        //Get Action

        if($this->request->params['pass'][0]=="info")
        {
        
            //Load model
            
            $this->loadModel("Logs");
            
            //---------------------  GLOBAL  -----------------------
            
            $temp = strtotime('-1 minutes');
            
            $calls = $this->Logs->find('all')->where(['datetime >=' => date('Y-m-d H:i:s',$temp)])->order('datetime');

            $callList = [];
            
            for($i=1; $i <= 60; $i++)
            {
                //Init it
                
                if(!isset($callList[$i]))
                    $callList[$i] = 0;
                
                foreach($calls as $call)
                {
                    
                    //Check if is in range
                    
                    $tmp = strtotime($call->datetime->format('Y-m-d H:i:s'));
                    
                    if($tmp==$temp)
                        $callList[$i]++;
                    
                }
                
                $temp++;
                
            }
            
            //Set data, max, cur
            
            $out['apicalls']['global']['data'] = $callList;
            $out['apicalls']['global']['max'] = max($callList);
            $out['apicalls']['global']['cur'] = end($callList);
            
            //Get Avg
            
            $total = 0;
            foreach($callList as $second)
                $total += $second;
            
            $out['apicalls']['global']['total'] = $total;
            $out['apicalls']['global']['avg'] = round($total/60);

            //---------------------  VEHICLES  -----------------------
            
            $temp = strtotime('-1 minutes');
            
            $calls = $this->Logs->find('all')->where(['datetime >=' => date('Y-m-d H:i:s',$temp), 'session' => 'vehicles'])->order('datetime');

            $callList = [];
            
            for($i=1; $i <= 60; $i++)
            {
                //Init it
                
                if(!isset($callList[$i]))
                    $callList[$i] = 0;
                
                foreach($calls as $call)
                {
                    
                    //Check if is in range
                    
                    $tmp = strtotime($call->datetime->format('Y-m-d H:i:s'));
                    
                    if($tmp==$temp)
                        $callList[$i]++;
                    
                }
                
                $temp++;
                
            }
            
            //Set data, max, cur
            
            $out['apicalls']['vehicles']['data'] = $callList;
            $out['apicalls']['vehicles']['max'] = max($callList);
            $out['apicalls']['vehicles']['cur'] = end($callList);
            
            //Get Avg
            
            $total = 0;
            foreach($callList as $second)
                $total += $second;
            
            $out['apicalls']['vehicles']['total'] = $total;
            $out['apicalls']['vehicles']['avg'] = round($total/60);
            
            //---------------------  TERMINALS  -----------------------
            
            $temp = strtotime('-1 minutes');
            
            $calls = $this->Logs->find('all')->where(['datetime >=' => date('Y-m-d H:i:s',$temp), 'session' => 'terminals'])->order('datetime');

            $callList = [];
            
            for($i=1; $i <= 60; $i++)
            {
                //Init it
                
                if(!isset($callList[$i]))
                    $callList[$i] = 0;
                
                foreach($calls as $call)
                {
                    
                    //Check if is in range
                    
                    $tmp = strtotime($call->datetime->format('Y-m-d H:i:s'));
                    
                    if($tmp==$temp)
                        $callList[$i]++;
                    
                }
                
                $temp++;
                
            }
            
            //Set data, max, cur
            
            $out['apicalls']['terminals']['data'] = $callList;
            $out['apicalls']['terminals']['max'] = max($callList);
            $out['apicalls']['terminals']['cur'] = end($callList);
            
            //Get Avg
            
            $total = 0;
            foreach($callList as $second)
                $total += $second;
            
            $out['apicalls']['terminals']['total'] = $total;
            $out['apicalls']['terminals']['avg'] = round($total/60);
            
            //---------------------  APPS  -----------------------
            
            $temp = strtotime('-1 minutes');
            
            $calls = $this->Logs->find('all')->where(['datetime >=' => date('Y-m-d H:i:s',$temp), 'session' => 'apps'])->order('datetime');

            $callList = [];
            
            for($i=1; $i <= 60; $i++)
            {
                //Init it
                
                if(!isset($callList[$i]))
                    $callList[$i] = 0;
                
                foreach($calls as $call)
                {
                    
                    //Check if is in range
                    
                    $tmp = strtotime($call->datetime->format('Y-m-d H:i:s'));
                    
                    if($tmp==$temp)
                        $callList[$i]++;
                    
                }
                
                $temp++;
                
            }
            
            //Set data, max, cur
            
            $out['apicalls']['apps']['data'] = $callList;
            $out['apicalls']['apps']['max'] = max($callList);
            $out['apicalls']['apps']['cur'] = end($callList);
            
            //Get Avg
            
            $total = 0;
            foreach($callList as $second)
                $total += $second;
            
            $out['apicalls']['apps']['total'] = $total;
            $out['apicalls']['apps']['avg'] = round($total/60);
            
            //---------------------  PIE  -----------------------
            
            $out['apicalls']['pie']['data'] = [];
            $out['apicalls']['pie']['data'][0] = @round($out['apicalls']['apps']['total']*100/$out['apicalls']['global']['total']);
            $out['apicalls']['pie']['data'][1] = @round($out['apicalls']['vehicles']['total']*100/$out['apicalls']['global']['total']);
            $out['apicalls']['pie']['data'][2] = @round($out['apicalls']['terminals']['total']*100/$out['apicalls']['global']['total']);
            
            $out['apicalls']['pie']['data'][3] = 100 - $out['apicalls']['pie']['data'][0] - $out['apicalls']['pie']['data'][1] - $out['apicalls']['pie']['data'][2];
            //Set out data
            
            $this->set('data', [
                'state' => 'success', 
                'results' => $out ,
            ]);

            return;
            
        }
        
        if($this->request->params['pass'][0]=="logs")
        {
        
            $this->loadModel('Logs');
            
            $data = $this->Logs->find('all')->where(['type' => 'info'])->order('datetime desc')->limit(100);

            $out = [];

            foreach($data as $item)
            {

                $out[] = [
                    '<i class="material-icons text-info">info_outline</i><br><small>Info</small>',
                    $item->ip,
                    $item->log,
                    $item->datetime->format('Y-m-d H:i:s'),
                ];
            }

            $this->set('data', [
                'state' => 'success', 
                'results' => $out ,
            ]);
            return;
            
        }
        
        if($this->request->params['pass'][0]=="messages")
        {
        
            $this->loadModel('Logs');
            
            $data = $this->Logs->find('all')->where(['type !=' => 'info'])->order('datetime desc')->limit(100);

            $out = [];

            foreach($data as $item)
            {

                $out[] = [
                    '<div align="center">'.($item->type == "error" ? '<i class="material-icons text-danger">info</i><br><small>Warning</small>' : ( $item->type == "success" ? '<i class="material-icons text-success">info_outline</i><br><small>Success</small>' : '<i class="material-icons text-warning">info_outline</i><br><small>Warning</small>')).'</div>',
                    $item->ip,
                    $item->log,
                    $this->time_elapsed_string($item->datetime).'<br>'.
                    '<small>'.$item->datetime->format('Y-m-d H:i:s').'</small>'
                ];
            }

            $this->set('data', [
                'state' => 'success', 
                'results' => $out ,
            ]);
            return;
            
        }
    }

    private function time_elapsed_string($datetime, $full = false) {
        
        $now = new \DateTime;
        $ago = $datetime;
        
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => __('ano'),
            'm' => __('mes'),
            'w' => __('semana'),
            'd' => __('dia'),
            'h' => __('hora'),
            'i' => __('minuto'),
            's' => __('segundo'),
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . __(' atrás') : __('agora mesmo');
    }

}