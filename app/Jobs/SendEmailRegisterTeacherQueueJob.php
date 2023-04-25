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
use App\Models\Teacher;


class SendEmailRegisterTeacherQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $teacher;
    public $password;

    /**
     * Create a new job instance.
     */
    public function __construct($id,$password)
    {
        $this->teacher = Teacher::find($id);
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendEmailRegisterTeacher($this->teacher, $this->password);
        Mail::to($this->teacher->email)->send($email);
    }
}
