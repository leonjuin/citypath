(function () {
    'use strict';

    /**
     * Config block
     */
    angular
            .module('app')
            .config(configure);

    configure.$inject = ['$routeProvider', '$locationProvider'];

    /**
     * App config for everything except routing
     */
    function configure($routeProvider, $locationProvider) {
        var prefix = '/admin';
        $routeProvider
            .when(prefix + '/', {
                templateUrl : prefix + '/templates/index',
                controller : 'IndexController',
                controllerAs : 'vm'
            })
            .when(prefix + '/logout', {
                templateUrl  : prefix + '/templates/logout',
                controller  : 'LogoutController',
                controllerAs : 'vm'
            })                                   
            .when(prefix + '/404', {
                templateUrl : prefix + '/templates/404',
                controller  : 'PageNotFoundController',
                controllerAs : 'vm'
            })
            .otherwise({
                templateUrl : prefix + '/templates/404',
                controller : 'ServerRouteController',
                controllerAs : 'vm'
            })

            $locationProvider.html5Mode(true);
    }


})();