<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PublishedProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    // istanzio una variablie protected
    protected $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //  nel construct passo Project come parametro
    public function __construct(Project $project)
    {
        // rendo disponibile project per poterne passare i valori nella view della public function content()
        $this->project = $project;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Published Project Mail from' .  env('APP_NAME'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            // restituisco la view del file con dei parametri da stampare
            markdown: 'mail.projects.published',
            with: [
                // passo il project al file published,blade.php
                'project' => $this->project
            ]
        );
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
