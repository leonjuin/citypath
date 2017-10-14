(function () {
    'use strict';

    /**
     * Index Controller
     */
    angular
            .module('app')
            .controller('IndexController', IndexController);

    IndexController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location'
    ];

    function IndexController($timeout, $scope, $window, APP_CONFIG, $location) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.model = {

        };

        activate();
   
        function activate(){
            console.log("IndexController")
        }
    }
})();