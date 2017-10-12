(function () {
    'use strict';

    /**
     * reportService
     */
    angular
            .module('app')
            .factory('reportService', reportService);

    reportService.$inject = ['$http', 'APP_CONFIG'];

    function reportService($http, APP_CONFIG) {
        var service = {
            fetchBookingReportByMonth: fetchBookingReportByMonth,
            fetchSalesReportByDateRange: fetchSalesReportByDateRange,
        };
        return service;

        function fetchBookingReportByMonth(date, roomId){
            return $http.get([APP_CONFIG.apiPath, '/report/booking?date_from=', dateFrom, '&date_to=',dateTo].join('')).then(function (result){
                return result.data;
            });
        }

        function fetchSalesReportByDateRange(dateFrom, dateTo){
            return $http.get([APP_CONFIG.apiPath, '/report/sales?date_from=', dateFrom, '&date_to=',dateTo].join('')).then(function (result){
                return result.data;
            });
        }

    }

})();