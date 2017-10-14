(function () {
    'use strict';

    /**
     * App constants
     */
    angular
            .module('app')
            .constant('APP_CONFIG', {
                cdnStatic: 'https://xxx.cloudfront.net',
                apiPath: '/api/admin',
                baseUrl: $("body").data("base-url"),
                imgPath: '/assets/images',
            });

})();