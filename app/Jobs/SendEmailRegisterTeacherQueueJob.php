<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailRegisterTeacher;
use Mail;


class SendEmailRegisterTeacherQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $send_email;
    public $password;

    /**
     * Create a new job instance.
     */
    public function __construct($send_email,$password)
    {
        $this->send_email = $send_email;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendEmailRegisterTeacher($this->password);
        Mail::to($this->send_email)->send($email);
    }
}
