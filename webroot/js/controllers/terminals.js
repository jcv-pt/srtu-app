'use strict';

/* Controllers */

// bootstrap controller
app.controller('addController', ['$scope', 'restHandler', function ($scope, restHandler) {

    $scope.add = function () {

	//Save request

	restHandler.process('post', '/terminals/add.json', $scope.postData);

    }

}]);

app.controller('manageController', ['$scope', 'restHandler', function ($scope, restHandler) {

	//Datatable default setup

	$scope.dataTablesSetup = function () {

	    return restHandler.getDataTablesSetup('/terminals/get.json');

	}

	$scope.delete = function (id) {

	    //Delete request

	    restHandler.process('get', '/terminals/delete/do/' + id + '.json');

	}
	
	$scope.authorization = function (id, state) {

	    //Delete request

	    restHandler.process('get', '/terminals/authorization/' + id + '/'+state+'.json');

	}

}]);