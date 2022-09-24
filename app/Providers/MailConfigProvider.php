<?php

namespace App\Providers;
use App\Models\MailSetting;
use Illuminate\Support\ServiceProvider;
use Config;
class MailConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $mailSetting = mailSetting::getmailSetting();
                if($mailSetting){
                    $data = [
                        'driver'            => $mailSetting->mail_transport,
                        'host'              => $mailSetting->mail_host,
                        'port'              => $mailSetting->mail_port,
                        'encryption'        => $mailSetting->mail_encryption,
                        'username'          => $mailSetting->mail_username,
                        'password'          => $mailSetting->mail_password,
                        'from'              => [
                            'address'=>$mailSetting->mail_from_address,
                            'name'   => $mailSetting->mail_from_name
                        ]
                    ];
                    Config::set('mail',$data);
                }

          }catch (\Exception $e) {

              return $e->getMessage();
          }

    }
}
