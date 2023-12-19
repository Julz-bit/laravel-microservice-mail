<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MailServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $htmlContent;
    public $to;
    public $subject;
    public function __construct($htmlContent, $to, $subject = null)
    {
        $this->htmlContent = $htmlContent;
        $this->to = $to;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $recepients = is_array($this->to) ? $this->to : [$this->to];
        Mail::to($recepients)->send(new SendMail($this->htmlContent, $this->subject));
    }
}
