<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeedBackStoreRequest extends FormRequest
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
            'comment'=>'required',
            'file.*'=>'mimes:png,jpg,jepg,webp,pdf',
        ];
    }

    public function messages()
    {
        return [
            'file.*.mimes' => 'Only images and pdf format are allowed',
        ];
    }
}
