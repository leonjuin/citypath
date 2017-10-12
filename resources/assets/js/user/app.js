$(document).ready(function(){

    $('#booking_detail').hide()
    $('#initial_room').hide()
    $('#sidebar-total').hide()

    var url= window.location.pathname; 
    var url2 = window.location.pathname.split( '/' );
    $('.header_menu li a[href="' + '/' + url2[1] + '"]').addClass('current-menu-item');        
    $('.reservation_step ul li a[href="' + url + '"]').addClass('current-item');


    $('.reservation-room_package').hide()
    $('#date-from').datepicker({
        prevText: '<i class="lotus-icon-left-arrow"></i>',
        nextText: '<i class="lotus-icon-right-arrow"></i>',
        buttonImageOnly: false,
        minDate: 0,
        onClose: function (selectedDate) {
            var choosenDate = moment(selectedDate),
                choosenDateTomorrow = moment(selectedDate).add(1, 'day').format("MM/DD/YYYY");
            $(".dateto").datepicker("option", "minDate", choosenDateTomorrow).focus();
        }
    });

    $("#date-to").datepicker({
        prevText: '<i class="lotus-icon-left-arrow"></i>',
        nextText: '<i class="lotus-icon-right-arrow"></i>',
        buttonImageOnly: false,
        minDate: 0,
        onClose: function (selectedDate) {
            //$(".awe-calendar.from").datepicker( "option", "maxDate", selectedDate );
        }
    });

    

})