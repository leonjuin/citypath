(function () {
    'use strict';

    /**
     * roomService
     */
    angular
            .module('app')
            .factory('roomService', roomService);

    roomService.$inject = ['$http', 'APP_CONFIG'];

    function roomService($http, APP_CONFIG) {
        var service = {
            fetch: fetch
        };
        return service;

        function fetch(){
            return $http.get([APP_CONFIG.apiPath, '/room'].join('')).then(function (result){
                return result.data;
            });
        }

    }

})();