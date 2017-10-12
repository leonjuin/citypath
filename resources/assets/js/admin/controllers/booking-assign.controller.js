(function () {
    'use strict';

    /**
     * BookingAssignController
     */
    angular
            .module('app')
            .controller('BookingAssignController', BookingAssignController);

    BookingAssignController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location'
    ];

    function BookingAssignController($timeout, $scope, $window, APP_CONFIG, $location) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.fetchBookingByStatus = fetchBookingByStatus;

        vm.model = {
            selectedStatus: '',
            status: {
                upcoming: 'upcoming',
                staying: 'staying'
            }
        }

        activate();
   
        function activate(){
            console.log("BookingAssignController");
            fetchBookingByStatus('upcoming');
        }

        function fetchBookingByStatus(status){
            vm.model.selectedStatus = status;
            console.log(status);
        }

    }
})();