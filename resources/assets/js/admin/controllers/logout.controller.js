(function () {
    'use strict';

    /**
     * LogoutController
     */
    angular
            .module('app')
            .controller('LogoutController', LogoutController);

    LogoutController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location'
    ];

    function LogoutController($timeout, $scope, $window, APP_CONFIG, $location) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        activate();
   
        function activate(){
            $('#logout').submit();
        }

    }
})();