<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendTicketEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $ticket;
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tiket Qurban - ' . $this->ticket->distribution->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.ticketEmail',
            with: [
                "distribusi" => $this->ticket->distribution->name,
                "date_expired" => $this->ticket->distribution->end_date,
                "ticket" => $this->ticket
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        $path = Storage::disk("public")->path($this->ticket->qr_code_path);

        return [
            Attachment::fromPath($path)
                ->as("qrcode-" . $this->ticket->household->nomor_kk . ".png")
                ->withMime("image/png")
        ];
    }
}
