(function () {
    'use strict';

    /**
     * RoomTypeController
     */
    angular
            .module('app')
            .controller('RoomTypeController', RoomTypeController);

    RoomTypeController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location'
    ];

    function RoomTypeController($timeout, $scope, $window, APP_CONFIG, $location) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        activate();
   
        function activate(){
            console.log("RoomTypeController");
        }

    }
})();