<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class HandlerController extends AppController {
    
    public function initialize() {
        
        parent::initialize();
        
        $this->Auth->allow(['get','put', 'test']);
        
        //Force json :)
        
        $this->RequestHandler->renderAs($this, 'json');
        
    }

    public function get() {
        
        //Set cors
        
        $this->response->header('Access-Control-Allow-Origin', '*');

        //Get method

        if (@$this->request->params['pass'][0]=="routes") {

            //Get routes
            
            $this->loadModel('Routes');

            $data = $this->Routes->find('all');

            $out = [];

            foreach($data as $route)
            {
                $out[] = [
                    $route->id,
                    $route->name,
                    $route->number,
                    $route->color
                ];
            }
            
            //Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][ROUTES]').' Querying routes'
            );

            $this->set('data', [
                'state' => 'success', 
                'results' => $out ,
            ]);

            return;
        }
        
        if (@$this->request->params['pass'][0]=="info") {

            //Get routes
            
            $this->loadModel('Info');
        
            $entity = $this->Info->find('all')->where(['id' => 1])->first();
            
            //Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][INFO]').' Querying info'
            );

            $this->set('data', [
                'state' => 'success', 
                'results' => $entity->html ,
            ]);

            return;
         
        }
		
		if (@$this->request->params['pass'][0] == "schedules") {

            $this->loadModel("Stops");
			$this->loadModel("Seasons");
			$this->loadModel("Schedules");
			
			//Get current season_id
			
			$data = $this->Seasons->find('all')->where(['id' => 5])->first();

			$seasonId = $data->id;
			
			//Grab down list

            $data = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1], 'direction' => 'down'])->order('sequence');
			
			foreach($data as $stop)
			{
				$nextSchedule = $this->Schedules->find('all')->where(['season_id' => $seasonId, 'stop_id' => $stop->id, 'schedule >' => date('H:i:s') ])->first();
				
				$stop = [
					'id' => $stop->id,
					'destination' => $stop->location,
					'time' => '---'
				];
				
				if(isset($nextSchedule->id))
					$stop['time'] = $nextSchedule->schedule->format('H:i');
				
				$stopsListDown[] = $stop;
			}
				
			//Grab up list in reverse order

            $data = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1], 'direction' => 'up'])->order('sequence');

			foreach($data as $stop)
			{
				$nextSchedule = $this->Schedules->find('all')->where(['season_id' => $seasonId, 'stop_id' => $stop->id, 'schedule >' => date('H:i:s') ])->first();
				
				$stop = [
					'id' => $stop->id,
					'destination' => $stop->location,
					'time' => '---'
				];
				
				if(isset($nextSchedule->id))
					$stop['time'] = $nextSchedule->schedule->format('H:i');
				
				$stopsListUp[] = $stop;
			}

            $out = [];
			
			$out['schedules'] = ['down' => $stopsListDown , 'up' => $stopsListUp];
			//$out['info'] = ['firstStop' => 'Vai de CIma - Baixo'];
			
			//Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][SCHEDULES]').' Querying schedules'
            );

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        }
		
		if (@$this->request->params['pass'][0] == "schedulesAll") {

            $this->loadModel("Stops");
			$this->loadModel("Seasons");
			$this->loadModel("Schedules");
			
			//Get current season_id
			
			$data = $this->Seasons->find('all')->where(['date_from <= ' => date("Y-m-d"), 'date_to >= ' => date("Y-m-d")])->first();

			$seasonId = $data->id;
			
			//Grab down list

            $data = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1], 'direction' => 'down'])->order('sequence');
			
			foreach($data as $stop)
			{
				$schedules = $this->Schedules->find('all')->where(['season_id' => $seasonId, 'stop_id' => $stop->id]);
				
				$sch = [];
				
				foreach($schedules as $schedule)
					$sch[] = $schedule->schedule->format('H:i');
				
				$stop = [
					'id' => $stop->id,
					'destination' => $stop->location,
					'schedules' => $sch
				];

				$stops['down'][] = $stop;
			}
				
			//Grab up list in reverse order

            $data = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1], 'direction' => 'up'])->order('sequence');

			foreach($data as $stop)
			{
				$schedules = $this->Schedules->find('all')->where(['season_id' => $seasonId, 'stop_id' => $stop->id]);
				
				$sch = [];
				
				foreach($schedules as $schedule)
					$sch[] = $schedule->schedule->format('H:i');
				
				$stop = [
					'id' => $stop->id,
					'destination' => $stop->location,
					'schedules' => $sch
				];

				$stops['up'][] = $stop;
			}

            $out = $stops;
			
			//Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][SCHEDULESALL]').' Querying all schedules'
            );

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        }
		
		if (@$this->request->params['pass'][0] == "schedulesItem") {

            $this->loadModel("Stops");
			$this->loadModel("Seasons");
			$this->loadModel("Schedules");
			
			//Get current season_id
			
			$data = $this->Seasons->find('all')->where(['id' => 5])->first();

			$seasonId = $data->id;
			
			//Grab down list

            $stop = $this->Stops->find('all')->where(['id' => $this->request->params['pass'][1] ])->order('sequence')->first();

			$schedules = $this->Schedules->find('all')->where(['season_id' => $seasonId, 'stop_id' => $stop->id]);
			
			$sch = [];
			
			foreach($schedules as $schedule)
			{
				
				$now = new \DateTime();

				if(strtotime($schedule->schedule->format('H:i')) < strtotime(date('H:i')) )
					$future_date = new \DateTime(date('Y-m-d H:i', strtotime($schedule->schedule->format('Y-m-d H:i').' +1 days')));
				else
					$future_date = new \DateTime($schedule->schedule->format('H:i'));
				
				$interval = $future_date->diff($now);
				
				if($interval->format("%d") >= 1)
					$timeLeft = $interval->format("%d [days], %h [hours], %i [minutes]");
				else if($interval->format("%h") >= 1)
					$timeLeft = $interval->format("%h [hours], %i [minutes]");
				else
					$timeLeft = $interval->format("%i [minutes]");
				
				$sch[] = ['time' => $schedule->schedule->format('H:i'), 'next' => $timeLeft];
			}
			
			$out = [
				'id' => $stop->id,
				'destination' => $stop->location,
				'schedules' => $sch
			];
			
			//Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][SCHEDULESITEM]').' Querying item from schedules'
            );

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        }
		
		if (@$this->request->params['pass'][0] == "nearestArrivals") {

            $this->loadModel("Stops");
			$this->loadModel("Routes");
			$this->loadModel("Schedules");
			
			//Get GPS user position
			
			$userPos = [
				$this->request->params['pass'][1],
				$this->request->params['pass'][2]
			];
			
			//Grab routes list
			
			$routes = $this->Routes->find('all');
			
			foreach($routes as $route)
				$routesList[$route->id] = [
					'name' => $route->name,
					'number' => $route->number,
					'id' => $route->id,
					'color' => $route->color
				];
			
			//Grab stops list

            $stops = $this->Stops->find('all');
			
			$stopsCoordinates = [];

			foreach($stops as $stop)				
				$stopsCoordinates[$stop->id] = [
					$stop->location,
					$stop->direction,
					$stop->route_id,
					$stop->lat,
					$stop->lon,
				];
			
			//Sort them acordingly
			
			$distances = array_map(function($item) use($userPos) {
				$a = array_slice($item, -2);
				return $this->distance($a, $userPos);
			}, $stopsCoordinates);

			asort($distances);
			
			//We have stuff, iterate and build out var
			
			$distances = array_slice($distances, 0, 5, true);

			$now = new \DateTime();
			
			foreach($distances as $key => $distance)
			{
				
				$schedules = $this->Schedules->find('all')->where(['stop_id' => $stop->id]);
				
				foreach($schedules as $schedule)
				{
					
					if(strtotime($schedule->schedule->format('H:i')) < strtotime(date('H:i')) )
						$future_date = new \DateTime(date('Y-m-d H:i', strtotime($schedule->schedule->format('Y-m-d H:i').' +1 days')));
					else
						$future_date = new \DateTime($schedule->schedule->format('H:i'));
					
					$interval = $future_date->diff($now);
					
					if($interval->format("%d") >= 1)
						$timeLeft = $interval->format("%d [days], %h [hours], %i [minutes]");
					else if($interval->format("%h") >= 1)
						$timeLeft = $interval->format("%h [hours], %i [minutes]");
					else
						$timeLeft = $interval->format("%i [minutes]");
					
					$sch[] = ['time' => $schedule->schedule->format('H:i'), 'next' => $timeLeft, 'timestamp' => date_create('@0')->add($interval)->getTimestamp() ];
				
				}
				
				usort($sch, function($a, $b) {
					return $a['timestamp'] - $b['timestamp'];
				});
				
				$sch = array_slice(array_reverse($sch),0,2, true);
				
				$out[] = [
					'id' => $key,
					'name' => $stopsCoordinates[$key][0],
					'direction' => $stopsCoordinates[$key][1],
					'distance' => ($distance >= 1 ? round($distance,2)." Kms" : substr($distance*1000,0,3)." Mts"),
					'schedules' => $sch,
					'route' => $routesList[$stopsCoordinates[$key][2]]
				
				];
				
			}
			
			//Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][NEARESTARRIVALS]').' Querying nearest arrivals'
            );

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
        }
		
		if (@$this->request->params['pass'][0] == "stopCoordinates") {

            $this->loadModel("Stops");
			$this->loadModel("Routes");

			//Get stop
			
			$stop = $this->Stops->find('all')->where(['id' => $this->request->params['pass'][1]])->first();

			//Get Routes
			
			$route = $this->Routes->find('all')->where(['id' => $stop->route_id])->first();
			
			$out = [
				'location' => $stop->location,
				'lat' => $stop->lat,
				'lon' => $stop->lon,
				'direction' => $stop->direction,
				'route' => [
					'name' => $route->name,
					'number' => $route->number,
					'color' => $route->color
				]
			];
			
			//Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][STOPCOORDINATES]').' Querying stop coords'
            );

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
			
        }
		
		if (@$this->request->params['pass'][0] == "getLineCoordinates") {

            $this->loadModel("Stops");
			$this->loadModel("Locations");
			$this->loadModel("Vehicles");

			//Get stop
			
			$stop = $this->Stops->find('all')->where(['id' => $this->request->params['pass'][1]])->first();

			//Get Locations
			
			$location = $this->Locations->find('all')->where(['route' => $stop->route_id])->first();
			
			$out = [];
			
			if($location)
			{
			
				//Get vehicle
				
				$vehicle = $this->Vehicles->find('all')->where(['id' => $location->id_vehicle])->first();
				
				$out = [
					'id_vehicle' => $vehicle->id,
					'name' => $vehicle->name,
					'lat' => $location->lat,
					'lon' => $location->lon,
					'direction' => $location->direction,
				];
			
			}
			
			//Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][GETLINECOORDINATES]').' Querying vehicle coords'
            );

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
			
        }
		
		if (@$this->request->params['pass'][0] == "getAddressCoordinates") {
			
			//Ask google :)
			
			$address = urlencode($this->request->params['pass'][1]);
			$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
			$response = file_get_contents($url);
			$json = json_decode($response,true);

			$out = [];

			foreach($json['results'] as $location)
			{
					
				$out[] = [
					'name' => $location['formatted_address'],
					'lat' => $location['geometry']['location']['lat'],
					'lon' => $location['geometry']['location']['lng'],
				];
				
			}
			
			//Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][GETADDRESSCOORDINATES]').' Querying address coords'
            );

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
			
        }
		
		if (@$this->request->params['pass'][0] == "getLineStops") {

            $this->loadModel("Stops");
			$this->loadModel("Locations");
			
			//Get vehicle
			
			$location = $this->Locations->find('all')->where(['route' => $this->request->params['pass'][1]])->first();

			//Get stop
			
			$stops = $this->Stops->find('all')->where(['route_id' => $this->request->params['pass'][1], 'direction' => (@$location->direction == "up" ? "up" : "down") ])->order('sequence');
			
			$out = [];
			
			foreach($stops as $stop)
			{
				
				$out[] = [
					'location' => $stop->location,
					'lat' => $stop->lat,
					'lon' => $stop->lon,
				];
			
			}
			
			//Log
            
            $this->logger(
                'info',
                'apps',
                __('[API][GET][GETLINESTOPS]').' Querying line stops'
            );

            $this->set('data', [
                'state' => 'success',
                'results' => $out,
            ]);
			
        }
        
    }
    
    public function put(){

        //Get method

        if (@$this->request->params['pass'][0]=="coordinates") {
            
            //Check for id
            
            if($this->request->query('vehicle')=="")
            {
                
                $this->set('data', [
                    'state' => 'error',
                    'msg' => __('ID do veiculo não pode ser nulo'),
                ]);

                return;
            }
            
            //Get route
            
            $this->loadModel('Routes');
            
            $route = $this->Routes->find('all')->where(['number' => $this->request->query('route') ])->first();

            //Update action
            
            $itemTable = TableRegistry::get('Locations');
            
            //Check if exists
            
            $exists = $itemTable->exists(['id_vehicle' => $this->request->query('vehicle')]);
            
            if($exists)
                $item = $itemTable->get($this->request->query('vehicle'));
            else
                $item = $itemTable->newEntity();

            $item->id_vehicle = $this->request->query('vehicle');
            $item->lat = $this->request->query('lat');
            $item->lon = $this->request->query('lon');
            $item->route = $route->id;
            $item->direction = $this->request->query('direction');
            $item->speed = $this->request->query('speed');
            $item->signature = $this->request->query('signature');
            
            $status = $itemTable->save($item);
            
            //Log
            
            $this->logger(
                'info',
                'vehicles',
                __('[API][PUT][Coords]').' Vehicle: '.$this->request->query('vehicle').' - '.$this->request->query('lat').':'.$this->request->query('lon')
            );
            
            //Send out
            
            if(!$status)
            {
                
                $this->set('data', [
                    'state' => 'success',
                    'msg' => __('Coordenadas actualizadas'),
                    'errors' => $itemTable->errors()
                ]);

                return;
            }
            
            $this->set('data', [
                'state' => 'success',
                'msg' => __('Coordenadas actualizadas'),
            ]);
                        
            return;
        }
        
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
	
	private function distance($a, $b)
	{
		
		list($lat1, $lon1) = $a;
		list($lat2, $lon2) = $b;

		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$kms = $dist * 60 * 1.1515 * 1.60934;
		
		return $kms;
		
	}
    
    public function test(){

        /*
        
        $this->loadModel("Stops");
        
        $stops = $this->Stops->find('all')->where(['direction' => 'up', 'route_id' => 6])->order('sequence');

        $count = 1;
        
        foreach($stops as $stop)
        {

            $this->Stops->query()
            ->update()
            ->set(['sequence' => $count])
            ->where(['id' => $stop->id])
            ->execute();
            
            $count++;
            
        }*/

        
        /*
        $conn = ConnectionManager::get('default');
        
        $stmt = $conn->execute('select distinct stop_id from schedules where stop_id > 1 and stop_id != 36 ;');
        $results = $stmt ->fetchAll('assoc');
        
        $this->loadModel('Schedules');
        
        $this->loadModel('Stops');
        
        $stops = $this->Stops->find('all');
        
        foreach($stops as $stop)
        {   
            $stoppers[$stop->id] = $stop;
        }
        *//*
        $this->loadModel('Schedules');
        $this->loadModel('Stops');

        $results = $this->Stops->find('all')->where(['route_id' => 7, 'direction' => 'up'])->toArray();
        
        foreach($results as $curStop)
        {

            $firstStop = $this->Schedules->find('all')->where(['stop_id' => $curStop->id])->first();
            
            $curTime = $firstStop->schedule->format("H:i");//echo $curTime;

            $itemTable = TableRegistry::get('Schedules');

            for($i = 1; $i <= 16; $i++)
            {


                $curTime = date("H:i",strtotime("+40 minutes", strtotime($curTime)));


                $item = $itemTable->newEntity();

                $item->schedule = $curTime;
                $item->season_id = 5;
                $item->stop_id = $curStop->id;
                
                //echo $stoppers[$curStop['stop_id']]['location']." : ".$stoppers[$curStop['stop_id']]['direction']." -> ". $curTime."<br>";

                $itemTable->save($item);

            }
        }   
            echo "<br><br>";*/
        
        /*}/*
        
        $this->loadModel("Stops");
        
        $items = $this->Stops->find('all')->where([ 'route_id' => 7])->order('sequence desc');
    
        $itemTable = TableRegistry::get('Stops');
        
        $order = 1;
        
        foreach($items as $itemd)
        {
            $item = $itemTable->newEntity();
            
            $item->location = $itemd->location;
            $item->lat = $itemd->lat;
            $item->lon = $itemd->lon;
            $item->sequence = $order;
            $item->direction = 'up';
            $item->route_id = 7;

            $itemTable->save($item);
            
            $order++;        
            
        }*/
        
        die();
        
    }

}
