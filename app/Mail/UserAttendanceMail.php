<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserAttendanceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dataArray;
    /**
     * Create a new message instance.
     */
    public function __construct($dataArray)
    {
        $this->dataArray = $dataArray;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $username = auth()->user()->firstname . ' ' . auth()->user()->lastname;
        return new Envelope(
            subject: "Your Attendance Updated By $username",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.user-attendance-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
