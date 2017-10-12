(function () {
    'use strict';

    /**
     * ServerRouteController
     */
    angular
            .module('app')
            .controller('ServerRouteController', ServerRouteController);

    ServerRouteController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location', '$route'
    ];

    function ServerRouteController($timeout, $scope, $window, APP_CONFIG, $location, $route) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        activate();
   
        function activate(){
            switch($location.url()){
                case '/auth/facebook?callback=bind':
                case '/admin/store/map':            
                case '/auth/google?callback=bind':
                    //if(document.referrer === APP_CONFIG.baseUrl + "/admin/store/map"){  }
                    $window.location.reload();
                    break;
                default:
                    console.log(['404', 'not in exempted list', $location.url()]);
            }
        }

    }
})();