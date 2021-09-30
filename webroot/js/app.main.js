'use strict';
angular.module('app').controller('AppCtrl', ['$scope', '$interval',
    function($scope, $interval) {

        var menufold = false; 
        var screenWidth = window.innerWidth;
        if (screenWidth < 767){
            var menufold = true; 
        }

        $scope.app = {
            name: 'S.R.T.U | Sistema de Rastreio de Transportes Urbanos',
            version: '3.0.0',
            type: 'general', // general,hospital,university,music,crm,blog,socialmedia,freelancing,ecommerce
            color: {
                primary: '#673AB7',
                accent: '#FF6E40',
                info: '#26C6DA',
                success: '#46be8a',
                warning: '#fdb45d',
                danger: '#F44336',
                secondary: '#a9a9a9',
                text: '#767676'
            },
            settings: {
                menuProfile: true,
                menuFolded: menufold,
                chatFolded: true,
                layoutBoxed: false,
                searchFocus: false,
                pagetitle: 'C.P. \\ Portimão',
            },
	    session: {
		timeoutPer : 100,
		time: new Date().getTime()
	    }
        }
	
        $scope.menuChatToggle = function(type, value) {
            if (type == "menu" && !value) {
                $scope.app.settings.chatFolded = true;
            }
            if (type == "chat" && !value) {
                $scope.app.settings.menuFolded = true;
            }
        }
        $scope.changeMenuHeight = function() {
            //console.log($scope.settings.menuProfile);
            if ($scope.app.settings.menuFolded == true) {
                var navHeight = angular.element("#main-content section.wrapper .content-wrapper").innerHeight() + 90;
            } else {
                var navHeight = $(window).innerHeight() - 60;
            }
            //console.log(navHeight);
            angular.element("#main-menu-wrapper").height(navHeight);
        }
	
        $scope.$watch('app.settings.menuFolded', function() {
            $scope.changeMenuHeight();
        });
	
        $scope.$on('$viewContentLoaded', function(next, current) {
	    
	    $scope.reloadSessionTimer();
	    
            angular.element(document).ready(function() {
                $scope.changeMenuHeight();
            });
	    
        });
	
        $scope.ElementInView = function(inview, event, addclass, removeclass) {
            var id = event.inViewTarget.id;
            /*console.log(event);  */
            if (inview && id != "") {
                if (addclass != "") {
                    $("#" + id).addClass(addclass);
                } else {
                    $("#" + id).removeClass(removeclass);
                }
            }
            return false;
        }
	
        $scope.testLines = [];
	    for (var i = 20; i >= 0; i--) {
		$scope.testLines.push(i);
        };
	
        $scope.lineInView = function(index, inview, inviewpart, event) {
            /*console.log(inview+" "+index+" "+inviewpart+" "+event);    */
            /*console.log(event.inViewTarget.id);  */
            return false;
        }
	
	$scope.reloadSessionTimer = function(){
	    
	    $scope.app.session.time = new Date().getTime();
	    
	}
	
	$scope.sessionTimer = function(){
	    
	    var timeout = 15 * 60 * 1000;
	    
	    var diff = new Date().getTime()-$scope.app.session.time;
	    
	    var per = Math.round(diff * 100 / timeout);
	    
	    $scope.app.session.timePer = per;

	    if(per >= 100)
		window.location = '/login/forcelogout';
	    
	}
	
	$interval($scope.sessionTimer, 5000);
	
    }
]);