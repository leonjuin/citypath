(function () {
    'use strict';

    /**
     * RateSettingController
     */
    angular
            .module('app')
            .controller('RateSettingController', RateSettingController);

    RateSettingController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location', 'rateManagementService', 'reportService'
    ];

    function RateSettingController($timeout, $scope, $window, APP_CONFIG, $location, rateManagementService, reportService) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.changeDefaultRateEditState = changeDefaultRateEditState;
        vm.changeSeasonalRateEditState = changeSeasonalRateEditState;
        vm.saveDefaultRate = saveDefaultRate;
        vm.saveSeasonalRate = saveSeasonalRate;
        vm.deleteSeasonalRate = deleteSeasonalRate;
        vm.editSeasonalRate = editSeasonalRate;

        vm.today = new Date().toJSON().split('T')[0];
        vm.thisMonth = moment().month() + 1;

        vm.model = {
            firstFreeze: false,
            rooms : [],
            roomsImmutable : [],
            selectedDate: null
        };

        activate();
   
        function activate(){
            console.log("RateSettingController");
            fetchRate();
        }

        function initialFreeze(){
            if(!vm.model.firstFreeze){
                vm.model.roomsImmutable = JSON.parse(JSON.stringify(vm.model.rooms));
                vm.model.firstFreeze != vm.model.firstFreeze;
            }
        }

        function fetchRate(){
            var counter;

            rateManagementService.fetch().then(function (response){
                vm.model.rooms = response;

                angular.forEach(vm.model.rooms, function(room){
                    room.divId = room.name.replace(/\s+/g, '-').toLowerCase();
                    room.defaultRateEdit = false;
                    room.newSeasonalRate = {
                        id: room.id,
                        rate: null,
                        max_room: null,
                        date: null,
                        divId: room.divId,
                    };

                    counter = 1;
                    angular.forEach(room.seasonal_room_rate, function(seasonalRate){
                        seasonalRate.id = counter;
                        seasonalRate.divId = room.divId;
                        seasonalRate.day = moment(seasonalRate.target_date).format("dddd");
                        seasonalRate.date = moment(seasonalRate.target_date).format("DD-MM-YYYY");
                        seasonalRate.rate = seasonalRate.rate_per_room;
                        seasonalRate.version = seasonalRate.version;
                        seasonalRate.edit = false;

                        counter = counter + 1;
                    });
                });

                initialFreeze();
            })
        }

        function changeDefaultRateEditState(room){
            if(!room.defaultRateEdit){
                room.freeze = JSON.parse(JSON.stringify(room));
                room.defaultRateEdit = !room.defaultRateEdit;
                return;
            }

            room.rate = room.freeze.rate;
            room.max_room = room.freeze.max_room;
            room.defaultRateEdit = !room.defaultRateEdit;
        }

        function changeSeasonalRateEditState(seasonalRate){
            if(!seasonalRate.edit){
                seasonalRate.freeze = JSON.parse(JSON.stringify(seasonalRate));
                seasonalRate.edit = !seasonalRate.edit;
                return;
            }

            seasonalRate.date = seasonalRate.freeze.date;
            seasonalRate.rate = seasonalRate.freeze.rate;
            seasonalRate.max_room = seasonalRate.freeze.max_room;
            seasonalRate.version = seasonalRate.freeze.version;
            seasonalRate.edit = !seasonalRate.edit;
        }

        function deleteSeasonalRate(seasonalRate){

            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                rateManagementService.deleteSeasonalRate(seasonalRate).then(function (response){
                    swal(
                        'Deleted!',
                        'the selected date rate has been reverted to default.',
                        'success'
                    );
                    fetchRate();
                }, function(error){
                    // please do error handling
                });
            })
        }

        function editSeasonalRate(editedSeasonalRate){
            if(!isValidSeasonalEditRate(editedSeasonalRate)){ return; }

            var seasonalRate = {};
            seasonalRate.id = editedSeasonalRate.room_id;
            seasonalRate.rate = editedSeasonalRate.rate;
            seasonalRate.max_room = editedSeasonalRate.max_room;
            seasonalRate.date = editedSeasonalRate.target_date;

            rateManagementService.createSeasonalRate(seasonalRate).then(function (response){
                swal(
                    'congratulations!',
                    'You have successfully updated this room seasonal rate',
                    'success'
                );
                fetchRate();
            }, function(error){
                // please do error handling
            })
        }

        function saveDefaultRate(room){
            if(!isValidNewRate(room, 'default')){ return; }
            
            rateManagementService.createDefaultRate(room).then(function (response){
                swal(
                    'Congratulations!',
                    'You have successfully updated this room default rate',
                    'success'
                );
                fetchRate();
            }, function(error){
                // please do error handling
            })
        }

        function saveSeasonalRate(room){
            if(!isValidNewRate(room.newSeasonalRate, 'seasonal')){ return; }

            rateManagementService.createSeasonalRate(room.newSeasonalRate).then(function (response){
                swal(
                    'congratulations!',
                    'You have successfully created a new seasonal rate',
                    'success'
                );
                fetchRate();
            }, function(error){
                // please do error handling
            })
        }

        function isValidSeasonalEditRate(room){
            ASIATIC_HOTEL.func.inputError('seasonal-rate-edit-' + room.divId + '-' + room.id, false);
            ASIATIC_HOTEL.func.inputError('seasonal-max-room-edit-' + room.divId + '-' + room.id, false);

            if(!room.rate || +room.rate == +room.freeze.rate || isNaN(room.rate)){
                return ASIATIC_HOTEL.func.inputError('seasonal-rate-edit-' + room.divId + '-' + room.id, true);
            }

            if(!room.max_room || isNaN(room.max_room)){
                return ASIATIC_HOTEL.func.inputError('seasonal-max-room-edit-' + room.divId + '-' + room.id, true);
            }

            return true;
        }

        function isValidNewRate(room, type){
            ASIATIC_HOTEL.func.inputError(type + '-rate-' + room.divId, false);
            ASIATIC_HOTEL.func.inputError(type + '-max-room-' + room.divId, false);

            if(!room.rate || isNaN(room.rate)){
                return ASIATIC_HOTEL.func.inputError(type +'-rate-' + room.divId, true);
            }

            if(!room.max_room || isNaN(room.max_room)){
                return ASIATIC_HOTEL.func.inputError(type +'-max-room-' + room.divId, true);
            }

            if(type == 'default'){
                if(+room.freeze.rate == +room.rate){ 
                    return ASIATIC_HOTEL.func.inputError(type + '-rate-' + room.divId, true);
                }

                ASIATIC_HOTEL.func.inputError(type + '-rate-' + room.divId, false);
            }
            if(type == 'seasonal'){
                if(!room.date){ 
                    return ASIATIC_HOTEL.func.inputError(type + '-date-' + room.divId, true);
                }

                ASIATIC_HOTEL.func.inputError(type + '-date-' + room.divId, false);
            }

            return true;
        }

    }
})();