<?php

namespace App\Http\Requests\User;

use App\Models\ApplicationFormElement;
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
        $validation = [];
        $inputInformations = ApplicationFormElement::getAllActiveElement();
        foreach($inputInformations as $input){
            $required = $input->is_required == 1 ?'required':'';
            if($input->input_name == 'email' || $input->input_type == 'email'){
                $validation [$input->input_name]  = $required;
            }
            else if($input->input_type == 'file'){
                if(request()->hasFile('file')){
                    $validation ['file.*']= 'mimes:png,jpg,jepg,webp,pdf';
                }
            }
            else if($input->input_type == 'select'){
                if($input->is_country == 1){
                    $validation [$input->input_name] = $required.'|in:'.implode(',', $countries);
                }
                else{
                    $validation [$input->input_name] = $required;
                }
            }
            else if($input->input_type == 'number'){
                if($input->is_mobile == 1){
                    $validation [$input->input_name] = Rule::phone()->country($iso)->mobile();
                }
                else{
                    $validation [$input->input_name] = $required;
                }
            }
            else if($input->input_type == 'date'){
                $validation [$input->input_name] = 'date|'.$required;
            }
            else{
                $validation [$input->input_name] = $required;
            }

        }
        return $validation;
    }
    public function messages()
    {
        return [
            'file.*.mimes' => 'Only images and pdf format are allowed',
        ];
    }

}