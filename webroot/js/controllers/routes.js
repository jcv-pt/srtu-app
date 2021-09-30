'use strict';

/* Controllers */

  // bootstrap controller
  app.controller('routesAddController', ['$scope','restHandler', function($scope, restHandler) {
    
    $scope.addRoute = function(){

	//Save request
	
	restHandler.process('post', '/routes/add.json', $scope.routesData);

    }

  }]); 
  
  app.controller('routesViewController', ['$scope','restHandler', function($scope, restHandler) {

    //Datatable default setup

    $scope.dataTablesSetup = function(url){
	
	return restHandler.getDataTablesSetup(url);
	
    }
    
    //Delete function
    
    $scope.deleteRoute = function(id){

	//Save request
	
	restHandler.process('get', '/routes/delete/confirm/'+id+'.json', $scope.routesData);

    }
    
    $scope.deleteConfirmedRoute = function(id){

	//Save request

	restHandler.process('get', '/routes/delete/do/'+id+'.json', $scope.routesData);

    }

  }]);