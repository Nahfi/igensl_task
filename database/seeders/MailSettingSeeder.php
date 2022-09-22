<?php

namespace Database\Seeders;

use App\Models\MailSetting;
use Illuminate\Database\Seeder;

class MailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mailSetting = MailSetting::getMailSetting();
        if(!$mailSetting){
            MailSetting::create([
                'mail_transport'            =>'smtp',
                'mail_host'                 =>'smtp.mailtrap.io',
                'mail_port'                 =>'2525',
                'mail_username'             =>'c897d544de221f',
                'mail_password'             =>'7e09909de881c2',
                'mail_encryption'           =>'tls',
                'mail_from_address'         => 'task@gmail.com',
                'mail_from_name'            => 'task',
            ]);
        }

    }
}
