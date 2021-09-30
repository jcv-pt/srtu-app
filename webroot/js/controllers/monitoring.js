'use strict';

app.controller('viewController', ['$scope', '$interval', '$http','restHandler', function ($scope, $interval, $http, restHandler) {

    $scope.init = function () {

	$scope.infoModel = new Object();

	//Init vars

	$scope.infoModel = {
	    apicalls : {
		global : {
		    data : [0]
		},
		vehicles : {
		    data : [0]
		},
		terminals : {
		    data : [0]
		},
		apps : {
		    data : [0]
		},
		pie : {
		    data : [0,0,0,0],
		    labels : ['first','sec','third','fourth']
		},
	    }
	}

	//Call functions

	$scope.updateInfo();

	//Set interval

	$interval($scope.updateInfo, 5 * 1000);
	
	$interval($scope.updateTables, 30 * 1000);

    }

    $scope.updateInfo = function () {

	//Get request

	$http({
	    method: 'GET',
	    url: '/monitoring/get/info.json'
	}).then(function successCallback(response) {

	    //Update model

	    $scope.infoModel = response.data.data.results;

	    //Conver to array afff -_-

	    $scope.infoModel.apicalls.global.data = $.map($scope.infoModel.apicalls.global.data, function(value, index) {
		return [value];
	    });

	    $scope.infoModel.apicalls.vehicles.data = $.map($scope.infoModel.apicalls.vehicles.data, function(value, index) {
		return [value];
	    });

	    $scope.infoModel.apicalls.terminals.data = $.map($scope.infoModel.apicalls.terminals.data, function(value, index) {
		return [value];
	    });

	    $scope.infoModel.apicalls.apps.data = $.map($scope.infoModel.apicalls.apps.data, function(value, index) {
		return [value];
	    });
	    
	    $scope.infoModel.apicalls.pie.data = $.map($scope.infoModel.apicalls.pie.data, function(value, index) {
		return [value];
	    });


	});

    }

    $scope.dataTablesSetup = function(url){

	return restHandler.getDataTablesSetup(url);
	
    }
    
    $scope.updateTables = function(){
	
	$('#logsTable').DataTable().ajax.reload();
	$('#messagesTable').DataTable().ajax.reload();
    }
    
    $scope.init();

}]);