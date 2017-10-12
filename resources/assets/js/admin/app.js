(function () {
    'use strict';
    window.ASIATIC_HOTEL = {
        constants: {}
    };
    ASIATIC_HOTEL.app = {
        init: function () {
            localStorage.setItem('env', $("body").data("env"));        
        },
    };

    ASIATIC_HOTEL.func = {
        breadcrumb: function(items){
            var html = [];
            items.forEach(function(item) {
                html.push([
                    '<li '+p(item.active, 'class="active"')+'>',
                       p(item.link, '<a href="'+item.link+'">'),
                            item.name,
                       p(item.link, '</a>'),
                    '</li>',
                ].join(''));
            });
            $('ol.breadcrumb').html(html.join(''));
            $('#sidebar-menu li.has_sub>a').removeClass('active subdrop');
            $('#sidebar-menu li.has_sub li a').removeClass('active');
            function p(flag, string){
                return flag?string:'';
            }
        },  

        sidebarSub: function(primary, secondary){
            $('#sidebar-menu li.has_sub>a').removeClass('active subdrop');
            $('#sidebar-menu li.has_sub li a').removeClass('active');
            
            $('#sidebar-menu li.'+primary+'.has_sub>a').addClass('active subdrop');
            $('#sidebar-menu li.'+primary+'.has_sub li.'+secondary+' a').addClass('active');
        },  
        
        alerror: function(error){
            var alerror = $('.alert.alert-danger');
            alerror.removeClass().addClass('alert alert-danger');
            if(error){
                console.log(['error', error]);

                alerror.removeClass().addClass('alert alert-danger error');
                if(typeof error === 'object'){
                    switch(error.status){
                        case 500: alerror.addClass('e-unexpected'); break;
                        case 404: alerror.addClass('e-api-not-found'); break;
                        default: alerror.addClass(error.data); console.log(alerror);
                    }                    
                }else{
                    alerror.addClass(error);
                }

                return false;
            }
        },

        inputError: function(id, isError){
            if(isError){
                $('#'+id).css('border-color', '#fbafaf');
                return;
            }
            $('#'+id).css('border-color', 'transparent');
        },

        inputErrorByClass: function(className, isError){
            if(isError){
                $('.'+  className).css('border-color', '#fbafaf');
                return;
            }
            $('.'+ className).css('border-color', 'transparent');
        },

    };

})();




