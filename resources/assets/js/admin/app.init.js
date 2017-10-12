(function () {
    'use strict';

    // Initialise JS
    $(function() {
        var touchsupport;

        //set environment for website use
        //PIONER_STORE.csrf = $("body").data("csrf");

        ASIATIC_HOTEL.constants.website_env = $("body").data("env");
        
        // Set general data from PHP
        if ($("#js-data").text() !== '') {
            ASIATIC_HOTEL.constants.data = $.parseJSON($("#js-data").text());
        } else {
            ASIATIC_HOTEL.constants.data = {};
        }

/*
        touchsupport = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0);
        if (!touchsupport){ // browser doesn't support touch
            $("body").addClass("non-touch");
        }  
*/      
        
        ASIATIC_HOTEL.app.init();
    });

    window.console.logEnable = function(){
        return;
    };

})();