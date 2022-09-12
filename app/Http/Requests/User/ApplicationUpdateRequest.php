<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationUpdateRequest extends FormRequest
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
            'fname'=>'required',
            'lname'=>'required',
            'previousDegree'=>'required',
            'email' => 'required',
            'file.*'=>'mimes:png,jpg,jepg,webp,pdf',
        ];
    }

    public function messages()
    {
        return [

            'fname.required'=>'Please Enter Your First Name',
            'lname.required'=>'Please Enter Your Last Name',
            'previousDegree.required'=>'Please Enter Your Previous Degree',
            'email.required'=>'Please Enter Your Email',
            'file.*.mimes' => 'Only images and pdf format are allowed',

        ];
    }
}
