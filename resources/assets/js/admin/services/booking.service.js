(function () {
    'use strict';

    /**
     * bookingService
     */
    angular
            .module('app')
            .factory('bookingService', bookingService);

    bookingService.$inject = ['$http', 'APP_CONFIG'];

    function bookingService($http, APP_CONFIG) {
        var service = {
            fetch: fetch,
            fetchByDateRange: fetchByDateRange,
            fetchBybookingRef: fetchBybookingRef,
            fetchBookingHistoryItemsById: fetchBookingHistoryItemsById,
            fetchBookingItemsById: fetchBookingItemsById,
            updateBookingItemRemark: updateBookingItemRemark,
            updateMultipleBookingItemStatus: updateMultipleBookingItemStatus,
            updateBookingItemStatus: updateBookingItemStatus,
        };
        return service;

        function fetch(status){
            return $http.get([APP_CONFIG.apiPath, '/booking/?status=', status].join('')).then(function (result){
                return result.data;
            });
        }

        function fetchByDateRange(dateFrom, dateTo){
            return $http.get([APP_CONFIG.apiPath, '/booking/history?date_from=', dateFrom, '&date_to=', dateTo].join('')).then(function (result){
                return result.data;
            });
        }

        function fetchBookingHistoryItemsById(bookingId){
            return $http.get([APP_CONFIG.apiPath, '/booking/history/', bookingId].join('')).then(function (result){
                return result.data;
            });
        }

        function fetchBookingItemsById(bookingId){
            return $http.get([APP_CONFIG.apiPath, '/booking/', bookingId].join('')).then(function (result){
                return result.data;
            });
        }

        function fetchBybookingRef(bookingRef){
            return $http.get([APP_CONFIG.apiPath, '/booking/history/search?booking_ref=', bookingRef].join('')).then(function (result){
                return result.data;
            });
        }

        function updateBookingItemRemark(bookingItem){
            return $http.post([APP_CONFIG.apiPath, '/booking/update/remark'].join(''),{
                "booking_item" : bookingItem
            }).then(function (result){
                return result.data;
            });
        }

        function updateBookingItemStatus(item, status){
            return $http.post([APP_CONFIG.apiPath, '/booking/update/status'].join(''),{
                "booking_item": item,
                "status": status,
                "type": "single"
            }).then(function (result){
                return result.data;
            })
        }

        function updateMultipleBookingItemStatus(bookingId, status){
            return $http.post([APP_CONFIG.apiPath, '/booking/update/status'].join(''),{
                "booking_id": bookingId,
                "status": status,
                "type": "multiple"
            }).then(function (result){
                return result.data;
            })
        }

    }

})();