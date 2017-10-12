(function () {
    'use strict';

    /**
     * MenuRightController
     */
    angular
            .module('app')
            .controller('MenuRightController', MenuRightController);

    MenuRightController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location', 'bookService', 'transactionService'
    ];

    function MenuRightController($timeout, $scope, $window, APP_CONFIG, $location, bookService, transactionService) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.model = {

        };

        activate();
   
        function activate(){}
    }
})();