@component('mail::message')
Dear {{ title_case($bookingContact->first_name) }} {{ title_case($bookingContact->last_name) }},<br><br>
**Your booking is confirmed and completed!**
**Your booking ID is {{ strtoupper($booking->booking_ref) }}**
<hr><br>
<h1 style="color:#3CB371">Booking Details</h1>

@component('mail::panel')
**Lead Guest** : {{ title_case($bookingContact->first_name) }} {{ title_case($bookingContact->last_name) }} <br>
**Booking ID** : {{ strtoupper($booking->booking_ref) }}<br>
**Reservations** : {{ $booking->total_room }} Room, {{ $totalNight }} Night<br>
**Occupancy** : {{ $booking->total_guest }}<br><br>

@for($counter = 0; $counter < count($bookingItems); $counter++)
**Room {{$counter + 1}}** : {{title_case($bookingItems[$counter]["room_name"])}}<br>
@endfor

<br>

**Special request** : {{ $booking->guest_remark }}<br>
@endcomponent


@component('mail::panel')
**Check In**:<br>
{{ $booking->check_in }} (after 03:00 PM)<br><br>
**Check Out** :<br>
{{ $booking->check_out }} (before 12:00 PM)
@endcomponent


<br><br>Thanks,<br>
**Asiatic Hotel Booking Team**<br>
+606-775-6888<br>
2E Jalan KLJ 4<br>
Taman Kota Laksamana Jaya<br>
75200, Melaka, Malaysia
@endcomponent

