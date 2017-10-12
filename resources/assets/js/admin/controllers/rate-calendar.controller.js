(function () {
    'use strict';

    /**
     * RateCalendarController
     */
    angular
            .module('app')
            .controller('RateCalendarController', RateCalendarController);

    RateCalendarController.$inject = [
        '$timeout', '$scope', '$window',
        'APP_CONFIG','$location', 'rateManagementService', 'reportService', 'roomService'
    ];

    function RateCalendarController($timeout, $scope, $window, APP_CONFIG, $location, rateManagementService, reportService, roomService) {
        var vm = this;
        vm.APP_CONFIG = APP_CONFIG;

        vm.monthNow = moment();
        vm.monthNextOne = moment().startOf('month').add(1, 'months').startOf('month');
        vm.monthNextTwo = moment().startOf('month').add(2, 'months').startOf('month');
        vm.monthNextThree = moment().startOf('month').add(3, 'months').startOf('month');
        vm.monthNextFour = moment().startOf('month').add(4, 'months').startOf('month');
        vm.monthNextFive = moment().startOf('month').add(5, 'months').startOf('month');

        vm.fetchBookingReportByMonth = fetchBookingReportByMonth;
        vm.refetchBookingReport = refetchBookingReport;

        vm.model = {
            selectedRoomId: null,
            selectedMonth: '',
            firstFreeze: false,
            rooms : [],
            roomsImmutable : [],
            selectedDate: null,
            month: {
                now: null,
                nextOne: null,
                nextTwo: null,
                nextThree: null,
                nextFour: null,
                nextFive: null,
            },
            report: [],
            reportSummary: {},
        };

        activate();
   
        function activate(){
            console.log("RateCalendarController");
            setMonths();
            fetchRoom();
        }

        function setMonths(){
            vm.model.month.now = vm.monthNow.format('MMMM YYYY');
            vm.model.month.nextOne = vm.monthNextOne.format('MMMM YYYY');
            vm.model.month.nextTwo = vm.monthNextTwo.format('MMMM YYYY');
            vm.model.month.nextThree = vm.monthNextThree.format('MMMM YYYY');
            vm.model.month.nextFour = vm.monthNextFour.format('MMMM YYYY');
            vm.model.month.nextFive = vm.monthNextFive.format('MMMM YYYY');
        }

        function initialFreeze(){
            if(!vm.model.firstFreeze){
                vm.model.roomsImmutable = JSON.parse(JSON.stringify(vm.model.rooms));
                vm.model.firstFreeze != vm.model.firstFreeze;
            }
        }

        function fetchBookingReportByMonth(date, roomId){
            var formattedDate, totalSales, totalBooked;

            vm.model.selectedRoomId = roomId;
            vm.model.selectedDate = date;
            vm.model.selectedMonth = date.format("MMMM YYYY");
            formattedDate = date.format("YYYY-MM-DD");

            reportService.fetchBookingReportByMonth(formattedDate, roomId).then(function (response){
                vm.model.report = response;
                totalSales = 0;
                totalBooked = 0;

                angular.forEach(vm.model.report, function(report){
                    report.day = moment(report.date).format("dddd");
                    report.sales = +report.total_booked * +report.rate_per_room;

                    totalSales = totalSales + +report.sales;
                    totalBooked = totalBooked + +report.total_booked;
                })

                vm.model.reportSummary.roomBooked = totalBooked;
                vm.model.reportSummary.totalSales = totalSales;

            }, function(error){
                // to be handled
            });
        }

        function refetchBookingReport(roomId){
            if(!vm.model.selectedDate){ return; }
            if(vm.model.selectedRoomId == roomId){ return; }

            fetchBookingReportByMonth(vm.model.selectedDate, roomId)
        }

        function fetchRoom(){
            roomService.fetch().then(function (response){
                vm.model.rooms = response;

                angular.forEach(vm.model.rooms, function(room){
                    room.divId = room.name.replace(/\s+/g, '-').toLowerCase();
                })

                initialFreeze();
                fetchBookingReportByMonth(vm.monthNow, vm.model.rooms[0].id);
            }, function(error){
                // to be handled
            });
        }
    }
})();