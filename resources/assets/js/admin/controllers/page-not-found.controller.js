(function () {
    'use strict';

    /**
     * LogoutController
     */
    angular
            .module('app')
            .controller('PageNotFoundController', PageNotFoundController);

    PageNotFoundController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location'
    ];

    function PageNotFoundController($timeout, $scope, $window, APP_CONFIG, $location) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        activate();
   
        function activate(){
            console.log();
        }

    }
})();