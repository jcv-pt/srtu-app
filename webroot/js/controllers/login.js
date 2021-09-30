'use strict';

/* Controllers */
// signin controller
app.controller('LoginFormController', [ '$scope', '$http', '$state', '$timeout', function( $scope, $http, $state, $timeout) {
    
    $scope.user = {};
    
    $scope.authError = null;
    $scope.showLogin = false;
    
    //Check if user is logged in...
    
    $http.post('login/isloggedin.json', $scope.user)
        .then(function(response) {

            if (response.data.request.state == "success")
            {
                $state.go('app.dashboard');
                return;
            }

            $scope.showLogin = true;
        }
    );

    
    //Login function
    
    $scope.login = function() {
        
        $scope.authError = null;

        $http.post('login/signin.json', $scope.user)
            .then(function(response) {

                $scope.authError = response.data.request.msg;
		$scope.authImg = response.data.request.img;
        
                if (response.data.request.state !== "success")
                    return;
                
                $timeout( function(){ $state.go('app.dashboard'); } , 3000);
                
            }, function(x) {
                $scope.authError = 'Server Error';
            }
        );
    };
}]);

app.controller('logoutController', ['$scope', 'restHandler', '$timeout', function ($scope, restHandler, $timeout) {

    $scope.doLogOut = function () {

	restHandler.process('get', '/login/signout.json','');
	
    }

}]);