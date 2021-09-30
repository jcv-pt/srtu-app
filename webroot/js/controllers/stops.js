'use strict';

/* Controllers */
  
  app.controller('stopsManageController', ['$scope','restHandler', function($scope, restHandler) {

    //Datatable default setup

    $scope.dataTablesSetup = function(url){
	
	return restHandler.getDataTablesSetup(url);
    }
    

  }]);
  
  app.controller('stopsEditController', ['$scope','restHandler','$stateParams', function($scope, restHandler, $stateParams) {

    //Initialize

    $scope.init = function(){
	
	$scope.myMarkers = [];
	$scope.initPostData();
    }
    
    $scope.initPostData = function(){
	
	$scope.postData = new Object();
	$scope.postData.route_id = $stateParams.id;
	
    }
    
    $scope.reloadPostData = function(){
	
	$scope.postData.lat = "";
	$scope.postData.lon = "";
	$scope.postData.location = "";
	
    }

    $scope.mapOptions = {
      center: new google.maps.LatLng(37.1362, -8.5377),
      zoom: 14,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    $scope.addMarker = function ($event, $params) {

	$scope.clearMarkers();

	var actualMark = new google.maps.Marker({
	    map: $scope.myMap,
	    position: $params[0].latLng
	});
	
	$scope.postData.lat = actualMark.getPosition().lat();
	$scope.postData.lon = actualMark.getPosition().lng();
	
	$scope.myMarkers.push(actualMark);
	
    };
    
    $scope.clearMarkers = function(){
	
	for (var i = 0; i < $scope.myMarkers.length; i++ ) {
	  $scope.myMarkers[i].setMap(null);
	}
	
	$scope.myMarkers.length = 0;
	
    };
    
    $scope.submitPostData = function(){

	//Save request
	
	restHandler.process('post', '/stops/add.json', $scope.postData);

    }
    
    $scope.clearPostData = function(){

	//Clear Data
	
	$scope.reloadPostData();
	
	//Clear Map
	
	$scope.clearMarkers();

    }
    
    $scope.deleteStop = function(id){
	
	//Delete request
	
	restHandler.process('get', '/stops/delete/confirm/'+id+'.json');
	
    }
    
    $scope.deleteConfirmedStop = function(id){
	
	//Delete request
	
	restHandler.process('get', '/stops/delete/do/'+id+'.json');
	
    }
    
    $scope.afterAddStop = function(){
	
	//Clear the form
	
	$scope.reloadPostData();
	 
	//Update the tables
	
	$('#lineStopsTable').DataTable().ajax.reload();
	
	//Clear the map
	
	$scope.clearMarkers();
	
    }
    
    $scope.moveStop = function(id,direction){

	//Save request
	
	restHandler.process('get', '/stops/move/'+direction+'/'+$stateParams.id+'/'+id+'.json');

    }
    
    $scope.init();
    
  }]);
  
  app.controller('stopsExistController', ['$scope','restHandler','$stateParams', function($scope, restHandler, $stateParams) {
    
    //Datatable init setup

    $scope.dataTablesSetup = function(){

	return restHandler.getDataTablesSetup('/stops/get/locations/'+$stateParams.id+'.json');
	
    }
    
  }]);
  
 app.controller('viewController', ['$scope','restHandler','$stateParams','$http', '$interval', function($scope, restHandler, $stateParams, $http, $interval) {
    
    //Datatable init setup
    
    $scope.init = function(){
	
	//Get coordinates & build map
	
	$http.get('/stops/get/path/'+$stateParams.routeId+'/'+$stateParams.direction+'.json').then(function(response) {
	    
	    $scope.pathCoordinates = response.data.data.results;
	    $scope.routeColor = response.data.data.color;
	    
	    $scope.initMap();
    
	});
	
    }
    
    $scope.mapOptions = {
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    $scope.initMap = function(){

	$scope.lat_lng = Array();

	var latlngbounds = new google.maps.LatLngBounds();

	for (var i = 0; i < $scope.pathCoordinates.length; i++) {
	//for (var i = 0; i < 4; i++) {

	    var data = {
		title: $scope.pathCoordinates[i][1],
		lat: $scope.pathCoordinates[i][2],
		lng: $scope.pathCoordinates[i][3],
		description: 'Marcador :' + $scope.pathCoordinates[i][1],

	    }

	    var curPoint = new google.maps.LatLng(data.lat, data.lng);
	    
	    $scope.lat_lng.push(curPoint);

	    var marker = new google.maps.Marker({
		position: curPoint,
		map: $scope.myMap,
		icon: 'http://cp.srtu.pt/img/marker_blue.png',
	    });
  
	    latlngbounds.extend(marker.position);
	    (function (marker, data) {
		
		var infowindow = new google.maps.InfoWindow({
		    content: '<strong>#'+(i+1)+'</strong> - '+data.title
		});
	    
		google.maps.event.addListener(marker, 'mouseover', function() {
		    infowindow.open($scope.myMap, marker);
		});

		google.maps.event.addListener(marker, 'mouseout', function() {
		    infowindow.close();
		});
		
	    })(marker, data);
	}
	
	$scope.myMap.setCenter(latlngbounds.getCenter());
	$scope.myMap.fitBounds(latlngbounds);

	$scope.runner = $interval($scope.markPoints, 2000);
	
	//Set view vars
	
	$scope.lineNumber = $stateParams.routeId;
	$scope.numberStops = $scope.pathCoordinates.length;

	
    }
    
    $scope.markPoints = function(){
	
	//Init scope point
	
	if(typeof $scope.curPoint === 'undefined')
	    $scope.curPoint = 0;
	
	//Init scope length
	
	if(typeof $scope.totalKms === 'undefined')
	    $scope.totalKms = 0;
	
	if(typeof $scope.estimatedTime === 'undefined')
	    $scope.estimatedTime = 0;
	
	//Init polis array
	
	//if(typeof $scope.polys === 'undefined')
	    //$scope.polys = new Array();
	
	//Intialize the Path Array
	var path = new google.maps.MVCArray();

	//Intialize the Direction Service
	var service = new google.maps.DirectionsService();

	//Set the Path Stroke Color
	var poly = new google.maps.Polyline({
	    map: $scope.myMap,
	    strokeColor: $scope.routeColor
	});

	var src = $scope.lat_lng[$scope.curPoint];
	var des = $scope.lat_lng[$scope.curPoint + 1];

	poly.setPath(path);
	service.route({
	    origin: src,
	    destination: des,
	    travelMode: google.maps.DirectionsTravelMode.DRIVING
	}, function (result, status) {
	    if (status == google.maps.DirectionsStatus.OK) {

		for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++)
		    path.push(result.routes[0].overview_path[i]);

		for (var i2 = 0; i2 < result.routes[0].legs.length; ++i2) {
		    $scope.totalKms = parseFloat(parseFloat($scope.totalKms) + (result.routes[0].legs[i2].distance.value/1000)).toFixed(2);
		    $scope.estimatedTime += Math.round((result.routes[0].legs[i2].duration.value+30)/60);
		}
		

		$.each(result.routes[0].legs, function( index, leg ) {
		    
		    $.each(leg.steps, function( index, step ) {
			
			$.each(step.path, function( index, path ){
			
			  $("#coords").append('["'+path.lat()+'","'+path.lng()+'"],<br>');
		    
			});
			
		    });
		    
		});

	    }
	});

	if ($scope.curPoint + 1 < $scope.lat_lng.length - 1)
	    $scope.curPoint++;
	else
	    $interval.cancel($scope.runner);

    }
    
  }]);