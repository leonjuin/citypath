(function () {
    'use strict';

    /**
     * CheckInDetailsController
     */
    angular
            .module('app')
            .controller('CheckInDetailsController', CheckInDetailsController);

    CheckInDetailsController.$inject = [
        '$timeout', '$scope', '$window', '$routeParams',
        'APP_CONFIG','$location', 'bookingService'
    ];

    function CheckInDetailsController($timeout, $scope, $window, $routeParam, APP_CONFIG, $location, bookingService) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;
        vm.bookingId = null;

        vm.updateBookingItemStatus = updateBookingItemStatus;
        vm.updateMultipleBookingItemStatus = updateMultipleBookingItemStatus;
        vm.updateBookingItemRemark = updateBookingItemRemark;

        vm.model = {
            selectedBookingRef: '',
            bookingItems: []
        }

        activate();
   
        function activate(){
            vm.bookingId = $routeParam.bookingId;

            fetchBookingItemsById(vm.bookingId);
        }

        function fetchBookingItemsById(bookingId){
            bookingService.fetchBookingItemsById(bookingId).then( function(response){
                vm.model.selectedBookingRef = response[0].booking_ref
                vm.model.bookingItems = compressBookingItem(response)
            }, function(error){

            })
        }

        function updateBookingItemRemark(bookingItem){
            if(!bookingItem.hotel_remark){ return; }
            bookingService.updateBookingItemRemark(bookingItem).then( function(response){
            }, function(error){
                // to be handled
            })
        }

        function updateBookingItemStatus(item, status){
            bookingService.updateBookingItemStatus(item, status).then( function(response){
                fetchBookingItemsById(vm.bookingId)
            }, function(error){
                // to be handled
            })
        }

        function updateMultipleBookingItemStatus(bookingId, status){
            bookingService.updateMultipleBookingItemStatus(bookingId, status).then( function(response){
                swal(
                    'Success!',
                    'Booking status has been updated!',
                    'success'
                )
                fetchBookingItemsById(vm.bookingId)
            }, function(error){
                // to be handled
            })
        }

        function compressBookingItem(bookingItems){
            var finalItems, 
                currentItem, 
                storedItem, 
                currentCheckIn, 
                currentCheckOut, 
                isFirst,
                combinedIds;

            finalItems = [{}]
            storedItem = [{}]
            combinedIds = []
            isFirst = true;

            finalItems.shift()
            storedItem.shift()
            combinedIds.shift()

            for(currentItem in bookingItems){   
                // dont do the first one              
                if(currentItem > 0){
                    if(bookingItems[currentItem].check_in_date != bookingItems[currentItem - 1].check_out_date){
                        currentCheckIn = storedItem[0].check_in_date
                        currentCheckOut = storedItem[storedItem.length - 1].check_out_date
                        combinedIds = storedItem.map(function(item){ return item.id; })

                        finalItems.push({
                            "ids": combinedIds,
                            "room_id": storedItem[0].room_id,
                            "room_name": storedItem[0].room_name,
                            "status": storedItem[0].status,
                            "total_adults": storedItem[0].total_adults,
                            "total_children": storedItem[0].total_children,
                            "absent": storedItem[0].absent,
                            "booking_id": storedItem[0].booking_id,
                            "booking_ref": storedItem[0].booking_ref,
                            "cancelled": storedItem[0].cancelled,
                            "check_in_date": currentCheckIn,
                            "check_out_date": currentCheckOut,
                            "checked_in": storedItem[0].checked_in,
                            "checked_out": storedItem[0].checked_out,
                            "hotel_remark": storedItem[0].hotel_remark,
                            "rate_version": storedItem[0].rate_version
                        })

                        storedItem = [{}]
                        combinedIds = [{}]
                        storedItem.shift()
                        combinedIds.shift()
                    }
                }

                storedItem.push({   
                    "id": bookingItems[currentItem].id,
                    "room_id": bookingItems[currentItem].room_id,
                    "room_name": bookingItems[currentItem].room_name,
                    "status": bookingItems[currentItem].status,
                    "total_adults": bookingItems[currentItem].total_adults,
                    "total_children": bookingItems[currentItem].total_children,
                    "absent": bookingItems[currentItem].absent,
                    "booking_id": bookingItems[currentItem].booking_id,
                    "booking_ref": bookingItems[currentItem].booking_ref,
                    "cancelled": bookingItems[currentItem].cancelled,
                    "check_in_date": bookingItems[currentItem].check_in_date,
                    "check_out_date": bookingItems[currentItem].check_out_date,
                    "checked_in": bookingItems[currentItem].checked_in,
                    "checked_out": bookingItems[currentItem].checked_out,
                    "hotel_remark": bookingItems[currentItem].hotel_remark,
                    "rate_version": bookingItems[currentItem].rate_version
                });
            }

            if(storedItem){
                currentCheckIn = storedItem[0].check_in_date
                currentCheckOut = storedItem[storedItem.length - 1].check_out_date
                combinedIds = storedItem.map(function(item){ return item.id; })

                finalItems.push({
                    "ids": combinedIds,
                    "room_id": storedItem[0].room_id,
                    "room_name": storedItem[0].room_name,
                    "status": storedItem[0].status,
                    "total_adults": storedItem[0].total_adults,
                    "total_children": storedItem[0].total_children,
                    "absent": storedItem[0].absent,
                    "booking_id": storedItem[0].booking_id,
                    "booking_ref": storedItem[0].booking_ref,
                    "cancelled": storedItem[0].cancelled,
                    "check_in_date": currentCheckIn,
                    "check_out_date": currentCheckOut,
                    "checked_in": storedItem[0].checked_in,
                    "checked_out": storedItem[0].checked_out,
                    "hotel_remark": storedItem[0].hotel_remark,
                    "rate_version": storedItem[0].rate_version
                })
            }
            return finalItems
        }




    }
})();