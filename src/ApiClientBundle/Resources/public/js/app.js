'use strict';

/**
 * @ngdoc overview
 * @name angelApp
 * @description
 * # angelApp
 *
 * Core module of the application.
 */

var angelApp = angular.module('ApiClient', [
        'ngRoute'
    ]);

angelApp.controller('mainController', ['$scope', '$rootScope', '$http', function($scope, $rootScope, $http){
	var angels = [];
	$http.get('api/angels').success(function(data){
		angular.forEach(data, function(value, key){
			angels.push(value);
		});
		$rootScope.angels = angels;
		var numOfAngels = $rootScope.angels.length;

		var quotes = [];

		for(var i=0; i<numOfAngels; i++){

			angular.forEach($rootScope.angels[i].quotes, function(value, key){
				value.angelId = $rootScope.angels[i].id;
				value.angelName = $rootScope.angels[i].name;
				quotes.push(value);
			})

		}

		$rootScope.quotes = quotes;

	}).error(function(data, status, headers, config){
		console.log('Error when get data from DB..');
	});

}]);

angelApp.controller('homeController', ['$scope', '$rootScope', '$http', '$filter', function($scope, $rootScope, $http, $filter){
	$scope.newQuote = {};

	this.postQuote = function(angel){
		if($scope.newQuote.text == '' || angular.isUndefined($scope.selectAngel) || $scope.selectAngel == null || !$scope.selectAngel.hasOwnProperty('id') ){
			alert("ERROR! \nPlease fulfill all the fields!");
		}else{
			
			var numOfAngels = $rootScope.angels.length;

			$scope.newQuote.angel = angel;


	        $http.post("api/post", $scope.newQuote).success(function(data, status) {

	        	alert("Bravo! \nPost successfully!");

	        	var newQuote = data[0];

	        	$rootScope.quotes.push(newQuote);

				for(var i=0; i<numOfAngels; i++){
					if($rootScope.angels[i].id == newQuote.angelId){
						$rootScope.angels[i].quotes.push(newQuote);
					}
				}
				
		      	$scope.newQuote = {};

	        }).error(function(data, status, headers, config){
				console.log('Error when post data to DB..');
			});
		}

	}

}]);

angelApp.controller('angelController', ['$scope', '$rootScope', '$routeParams', '$location', function($scope, $rootScope, $routeParams, $location){
	var angelId = $routeParams.angelId;
	var numOfAngels = $rootScope.angels.length;
	if(angelId>=$rootScope.angels[0].id && angelId <= $rootScope.angels[numOfAngels-1].id){

		for(var i=0; i<numOfAngels; i++){
			if($rootScope.angels[i].id == angelId){
				$scope.angel = $rootScope.angels[i];
			}
		}
		
	}else{
		$location.path('/');
	}
}]);