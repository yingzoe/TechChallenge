'use strict';

/**
 * @ngdoc overview
 * @name angelApp
 * @description
 * # angelApp
 *
 * Main router provider in separate file, for better extensibility
 * Each module has its own router file.
 * Please define only global routes in this route.js file
 */

angelApp.config(function ($provide, $routeProvider) {
    $routeProvider
    	.when('/angels',{
    		templateUrl: assets_path + '/angels.html'
    	})
        .when('/', {
            templateUrl: assets_path + '/index.html'
        })
        .when('/angel/:angelId',{
            templateUrl: assets_path + '/angel.html'
        })

        /*
         * Default route. Redirect to homepage if nothing was found
         */
        .otherwise({
            redirectTo: '/'
        });

});
