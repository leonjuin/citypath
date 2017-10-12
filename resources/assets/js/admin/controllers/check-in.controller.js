(function () {
    'use strict';

    /**
     * CheckInController
     */
    angular
            .module('app')
            .controller('CheckInController', CheckInController);

    CheckInController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location', 'bookingService'
    ];

    function CheckInController($timeout, $scope, $window, APP_CONFIG, $location, bookingService) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.fetchBookingByStatus = fetchBookingByStatus;

        vm.model = {
            selectedStatus: '',
            status: {
                upcoming: 'upcoming',
                staying: 'staying',
                future: 'future',
            },
            bookings:[],
        }

        activate();
   
        function activate(){
            console.log("CheckInController");
            fetchBookingByStatus('upcoming');
        }

        function fetchBookingByStatus(status){
            vm.model.selectedStatus = status;

            bookingService.fetch(status).then( function(response){
                vm.model.bookings = response;
                console.log(["success", vm.model.bookings])
            }, function(error){
                // to be handled
            })
        }


    }
})();