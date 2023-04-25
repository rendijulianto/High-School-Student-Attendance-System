<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
// Address
use Illuminate\Mail\Mailables\Address;

class SendEmailRegisterTeacher extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $teacher;

    /**
     * Create a new message instance.
     */
    public function __construct($teacher, $password)
    {
        $this->password = $password;
        $this->teacher = $teacher;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@kebutuhansosmed.com', 'Sistem Pencatatan Kehadiran Siswa'),
            subject: 'Selamat Datang di Aplikasi Pencatatan Kehadiran Siswa',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.register-teacher',
            with: [
                'teacher' => $this->teacher,
                'password' => $this->password,
            ],
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
