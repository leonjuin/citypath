(function () {
    'use strict';

    /**
     * rateManagementService
     */
    angular
            .module('app')
            .factory('rateManagementService', rateManagementService);

    rateManagementService.$inject = ['$http', 'APP_CONFIG'];

    function rateManagementService($http, APP_CONFIG) {
        var service = {
            fetch : fetch,
            createDefaultRate: createDefaultRate,
            createSeasonalRate: createSeasonalRate,
            deleteSeasonalRate: deleteSeasonalRate
        };
        return service;

        function fetch(){
            return $http.get([APP_CONFIG.apiPath, '/room/rate'].join('')).then(function (result){
                return result.data;
            });
        }

        function createDefaultRate(room){
            return $http.post([APP_CONFIG.apiPath, '/room/rate/create'].join(''), {
                "room_id": room.id, 
                "room_rate": room.rate,
                "room_max": room.max_room,
                "rate_type": 'default'
            }).then(function (result) {
                return result.data;
            });
        }

        function createSeasonalRate(room){
            return $http.post([APP_CONFIG.apiPath, '/room/rate/create'].join(''), {
                "room_id": room.id, 
                "room_rate": room.rate,
                "room_max": room.max_room,
                "date": room.date,
                "rate_type": 'seasonal'
            }).then(function (result) {
                return result.data;
            });
        }

        function deleteSeasonalRate(seasonalRate){
            return $http.post([APP_CONFIG.apiPath, '/room/rate/delete'].join(''), {
                "date": seasonalRate.target_date
            }).then(function (result) {
                return result.data;
            });
        }
    }

})();