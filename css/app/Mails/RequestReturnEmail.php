<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestReturnEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.request-return')
            ->with("details", $this->details)
            ->to($this->details['email_admin'])
            ->from($this->details['email_admin'], $this->details['name_email_admin'])
            ->subject($this->details['subject_default']);
    }
}
