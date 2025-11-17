<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $object;
    public $messagecontent;
    public $atache;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($object, $message, $user, $atache = null)
    {
        //
        $this->object = (string) $object;
        $this->messagecontent = (string) $message;
        $this->atache = $atache;
        $this->user = (string) $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.index',  // Vue qui affiche le contenu
            with: [
                'messagecontent' =>  $this->messagecontent,  // Convertir en chaîne de caractères
                'object' =>  $this->object,    // Convertir en chaîne de caractères
                'user' =>  $this->user,    // Convertir en chaîne de caractères
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
        if ($this->atache) {
            return [
                Attachment::fromPath($this->atache)
                    ->as('attachment.pdf')
                    ->withMime('application/pdf'),
            ];
        }

        return [];
    }
}
