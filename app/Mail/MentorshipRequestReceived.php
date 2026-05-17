<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\MentorshipRequest;
use App\Models\Startup;

class MentorshipRequestReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $mentorshipRequest;
    public $startup;

    /**
     * Create a new message instance.
     */
    public function __construct(MentorshipRequest $mentorshipRequest, Startup $startup)
    {
        $this->mentorshipRequest = $mentorshipRequest;
        $this->startup = $startup;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Mentorship Request from ' . $this->startup->startup_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.mentorship-request',
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
