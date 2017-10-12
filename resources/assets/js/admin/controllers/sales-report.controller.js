(function () {
    'use strict';

    /**
     * SalesReportController
     */
    angular
            .module('app')
            .controller('SalesReportController', SalesReportController);

    SalesReportController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location', 'reportService'
    ];

    function SalesReportController($timeout, $scope, $window, APP_CONFIG, $location, reportService) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.fetchSalesReportByDateRange = fetchSalesReportByDateRange;

        vm.model = {
            dateFrom: moment().subtract(1, 'days').format('YYYY-MM-DD'),
            dateTo: moment().subtract(1, 'days').format('YYYY-MM-DD'),
            yesterdayStart: moment().subtract(1, 'days').format('YYYY-MM-DD'),
            yesterdayEnd: moment().subtract(1, 'days').format('YYYY-MM-DD'),
            lastWeekStart: moment().subtract(1, 'weeks').startOf('week').format('YYYY-MM-DD'),
            lastWeekEnd: moment().subtract(1, 'weeks').endOf('week').format('YYYY-MM-DD'),
            lastMonthStart: moment().subtract(1, 'months').startOf('month').format('YYYY-MM-DD'),
            lastMonthEnd: moment().subtract(1, 'months').endOf('month').format('YYYY-MM-DD'),
            revenue: 0,
            totalRoom: 0,
            totalGuest: 0,
        }

        activate();
   
        function activate(){
            console.log("SalesReportController");
            fetchSalesReportByDateRange(vm.model.dateFrom, vm.model.dateTo);
        }

        function fetchSalesReportByDateRange(dateFrom, dateTo){
            reportService.fetchSalesReportByDateRange(dateFrom, dateTo).then( function(response){
                vm.model.revenue = response[0].total_revenue
                vm.model.totalRoom = response[0].total_room
                vm.model.totalGuest = response[0].total_guest
            });
        }

    }
})();