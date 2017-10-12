@extends('layouts.default')
@section('title', 'Choose Room')
@section('content')
    @include('includes.reservation-header')
                <div class="row">
                        <div class="col-md-4 col-lg-3">

                            <div class="reservation-sidebar">

                                <!-- SIDEBAR AVAILBBILITY -->
                                <div class="apb-sidebar">

                        <!-- HEADING -->
                        <h2 class="apb-heading">YOUR RESERVATION</h2>
                        <!-- END / HEADING -->
                        
                        <!-- SIDEBAR CONTENT -->
                        <div class="apb-sidebar_content">
                            <h3 class="apb-sidebar_title"><i class="fa fa-caret-right"></i>your stay dates</h3>

                            <div class="apb-field">
                                <label>Arrive</label>
                                <input type="text" class="apb-calendar apb-input">
                            </div>

                            <div class="apb-field">
                                <label>Night</label>
                                <select class="apb-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>

                            <div class="apb-field">
                                <label>Depature</label>
                                <input type="text" class="apb-calendar apb-input">
                            </div>

                            <h3 class="apb-sidebar_title"><i class="fa fa-caret-right"></i>ROOMS &amp; GUest</h3>

                            <div class="apb-field">
                                <label>ROOMS</label>
                                <select class="apb-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>

                            <div class="apb-sidebar_group">

                                <span class="label-group">ROOM 1</span>

                                <div class="apb-field_group">

                                    <div class="apb-field">
                                        <label>Adult</label>
                                        <select class="apb-select">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>

                                    <div class="apb-field">
                                        <label>Chirld</label>
                                        <select class="apb-select">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>

                                </div>

                            </div>

                            <div class="apb-sidebar_group">
                                
                                <span class="label-group">ROOM 2</span>

                                <div class="apb-field_group">

                                    <div class="apb-field">
                                        <label>Adult</label>
                                        <select class="apb-select">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>
                                    
                                    <div class="apb-field">
                                        <label>Chirld</label>
                                        <select class="apb-select">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <button class="apb-btn">CHECK AVAILABLE</button>

                        </div>
                        <!-- END / SIDEBAR CONTENT -->

                    </div>
                    
                                <form class="choose-room-form">
                                <div class="reservation-sidebar_availability bg-gray">

                                    <!-- HEADING -->
                                    <h2 class="reservation-heading">YOUR RESERVATION</h2>
                                    <!-- END / HEADING -->

                                    <h6 class="check_availability_title">your stay dates</h6>
                                        
                                    <div class="check_availability-field">
                                        <label>Check In</label>
                                        <input id="arrival" onchange="checkRates();" type="text" class="awe-calendar awe-input from" placeholder="Check In" autofocus>
                                    </div>
                                    
                                    <div class="check_availability-field">
                                        <label>Check Out</label>
                                        <input id="departure" onchange="checkRates();" type="text" class="awe-calendar awe-input to" placeholder="Check Out" >
                                    </div>
                                    
                                    <span id="totalnights"></span>

                                    <h6 class="check_availability_title">ROOMS</h6>
                                    
                                    <div class="check_availability-field">
                                        <label>ROOMS</label>
                                        <select id="numberofrooms" class="awe-select" onchange="checkRates();">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    
                                    <button id="btn-13" class="awe-btn awe-btn-13" type="submit">BOOK YOUR STAY</button>
                                </div>
                                <!-- END / SIDEBAR AVAILBBILITY -->
                                </form> 
                            </div>

                        </div>
                        
                        <div class="col-md-8 col-lg-9">
                            <div class="reservation_content" id="reservation_content">
                                
                                <!-- RESERVATION ROOM -->
                                <div class="reservation-room">

                                    <!-- ITEM -->
                                    <div class="reservation-room_item">

                                        <h2 class="reservation-room_name"><a href="#">Deluxe Triple</a></h2>

                                        <div class="reservation-room_img">
                                            <a href="#"><img src="/templates/lotus/assets/images/reservation/deluxe-triple.jpg" alt=""></a>
                                        </div>

                                        <div class="reservation-room_text">

                                            <div class="reservation-room_desc">
                                                <p>Delight in the added space and comfort of a Deluxe Triple Room at our 4-star hotel in Malacca, complete with a king-sized bed, a single bed, an executive work area and complimentary Internet access.</p>
                                                <ul>
                                                    <li>1 King Bed + 1 Single Bed</li>
                                                    <li>Free Wi-Fi in all guest rooms</li>    
                                                </ul>
                                            </div>

                                            <a href="#" class="reservation-room_view-more">View More Infomation</a>

                                            <div class="clear"></div>

                                            <div class="row col-sm-12">
                                                <div class="col-sm-6">
                                                    <p class="reservation-room_price"><span class="reservation-room_amout" id="room_1"></span><span id="stayfor"></span>
                                                    </p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <ul class="list-inline total-rooms">
                                                        <li class="total-input btn-minus"><button type="button" class="btn total-input-inner min" field="qty_1"><span class="glyphicon glyphicon-minus"></span></button></li>
                                                        <li class="total-input middle"><input class="total-input-inner text-center" type="number" id="qty_1" name="qty_1" value="0" min="0" onchange="checkRates()" disabled></li>
                                                        <li class="total-input btn-plus"><button type="button" class="btn total-input-inner plus" field="qty_1"><span class="glyphicon glyphicon-plus"></span></button></li>
                                                      </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="reservation-room_package qty_1">
                                            <span class="reservation-room_package-more collapsed">Number of Adults and Children</span>
                                            <div class="reservation-room_package-content">
                                                <div class="reservation-package_item" id="type_qty_1">
                                                    <div class="row guest">
                                                        <div class="col-sm-6 adults">
                                                            <span>Adults</span>
                                                            <select class="adults-btn awe-btn awe-btn-default">
                                                                        <option selected>0</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-sm-6 children">
                                                            <span>Children</span>
                                                            <select class="children-btn awe-btn awe-btn-default">
                                                                        <option selected>0</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                            </select>
                                                        
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END / ITEM -->

                                    <!-- ITEM -->
                                    <div class="reservation-room_item">

                                        <h2 class="reservation-room_name"><a href="#">Superior Queen</a></h2>

                                        <div class="reservation-room_img">
                                            <a href="#"><img src="/templates/lotus/assets/images/reservation/superior-queen.jpg" alt=""></a>
                                        </div>

                                        <div class="reservation-room_text">

                                            <div class="reservation-room_desc">
                                                <p>Delight in the added space and comfort of a Superior Queen Room at our 4-star hotel in Malacca, complete with a queen-sized bed, an executive work area and complimentary Internet access.</p>
                                                <ul>
                                                    <li>1 Queen Bed</li>
                                                    <li>Free Wi-Fi in all guest rooms</li>
                                                     
                                                </ul>
                                            </div>

                                            <a href="#" class="reservation-room_view-more">View More Infomation</a>

                                            <div class="clear"></div>

                                            <div class="row col-sm-12">
                                                <div class="col-sm-6">
                                                    <p class="reservation-room_price">
                                                        <span class="reservation-room_amout" id="room_2"></span><span id="stayfor"></span>
                                                    </p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <ul class="list-inline total-rooms">
                                                        <li class="total-input btn-minus"><button type="button" class="btn total-input-inner min" field="qty_2"><span class="glyphicon glyphicon-minus"></span></button></li>
                                                        <li class="total-input middle"><input class="total-input-inner text-center" type="number" id="qty_2" name="qty_2" value="0" min="0"  onchange="checkRates()" disabled></li>
                                                        <li class="total-input btn-plus"><button type="button" class="btn total-input-inner plus" field="qty_2"><span class="glyphicon glyphicon-plus"></span></button></li>
                                                      </ul>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                         </div>

                                            <div class="reservation-room_package qty_2">
                                                <span class="reservation-room_package-more collapsed">Number of Adults and Children</span>
                                                <div class="reservation-room_package-content">
                                                    <div class="reservation-package_item" id="type_qty_2">
                                                        <div class="row guest">
                                                            <div class="col-sm-6 adults">
                                                                <span>Adults</span>
                                                                <select class="adults-btn awe-btn awe-btn-default">
                                                                            <option selected>0</option>
                                                                            <option>1</option>
                                                                            <option>2</option>
                                                                            <option>3</option>
                                                                            <option>4</option>
                                                                        </select>
                                                            </div>

                                                            <div class="col-sm-6 children">
                                                                <span>Children</span>
                                                                <select class="children-btn awe-btn awe-btn-default">
                                                                            <option selected>0</option>
                                                                            <option>1</option>
                                                                            <option>2</option>
                                                                            <option>3</option>
                                                                            <option>4</option>
                                                                </select>
                                                            
                                                             </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- END / ITEM -->

                                    <!-- ITEM -->
                                    <div class="reservation-room_item">

                                        <h2 class="reservation-room_name"><a href="#">Superior King</a></h2>

                                        <div class="reservation-room_img">
                                            <a href="#"><img src="templates/lotus/assets/images/reservation/superior-king.jpg" alt=""></a>
                                        </div>

                                        <div class="reservation-room_text">

                                            <div class="reservation-room_desc">
                                                <p>Delight in the added space and comfort of a Superior King Room at our 4-star hotel in Malacca, complete with a king-sized bed, an executive work area and complimentary Internet access.</p>
                                                <ul>
                                                    <li>1 King Bed</li>
                                                    <li>Free Wi-Fi in all guest rooms</li>
                                                     
                                                </ul>
                                            </div>

                                            <a href="#" class="reservation-room_view-more">View More Infomation</a>

                                            <div class="clear"></div>

                                           
                                            <div class="row col-sm-12">
                                                <div class="col-sm-6">
                                                    <p class="reservation-room_price">
                                                        <span class="reservation-room_amout" id="room_3"></span><span id="stayfor"></span>
                                                    </p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <ul class="list-inline total-rooms">
                                                        <li class="total-input btn-minus"><button type="button" class="btn total-input-inner min" field="qty_3"><span class="glyphicon glyphicon-minus"></span></button></li>
                                                        <li class="total-input middle"><input class="total-input-inner text-center" type="number" id="qty_3" name="qty_3" value="0" min="0"  onchange="checkRates()" disabled></li>
                                                        <li class="total-input btn-plus"><button type="button" class="btn total-input-inner plus" field="qty_3"><span class="glyphicon glyphicon-plus"></span></button></li>
                                                      </ul>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>

                                        <div class="reservation-room_package qty_3">
                                            <span class="reservation-room_package-more collapsed">Number of Adults and Children</span>
                                            <div class="reservation-room_package-content" id="type_qty_3">
                                                <div class="reservation-package_item">
                                                    <div class="row guest">
                                                        <div class="col-sm-6 adults">
                                                            <span>Adults</span>
                                                            <select class="adults-btn awe-btn awe-btn-default">
                                                                        <option selected>0</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                    </select>
                                                        </div>

                                                        <div class="col-sm-6 children">
                                                            <span>Children</span>
                                                            <select class="children-btn awe-btn awe-btn-default">
                                                                        <option selected>0</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                            </select>
                                                        
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- END / ITEM -->

                                    <!-- ITEM -->
                                    <div class="reservation-room_item">

                                        <h2 class="reservation-room_name"><a href="#">Suite Room</a></h2>

                                        <div class="reservation-room_img">
                                            <a href="#"><img src="/templates/lotus/assets/images/reservation/suite-room.jpg" alt=""></a>
                                        </div>

                                        <div class="reservation-room_text">

                                            <div class="reservation-room_desc">
                                                <p>Delight in the added space and comfort of a Suite Room at our 4-star hotel in Malacca, complete with a king-sized bed, a single bed, an executive work area and complimentary Internet access.</p>
                                                <ul>
                                                    <li>1 King Bed</li>
                                                    <li>Free Wi-Fi in all guest rooms</li>
                                                    <li>Separate sitting area</li>
                                                     
                                                </ul>
                                            </div>

                                            <a href="#" class="reservation-room_view-more">View More Infomation</a>

                                            <div class="clear"></div>
                                             
                                            <div class="row col-sm-12">
                                                <div class="col-sm-6">
                                                    <p class="reservation-room_price">
                                                        <span class="reservation-room_amout" id="room_4"></span><span id="stayfor"></span>
                                                    </p>
                                                </div>
                                                <div class="col-sm-6 total-rooms">
                                                    <ul class="list-inline">
                                                        <li class="total-input btn-minus"><button type="button" class="btn total-input-inner min" field="qty_4"><span class="glyphicon glyphicon-minus"></span></button></li>
                                                        <li class="total-input middle"><input class="total-input-inner text-center" type="number" id="qty_4" name="qty_4" value="0" min="0"  onchange="checkRates()" disabled></li>
                                                        <li class="total-input btn-plus"><button type="button" class="btn total-input-inner plus" field="qty_4"><span class="glyphicon glyphicon-plus"></span></button></li>
                                                      </ul>
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>

                                        <div class="reservation-room_package qty_4">
                                            <span class="reservation-room_package-more collapsed">Number of Adults and Children</span>
                                            <div class="reservation-room_package-content" id="type_qty_4">
                                                <div class="reservation-package_item">
                                                    <div class="row guest">
                                                        <div class="col-sm-6 adults">
                                                            <span>Adults</span>
                                                            <select class="adults-btn awe-btn awe-btn-default">
                                                                        <option selected>0</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                    </select>
                                                        </div>

                                                        <div class="col-sm-6 children">
                                                            <span>Children</span>
                                                            <select class="children-btn awe-btn awe-btn-default">
                                                                        <option selected>0</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                            </select>
                                                        
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- END / ITEM -->

                                </div>
                                <!-- END / RESERVATION ROOM -->
                            </div>
                        </div>  
                        
                    </div>
                </div>
            </div>

        </section>
        <!-- END / RESERVATION -->
<script>

    // function totalRoomType() {
    //     console.log('total room type heheheheheheheheh');
    //     var total_rooms = localStorage.getItem('numberofrooms');
    //     console.log("total rooms" + total_rooms);
    //     var total_room_type = 0;
    //     total_room_type = parseInt($('#qty_1').val()) + parseInt($('#qty_2').val()) + parseInt($('#qty_3').val()) + parseInt($('#qty_4').val());
    //     console.log("total room type" +  total_room_type);
    //     if(total_room_type == total_rooms){
    //         $('#btn-13').removeClass('disabledcontent');
    //     }
    //     else {
    //          $('#btn-13').addClass('disabledcontent');
    //     }
    //     $('#room_1').empty().append('RM ' + localStorage.getItem('room_1')).show();
    //     $('#room_2').empty().append('RM ' + localStorage.getItem('room_2')).show();
    //     $('#room_3').empty().append('RM ' + localStorage.getItem('room_3')).show();
    //     $('#room_4').empty().append('RM ' + localStorage.getItem('room_4')).show();


    // 

    function checkRates() {
        localStorage.removeItem('numberofrooms');
        var arrival = $('#arrival').val();
        var departure = $('#departure').val();
        var numberofrooms = $('#numberofrooms').val();
        if(arrival != "" && departure == ""){
            var date2 = $('#arrival').datepicker('getDate', '+1d'); 
            date2.setDate(date2.getDate()+1); 
            var month = date2.getMonth() +1;
            if( month < 10){
                month = '0' + month;
                console.log(month);
            }
            var new_departure= month+ "/" +(date2.getDate()) + "/" + (date2.getFullYear());
            $('#departure').val(new_departure);
        }
        if(arrival != "" && departure != "" && numberofrooms > 0){
            localStorage.setItem('numberofrooms', numberofrooms);
            var totalnights = Math.ceil(Math.abs(new Date(departure) - new Date(arrival)) / (1000 * 3600 * 24));
            var arrivalmonth = arrival.substr(0,2);
            var departuremonth = departure.substr(0,2);
            var arrivalDate = arrival.substr(3,2);
            var departureDate = departure.substr(3,2);
            var arrivalYear= arrival.substr(6,4);
            var departureYear = departure.substr(6,4);
            var totalnights = Math.ceil(Math.abs(new Date(departure) - new Date(arrival)) / (1000 * 3600 * 24));
            arrival = arrivalYear + "-" + arrivalmonth + "-" + arrivalDate;
            departure = departureYear + "-" + departuremonth + "-" + departureDate;

            if( totalnights > 0) {
                $('#totalnights').empty().append("<br>*for " + totalnights + " night(s)</i>");
            }

            var totalPrice = 0;
            var totalamount = {};
            totalamount[1]=0;
            totalamount[2]=0;
            totalamount[3]=0;
            totalamount[4]=0;

            var price =[];
              $.ajax({
                    url: '/api/rooms/rate?from='+ arrival + '&to=' + departure,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            $('#reservation_content').removeClass('disabledcontent');
                            delete response.rate[departure];
                            console.log(response.rate[departure]);
                            $.each(response.rate, function(k, v) {
                                $.each(v, function(i, j){
                                     switch(j.room_id){
                                        case 1:
                                            price.push(parseInt(j.rate_per_room));
                                            totalamount[j.room_id] += parseInt(j.rate_per_room);
                                            price = [];
                                            localStorage.setItem('room_1', totalamount[j.room_id]);
                                            break;
                                        case 2:
                                            price.push(parseInt(j.rate_per_room));
                                            totalamount[j.room_id] += parseInt(j.rate_per_room);
                                            price = []
                                            localStorage.setItem('room_2', totalamount[j.room_id]);
                                            break;
                                        case 3:
                                            price.push(parseInt(j.rate_per_room));
                                            totalamount[j.room_id] += parseInt(j.rate_per_room);
                                            price = []
                                            localStorage.setItem('room_3', totalamount[j.room_id]);
                                            break;
                                        case 4:
                                            price.push(parseInt(j.rate_per_room));
                                            totalamount[j.room_id] += parseInt(j.rate_per_room);
                                            price = [];
                                            localStorage.setItem('room_4', totalamount[j.room_id]);
                                            break;
                                            
                                    }

                                });

                            });
    
                           localStorage.setItem('numberofrooms', numberofrooms);
                           $('#room_1').empty().append('RM ' + localStorage.getItem('room_1')).show();
                           $('#room_2').empty().append('RM ' + localStorage.getItem('room_2')).show();
                           $('#room_3').empty().append('RM ' + localStorage.getItem('room_3')).show();
                           $('#room_4').empty().append('RM ' + localStorage.getItem('room_4')).show();
         
                                //window.location = "/reservation/book-your-stay";

                           var total_rooms = localStorage.getItem('numberofrooms');
                           var total_room_type = 0;
                            total_room_type = parseInt($('#qty_1').val()) + parseInt($('#qty_2').val()) + parseInt($('#qty_3').val()) + parseInt($('#qty_4').val());
                            if(total_room_type == total_rooms){
                                $('#btn-13').removeClass('disabledcontent');
                            }
                            else {
                                 $('#btn-13').addClass('disabledcontent');
                            }

                            if( ($('#qty_1').val() > 1 )|| ($('#qty_2').val() > 1) || ($('#qty_3').val()>1) || ($('#qty_4').val() > 1 )){

                                var room = [];

                                for(var i = 1; i<=4; i++){
                                    room[i] = localStorage.getItem('room_'+ i)* parseInt($('#qty_' + i).val());
                                    localStorage.setItem('room_' + i, room[i]);
                                }

                                $('#room_1').empty().append('RM ' + localStorage.getItem('room_1')).show();
                                $('#room_2').empty().append('RM ' + localStorage.getItem('room_2')).show();
                                $('#room_3').empty().append('RM ' + localStorage.getItem('room_3')).show();
                                $('#room_4').empty().append('RM ' + localStorage.getItem('room_4')).show();
                            }
                        }, 
                        error: function(status){
                            console.log(status);
                        }
                    });
                    
        }
    }
</script>

@stop

