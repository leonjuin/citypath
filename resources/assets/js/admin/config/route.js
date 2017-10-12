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
            .when(prefix + '/room/type', {
                templateUrl : prefix + '/templates/room-type',
                controller  : 'RoomTypeController',
                controllerAs : 'vm'
            })
            .when(prefix + '/sales/report', {
                templateUrl : prefix + '/templates/sales-report',
                controller : 'SalesReportController',
                controllerAs : 'vm'
            })
            .when(prefix + '/booking/history', {
                templateUrl : prefix + '/templates/booking-history',
                controller : 'BookingHistoryController',
                controllerAs : 'vm'
            })
            .when(prefix + '/booking/history/:bookingId', {
                templateUrl : prefix + '/templates/booking-history-details',
                controller : 'BookingHistoryDetailsController',
                controllerAs : 'vm'
            })
            .when(prefix + '/check-in', {
                templateUrl : prefix + '/templates/check-in',
                controller : 'CheckInController',
                controllerAs : 'vm'
            })
            .when(prefix + '/check-in/:bookingId', {
                templateUrl : prefix + '/templates/check-in-details',
                controller : 'CheckInDetailsController',
                controllerAs : 'vm'
            })
            .when(prefix + '/rate/calendar', {
                templateUrl : prefix + '/templates/rate-calendar',
                controller : 'RateCalendarController',
                controllerAs : 'vm'
            }) 
            .when(prefix + '/rate/setting', {
                templateUrl : prefix + '/templates/rate-setting',
                controller : 'RateSettingController',
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