<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminMailConfigRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'mail_transport'   =>'required',
            'mail_host'        =>'required',
            'mail_port'        =>'required',
            'mail_username'    =>'required',
            'mail_password'    =>'required',
            'mail_encryption'  =>'required',
            'mail_from_name'   =>'required',
            'mail_from_address'=>'required',
        ];
    }
}
