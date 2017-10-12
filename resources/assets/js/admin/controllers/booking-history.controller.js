(function () {
    'use strict';

    /**
     * BookingHistoryController
     */
    angular
            .module('app')
            .controller('BookingHistoryController', BookingHistoryController);

    BookingHistoryController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location',
        'bookingService'
    ];

    function BookingHistoryController($timeout, $scope, $window, APP_CONFIG, $location, bookingService) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.fetchByDateRange = fetchByDateRange;
        vm.searchByBookingRef = searchByBookingRef;

        vm.bookingId = null; 

        vm.model = {
            selectedBookingRef: '',
            dateFrom: '',
            dateTo: '',
            historyAvailability: true,
            yesterdayStart: moment().subtract(1, 'days').format('YYYY-MM-DD'),
            yesterdayEnd: moment().subtract(1, 'days').format('YYYY-MM-DD'),
            lastWeekStart: moment().subtract(1, 'weeks').startOf('week').format('YYYY-MM-DD'),
            lastWeekEnd: moment().subtract(1, 'weeks').endOf('week').format('YYYY-MM-DD'),
            lastMonthStart: moment().subtract(1, 'months').startOf('month').format('YYYY-MM-DD'),
            lastMonthEnd: moment().subtract(1, 'months').endOf('month').format('YYYY-MM-DD'),
            selectedStatus: '',
            status: {
                upcoming: 'upcoming',
                staying: 'staying',
                future: 'future',
            },
            bookings:[],
            bookingRef: '',
        }

        activate();
   
        function activate(){
            console.log("BookingHistoryController");
            fetchByDateRange(vm.model.yesterdayStart, vm.model.yesterdayEnd);
        }

        function fetchByDateRange(dateFrom, dateTo){
            if(!validateDateRangeInput(dateFrom, dateTo)){ return; }

            vm.model.dateFrom = dateFrom;
            vm.model.dateTo = dateTo;

            bookingService.fetchByDateRange(dateFrom, dateTo).then( function(response){
                vm.model.bookings = response;
                vm.model.historyAvailability = true;

                if(!vm.model.bookings.length){ vm.model.historyAvailability = false; }
            }, function(error){

            })
        }

        function searchByBookingRef(){
            bookingService.fetchBybookingRef(vm.model.bookingRef).then( function(response){
                vm.model.bookings = response;
                vm.model.dateFrom = '';
                vm.model.dateTo = '';
                vm.model.historyAvailability = true;

                if(!vm.model.bookings.length){ vm.model.historyAvailability = false; }
            
            }, function(error){

            })
        }

        function validateDateRangeInput(dateFrom, dateTo){
            let subtraction = 0;

            ASIATIC_HOTEL.func.inputErrorByClass('date-input', false);

            if(isNaN(moment(dateTo).diff(dateFrom, 'days'))){
                ASIATIC_HOTEL.func.inputErrorByClass('date-input', true);
                return false;
            }

            if(moment(dateTo).diff(dateFrom, 'days') < 0){
                ASIATIC_HOTEL.func.inputErrorByClass('date-input', true);
                return false;
            }

            return true;
        }
    }
})();