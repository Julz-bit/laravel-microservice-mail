<?php

namespace App\Console\Commands;

use App\Jobs\MailServiceJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;

class FireEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fire:baby';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fire!!!';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $to = 'julz101.pci@gmail.com';
        $subject = 'FIRE IN THE HOLE';
        $user = 'Julz';
        $html = View::make('emails.template', ['user' => $user])->render();
        MailServiceJob::dispatch($html, $to, $subject)->onQueue('mail_service_queue');
    }
}
