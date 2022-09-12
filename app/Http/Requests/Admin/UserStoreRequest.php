<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => Rule::phone()->country($iso)->mobile(),
            'country'=>'required|in:'.implode(',', $countries),
            'password' => 'required|confirmed',
            'address' => 'required',
            'status' => 'required|in:Active,DeActive'
        ];

    }



}