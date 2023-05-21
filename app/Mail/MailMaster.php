<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailMaster extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The order instance.
     *

     */
    public $credentials;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Mail Master',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return $this
     */
    public function build()
    {
        $detail = $this->credentials;
        return $this->subject($detail['subject'])->view('mails.email_template',compact('detail'));
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
