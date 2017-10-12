(function () {
    'use strict';
    /**
     * App
     */
    angular
            .module('app', [
                'ngAnimate',
                'ngSanitize',
                'ngRoute',
                'ngCookies',
                'ngFileUpload',
                'angularMoment',
                'mwl.calendar',
            ]);

    angular.module('app')
        .config(['calendarConfig', function(calendarConfig) {
           calendarConfig.dateFormatter = 'moment';
           calendarConfig.allDateFormats.moment.date.hour = 'HH:mm';
           calendarConfig.allDateFormats.moment.title.day = 'ddd D MMM';
           calendarConfig.i18nStrings.weekNumber = 'Week {week}';
        }]);
})();