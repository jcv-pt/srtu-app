'use strict';

/**
 * Config for the router
 */
angular.module('app')
    .config(
        ['$stateProvider', '$urlRouterProvider', 'JQ_CONFIG', '$httpProvider',
            function($stateProvider, $urlRouterProvider, JQ_CONFIG, $httpProvider) {
                
                $httpProvider.interceptors.push('responseObserver');

                $urlRouterProvider
                    .otherwise('/access/login');
                $stateProvider
                    .state('app', {
                        abstract: true,
                        url: '/app',
                        templateUrl: 'theme/app',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('/bower_components/blockUI.js');
                                }]
                        }
                    
                    })
                    //Dashboard
                    .state('app.dashboard', {
                        url: '/dashboard',
                        templateUrl: 'dashboard/display',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('chart.js').then(
                                            function() {
                                                return $ocLazyLoad.load('js/controllers/dashboard.js');
                                            }
                                        )
                                        .then(
                                          function(){
                                               return $ocLazyLoad.load('bower_components/font-awesome/css/font-awesome.css');
                                            }
                                          )
                                    ;
                                }
                            ]
                        }

                    })
                    //Routes
                    .state('app.routes', {
                        url: '/routes',
                        template: '<div ui-view class=""></div>'
                    })
                    .state('app.routes.add', {
                        url: '/add',
                        templateUrl: 'routes/add',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/routes.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.routes.manage', {
                        url: '/manage',
                        templateUrl: 'routes/manage',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/routes.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.routes.view', {
                        url: '/view/:routeId/:direction',
                        templateUrl: 'routes/view',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/routes.js');
                                    ;
                                }
                            ]
                        }

                    })
		    //Stops
                    .state('app.stops', {
                        url: '/stops',
                        template: '<div ui-view class=""></div>'
                    })
                    .state('app.stops.manage', {
                        url: '/manage',
                        templateUrl: 'stops/manage',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/stops.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.stops.edit', {
                        url: '/edit/:id',
                        templateUrl: 'stops/edit',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load([
					'js/controllers/stops.js',
					'js/map/load-google-maps.js',
                                        'js/map/ui-map.js'
				    ]).then(
                                        function() {
                                            return loadGoogleMaps('3','AIzaSyCT0_DDA0CGGLRlkx5DPRIR6pzhW-wjd0Y', 'EN');
                                        }
                                    );
                                }
                            ]
                        }

                    })
		    .state('app.stops.view', {
                        url: '/view/:routeId/:direction',
                        templateUrl: 'stops/view',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load([
					'js/controllers/stops.js',
					'js/map/load-google-maps.js',
                                        'js/map/ui-map.js'
				    ]).then(
                                        function() {
                                            return loadGoogleMaps('3','AIzaSyCT0_DDA0CGGLRlkx5DPRIR6pzhW-wjd0Y', 'EN');
                                        }
                                    );
                                }
                            ]
                        }

                    })
		    //Seasons
                    .state('app.seasons', {
                        url: '/seasons',
                        template: '<div ui-view class=""></div>'
                    })
		    .state('app.seasons.add', {
                        url: '/add',
                        templateUrl: 'seasons/add',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/seasons.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.seasons.manage', {
                        url: '/manage',
                        templateUrl: 'seasons/manage',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/seasons.js');
                                    ;
                                }
                            ]
                        }

                    })
		    //Schedules
                    .state('app.schedules', {
                        url: '/schedules',
                        template: '<div ui-view class=""></div>'
                    })
		    .state('app.schedules.add', {
                        url: '/add',
                        templateUrl: 'schedules/add',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/schedules.js');
                                    ;
                                }
                            ]
                        }

                    })
                    .state('app.schedules.manage', {
                        url: '/manage',
                        templateUrl: 'schedules/manage',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/schedules.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.schedules.manageRoute', {
                        url: '/manage/:routeId',
                        templateUrl: 'schedules/manage/route',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/schedules.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.schedules.manageStop', {
                        url: '/manage/:routeId/:stopId',
                        templateUrl: 'schedules/manage/stop',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/schedules.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.schedules.edit', {
                        url: '/edit/:id',
                        templateUrl: 'schedules/edit',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load([
					'js/controllers/schedules.js',
				    ])
                                }
                            ]
                        }

                    })
		    //Vehicles
                    .state('app.vehicles', {
                        url: '/vehicles',
                        template: '<div ui-view class=""></div>'
                    })
		    .state('app.vehicles.add', {
                        url: '/add',
                        templateUrl: 'vehicles/add',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/vehicles.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.vehicles.manage', {
                        url: '/manage',
                        templateUrl: 'vehicles/manage',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/vehicles.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.vehicles.position', {
                        url: '/position/:vehicleId',
                        templateUrl: 'vehicles/position',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load([
					'js/controllers/vehicles.js',
					'js/map/load-google-maps.js',
                                        'js/map/ui-map.js'
				    ]).then(
                                        function() {
                                            return loadGoogleMaps('3','AIzaSyCT0_DDA0CGGLRlkx5DPRIR6pzhW-wjd0Y', 'EN');
                                        }
                                    );
                                }
                            ]
                        }

                    })
		    //Terminals
                    .state('app.terminals', {
                        url: '/terminals',
                        template: '<div ui-view class=""></div>'
                    })
		    .state('app.terminals.add', {
                        url: '/add',
                        templateUrl: 'terminals/add',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/terminals.js');
                                    ;
                                }
                            ]
                        }

                    })
		    .state('app.terminals.manage', {
                        url: '/manage',
                        templateUrl: 'terminals/manage',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load('js/controllers/terminals.js');
                                    ;
                                }
                            ]
                        }

                    })
		    //Info
                    .state('app.info', {
                        url: '/info',
                        template: '<div ui-view class=""></div>'
                    })
		    .state('app.info.edit', {
                        url: '/edit',
                        templateUrl: 'info/edit',
                        resolve: {
                            deps: ['$ocLazyLoad',
                                function($ocLazyLoad) {
                                    return $ocLazyLoad.load(['js/controllers/info.js',
                                        'bower_components/font-awesome/css/font-awesome.css']);
                                    ;
                                }
                            ]
                        }

                    })
		    //Monotoring
                    .state('app.monitoring', {
                        url: '/info',
                        template: '<div ui-view class=""></div>'
                    })
		    .state('app.monitoring.view', {
                        url: '/view',
                        templateUrl: 'monitoring/view',
                        resolve: {
                            deps: ['$ocLazyLoad',
				function($ocLazyLoad) {
                                    return $ocLazyLoad.load(['../bower_components/d3/d3.min.js'], {
                                        serie: true
                                    }).then(
                                        function() {
                                            return $ocLazyLoad.load('js/controllers/monitoring.js');
                                        }
                                    )
				    .then(
                                        function() {
                                            return $ocLazyLoad.load('../bower_components/font-awesome/css/font-awesome.css');
                                        }
                                    );
                                }
                            ]
                        }

                    })
                    //Access
                    .state('access', {
                        url: '/access',
                        template: '<div ui-view class=""></div>'
                    })
                    .state('access.login', {
                        url: '/login',
                        templateUrl: 'login/display',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/login.js',
                                        'bower_components/font-awesome/css/font-awesome.css']);
                                }
                            ]
                        }
                    })
		    .state('access.logout', {
                        url: '/logout',
			parent: 'app',
                        templateUrl: 'login/logout',
                        resolve: {
                            deps: ['uiLoad',
                                function(uiLoad) {
                                    return uiLoad.load(['js/controllers/login.js',
                                        'bower_components/font-awesome/css/font-awesome.css']);
                                }
                            ]
                        }
                    })
            }
        ]
    )
    .factory('responseObserver', function responseObserver($q, $window) {
        return {
            'responseError': function(errorResponse) {

                    switch (errorResponse.status) {
                    case 404:
                        /*$window.location = '/';*/
                        break;
                    }
                    return $q.reject(errorResponse);
                
                }
        };
    })
    .service('restHandler', function($http, $rootScope) {
        
        this.process = function (method, url, data) {
            
            //Block User Interface

            var self = this;
               
            $.blockUI({ message: 
                self.handleResponse({
                    state :'working'
                }) 
            });
            
            //Compile request
                
            var request = {
                method: method.toUpperCase(),
                url: url,
                headers: {
                  'Content-Type': 'application/json; charset=utf-8'
                },
                data: data
            }

           $http(request).then(function(response){
               
                //Success case
		
		response = response.data;
		
		$.blockUI({ 
		    message: self.handleResponse(response.data)
		});

		return
               
           }, function(){
               
               //Error case
               
                $.blockUI({ message: 
                    self.handleResponse({
                        state:'server.error',
                    })
                }); 
               
           });
	   
	   //Clear timeout as we have activity
	   
	   $rootScope.reloadSessionTimer();
            
        }
        
        this.handleResponse = function(data){
            
            var out = "";

	    var closeLabel = 'Fechar';
	    var closeClass = 'btn-default';
	    
	    if(data.state=="working")
            {

		out += '<div class="alert alert-warning" style="margin:10px; text-align:left"> <i class="icon-spin6 animate-spin"></i> <strong>A trabalhar...</strong> -  Por favor aguarde</div>';

                return out;
            }

	    if(data.state=="confirm")
            {
                out += '<div class="alert alert-warning" style="margin:10px; text-align:left"><strong><font size="+1">Atenção</font></strong>  - ';
                
                out += data.title+'</div><div class="alert alert-warning minimal text-left" style="margin:10px;">'+data.msg+'</div>';

		if(typeof data.closeUrl != 'undefined')
		    out += '<a href="'+data.closeUrl+'" onclick="$.unblockUI();" class="btn '+data.closeClass+'" >'+data.closeLabel+'</a>';
		
		if(typeof data.closeFunction != 'undefined')
		    out += '<button type="button" onclick="'+data.closeFunction+';$.unblockUI();" class="btn '+data.closeClass+'" >'+data.closeLabel+'</button>';

		out += ' <button type="button" class="btn '+closeClass+'" onclick="$.unblockUI();">'+closeLabel+'</button>';
				
                return out+'<br><br>';
            }
	    
            if(data.state=="success")
            {

		    out += '<div class="alert alert-success" style="margin:10px; text-align:left"><strong><font size="+1">Sucesso</font></strong></div>';

		    out += '<div class="alert alert-success minimal alert-dismissible text-left" style="margin:10px;"> -  ' + data.msg + '</div>';

            }

            if(data.state=="error")
            {
                out += '<div class="alert alert-danger" style="margin:10px; text-align:left"><strong><font size="+1">Erro</font></strong>  - ';

                out += data.message+'</div>';

                if(typeof data.errors !== 'undefined'){

                   out += '<div class="alert alert-danger minimal alert-dismissible text-left" style="margin:10px;"> ';

                    $.each( data.errors, function( key, value ) {
                        out += ' - '+value[Object.keys(value)[0]]+'<br>'
                    });

                }

                out += '</div>';
            }
            
            if(data.state=="server.error")
            {
                out += '<div class="alert alert-danger" style="margin:10px; text-align:left"><strong><font size="+1">Erro</font></strong>  - A resposta de servidor não é valida.</div>';

                out += '<div class="alert alert-danger minimal alert-dismissible text-left" style="margin:10px;"> ';

                out += ' - Não foi possivel concluir o seu pedido, a resposta de servidor é invalida.<br>'

                out += '</div>';
            }
	    
            out += '<div style="margin:10px; margin-top: 25px; text-align:left" align="left">';

            if(typeof data.closeLabel !== 'undefined')
                closeLabel = data.closeLabel;

            if(typeof data.closeClass !== 'undefined')
                closeClass = data.closeClass;

            if(typeof data.closeUrl != 'undefined')
                out += '<a href="'+data.closeUrl+'" onclick="$.unblockUI();" class="btn '+closeClass+'" >'+closeLabel+'</a>';
	    else if(typeof data.closeFunction != 'undefined')
		    out += '<button type="button" onclick="'+data.closeFunction+';$.unblockUI();" class="btn '+data.closeClass+'" >'+data.closeLabel+'</button>';
            else
                out += '<button type="button" class="btn '+closeClass+'" onclick="$.unblockUI();">'+closeLabel+'</button>';

            out += '</div>';            

            return out;
            
        }
	
	this.getDataTablesSetup = function(url){

	    return {
		sAjaxSource: url,
		language : {
		    url : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json'
		},
		fnServerData : function ( sSource, aoData, fnCallback, oSettings ) {
		    oSettings.jqXHR = $.ajax( {
			dataType : 'json',
			type : 'GET',
			url : sSource,
			data : aoData,
			success : function(response){
			    
			    fnCallback({aaData : response.data.results});
			    
			}
		    });
		}
	    };
	    
	}
        
    });
    
    var scopePuppet = {

	run : function(controlerId, funcName, funcParams){
	    
	    var scope = angular.element(document.getElementById(controlerId)).scope();
	    
	    if(typeof funcParams !== 'undefined')
	    {
		
		var obj = jQuery.parseJSON(decodeURIComponent(funcParams));
		
		scope[funcName].apply( this, obj );
	    }
	    else
		scope[funcName]();
	    
	},
	
	execute : function(command){

	    eval(decodeURIComponent(command));
	    
	} 
	
    }