<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use App\Models\BookingItem;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking, $bookingItems, $bookingContact, $recipient)
    {
        $this->booking = $booking;
        $this->bookingItems = $bookingItems;
        $this->bookingContact = $bookingContact;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = Carbon::createFromFormat('Y-m-d', $this->booking->check_in);
        $to = Carbon::createFromFormat('Y-m-d', $this->booking->check_out);
        $bookingRef = strtoupper($this->booking->booking_ref);

        return $this->markdown('emails.invoice')
                    ->subject("Confirmation for Booking ID #{$bookingRef} Check-in {$from->toFormattedDateString()}")
                    ->with([
                        'booking' => $this->booking,
                        'bookingItems' => $this->bookingItems,
                        'bookingContact' => $this->bookingContact,
                        'recipient' => $this->recipient,
                        'totalNight' => $to->diffInDays($from)
                    ]);
    }
}
