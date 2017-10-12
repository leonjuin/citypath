(function () {
    'use strict';

    /**
     * MenuTopController
     */
    angular
            .module('app')
            .controller('MenuTopController', MenuTopController);

    MenuTopController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location'
    ];

    function MenuTopController($timeout, $scope, $window, APP_CONFIG, $location) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.model = {

        };

        activate();
   
        function activate(){}
    }
})();