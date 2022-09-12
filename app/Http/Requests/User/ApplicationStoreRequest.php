<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ApplicationStoreRequest extends FormRequest
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
        $countries =  getCountry()->pluck('name')->toArray();
        $splitInfo = explode(',', request()->countryCode);
        $iso = $splitInfo [0];
        return [
            'fname'=>'required',
            'lname'=>'required',
            'previousDegree'=>'required',
            'email' => 'required|unique:users,email',
            'phone' => Rule::phone()->country($iso)->mobile(),
            'country'=>'required|in:'.implode(',', $countries),
            'program'=>'required|in:CSE,EEE,BBA,MBA',
            'dob'=>'required|date',
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
            'email.unique'=>'This Email Is Already Registerd, Please Enter A New Email',
            'dob.required'=>'Please Enter Your Date of Birth',
            'country.required'=>'Please Select A Country',
            'program.required'=>'Please Select A Program',
            'file.*.mimes' => 'Only images and pdf format are allowed',

        ];
    }
}