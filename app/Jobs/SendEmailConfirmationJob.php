<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailConfirmation;
use Mail;

class SendEmailConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    protected $presence;
    /**
     * Create a new job instance.
     */
    public function __construct($details, $presence)
    {
        $this->details = $details;
        $this->presence = $presence;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendEmailConfirmation($this->details, $this->presence);
        Mail::to($this->details['email'])->send($email);
    }
}
