(function () {
    'use strict';

    // Initialise JS
    $(function() {
        var touchsupport;

        //set environment for website use
        //PIONER_STORE.csrf = $("body").data("csrf");

        CITYPATH.constants.website_env = $("body").data("env");
        
        // Set general data from PHP
        if ($("#js-data").text() !== '') {
            CITYPATH.constants.data = $.parseJSON($("#js-data").text());
        } else {
            CITYPATH.constants.data = {};
        }

/*
        touchsupport = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0);
        if (!touchsupport){ // browser doesn't support touch
            $("body").addClass("non-touch");
        }  
*/      
        
        CITYPATH.app.init();
    });

    window.console.logEnable = function(){
        return;
    };

})();