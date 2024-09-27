<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hello@hotelname.com')
                    ->subject('Booking Info: Hotel Name')
                    ->attach(public_path($this->data['pdf']), [
                            'as' => 'Hotel Name - Booking Receipt.pdf',
                            'mime' => 'application/pdf',
                        ])
                    ->view('email.booking')
                    ->with($this->data);
    }
}
