'use strict';

/* Controllers */

  // bootstrap controller
  app.controller('addController', ['$scope','restHandler', function($scope, restHandler) {
    
    $scope.add = function(){

	//Save request
	
	restHandler.process('post', '/seasons/add.json', $scope.postData);

    }

  }]); 
  
  app.controller('viewController', ['$scope','restHandler', function($scope, restHandler) {

    //Datatable default setup

    $scope.dataTablesSetup = function(url){
	
	return restHandler.getDataTablesSetup(url);
	
    }
    
    //Delete function
    
    $scope.delete = function(id){

	//Save request
	
	restHandler.process('get', '/seasons/delete/confirm/'+id+'.json');

    }
    
    $scope.deleteConfirmed = function(id){

	//Save request

	restHandler.process('get', '/seasons/delete/do/'+id+'.json', $scope.postData);

    }

  }]);