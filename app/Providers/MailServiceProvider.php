<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (Schema::hasTable('mails')) {
            $mail = DB::table('mails')->where('status', 1)->first();
            if ($mail) {
                $config = array(
                    'driver' => $mail->driver,
                    'host' => $mail->host,
                    'port' => $mail->port,
                    'from' => array('address' => $mail->from_address, 'name' => $mail->from_name),
                    'encryption' => $mail->encryption,
                    'username' => $mail->username,
                    'password' => $mail->password,
                );
                Config::set('mail', $config);
            }
        } 
    }

    public function boot(): void
    {
        //
    }
}
