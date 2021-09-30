'use strict';

/* Controllers */

// bootstrap controller
app.controller('editController', ['$scope', 'restHandler', function ($scope, restHandler) {

    $scope.edit = function () {

	//Save request

	$scope.postData = new Object();
	
	$scope.postData.html = $("#html").html();
	
	restHandler.process('post', '/info/edit.json', $scope.postData);

    }

}]);