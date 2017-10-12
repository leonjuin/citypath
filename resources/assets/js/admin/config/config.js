(function () {
    'use strict';

    /**
     * Config block
     */
    angular
            .module('app')
            .config(configure);

    configure.$inject = ['$httpProvider'];


    /**
     * App config for everything except routing
     */
    function configure($httpProvider) {        
        configureTokenExpiryCheck();
        
        ////////////////

        /**
         * Token expiration check
         */
        function configureTokenExpiryCheck() {
            $httpProvider.interceptors.push(['$q', '$injector', '$window', 'APP_CONFIG',
                function ($q, $injector, $window, APP_CONFIG) {
                    return {
                        responseError: function (rejection) {
                            if (rejection.status === 401) {
                                return;
                                $window.location.href = '/admin/logout';
                            }

                            // If not a 401, do nothing with this error
                            return $q.reject(rejection);
                        }
                    };
                }
            ]);
        }

        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        $httpProvider.defaults.headers.common["X-CSRF-TOKEN"] = $("body").data("csrf");
        
        //$httpProvider.defaults.xsrfHeaderName = 'X-CSRF-TOKEN';

        /**
         * Prevent IE11's unwanted caching of AJAX calls
         */

        // Initialize get if not there
        if (!$httpProvider.defaults.headers.get) {
            $httpProvider.defaults.headers.get = {};
        }         
        // Disable IE ajax request caching
        $httpProvider.defaults.headers.get['If-Modified-Since'] = 'Mon, 26 Jul 1997 05:00:00 GMT';
        $httpProvider.defaults.headers.get['Cache-Control'] = 'no-cache';
        $httpProvider.defaults.headers.get['Pragma'] = 'no-cache';

        

    }

})();