'use strict';

/* Controllers */

  // bootstrap controller
  app.controller('addController', ['$scope','restHandler', function($scope, restHandler) {
    
    $scope.add = function(){

	//Save request
	
	restHandler.process('post', '/schedules/add.json', $scope.routesData);

    }

  }]); 
  
  app.controller('manageController', ['$scope','restHandler', function($scope, restHandler) {

    //Datatable default setup

    $scope.dataTablesSetup = function(url){
	
	return restHandler.getDataTablesSetup(url);
	
    }

  }]);
  
  app.controller('manageRoutesController', ['$scope','restHandler', '$stateParams', function($scope, restHandler, $stateParams) {

    //Datatable default setup

    $scope.dataTablesSetup = function(url){

	return restHandler.getDataTablesSetup('/schedules/get/stops/'+$stateParams.routeId+'.json');
	
    }

  }]);
  
  app.controller('manageSchedulesController', ['$scope','restHandler', '$stateParams', function($scope, restHandler, $stateParams) {

    //Datatable default setup

    $scope.dataTablesSetup = function(url){

	return restHandler.getDataTablesSetup('/schedules/get/schedules/'+$stateParams.stopId+'.json');
	
    }
	
    $scope.submitPostData = function(){

	//Save request
	
	restHandler.process('post', '/schedules/add/'+$stateParams.stopId+'.json', $scope.postData);

    }
    
    $scope.clearPostData = function(){

	//Clear Data
	
	$scope.postData = new Object();

    }
	
    $scope.afterPostData = function(){

	//Reset form

	$scope.clearPostData();

	//Update table

	$('#schedulesTable').DataTable().ajax.reload();

    }

    $scope.delete = function(id){
	
	//Delete request
	
	restHandler.process('get', '/schedules/delete/do/'+id+'.json');
	
    }

    $scope.routeId = $stateParams.routeId;

  }]);