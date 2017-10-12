(function () {
    'use strict';

    /**
     * CheckInDetailsController
     */
    angular
            .module('app')
            .controller('BookingHistoryDetailsController', BookingHistoryDetailsController);

    BookingHistoryDetailsController.$inject = [
        '$timeout', '$scope', '$window', '$routeParams',
        'APP_CONFIG','$location', 'bookingService'
    ];

    function BookingHistoryDetailsController($timeout, $scope, $window, $routeParam, APP_CONFIG, $location, bookingService) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;
        vm.bookingId = null;

        vm.fetchBookingHistoryItemsById = fetchBookingHistoryItemsById;

        vm.model = {
            selectedBookingRef: '',
            bookingItems: []
        }

        activate();
   
        function activate(){
            vm.bookingId = $routeParam.bookingId;

            fetchBookingHistoryItemsById(vm.bookingId);
        }

        function fetchBookingHistoryItemsById(bookingId){
            bookingService.fetchBookingHistoryItemsById(bookingId).then( function(response){
                vm.model.selectedBookingRef = response[0].booking_ref;
                vm.model.bookingItems = response;
                //PPconsole.log(vm.model.bookingItems);
            }, function(error){

            })
        }
    }
})();