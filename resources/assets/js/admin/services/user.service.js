(function () {
    'use strict';

    /**
     * userService
     */
    angular
            .module('app')
            .factory('userService', userService);

    userService.$inject = ['$http', 'APP_CONFIG'];

    function userService($http, APP_CONFIG) {
        var service = {
            fetch : fetch,
            changePassword : changePassword,
            resetPassword : resetPassword,
           //register : register,
        };
        return service;

        function fetch(){
            return $http.get([APP_CONFIG.apiPath, '/users'].join('')).then(function (result){
                return result.data;
            });
        }

        function changePassword(passwordOld, passwordNew){
            return $http.put([APP_CONFIG.apiPath, '/password/change'].join(''), {
                "password_old": passwordOld, 
                "password_new": passwordNew
            }).then(function (result) {
                return result.data;
            });
        }  

        function resetPassword(userId){
            return $http.get([APP_CONFIG.apiPath, '/password/reset/', userId].join('')).then(function (result){
                return result.data;
            });
        }          
    }

})();