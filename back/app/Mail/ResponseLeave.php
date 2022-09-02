<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponseLeave extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $start_date;
    public $end_date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $start_date, $end_date)
    {
        $this->details = $details;
        $this->start_date = $start_date;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Leave request response')
            ->view('emails/ResponeLeaveMailView');
    }
}
