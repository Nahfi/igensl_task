<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    use HasFactory;

    /**
     * get all mail setting
     */
    public static function getMailSetting(){
        return  MailSetting::first();
    }

    /**
     * update  all mail setting
     */
    public static function updateMailSettings($request){

      $mailsetting = MailSetting::getMailSetting();
      $mailsetting->mail_transport = $request->mail_transport;
      $mailsetting->mail_host = $request->mail_host;
      $mailsetting->mail_port = $request->mail_port;
      $mailsetting->mail_username = $request->mail_username;
      $mailsetting->mail_password = $request->mail_password;
      $mailsetting->mail_encryption = $request->mail_encryption;
      $mailsetting->mail_from_address = $request->mail_from_address;
      $mailsetting->mail_from_name = $request->mail_from_name;
      $mailsetting->save();
    }
}
