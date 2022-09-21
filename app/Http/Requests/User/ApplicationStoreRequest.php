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


        $validation ['mobile_number']  = Rule::phone()->country($iso)->mobile();
        return $validation;



        // dd(request()->all());


        // $countries =  getCountry()->pluck('name')->toArray();
        // $splitInfo = explode(',', request()->countryCode);
        // $iso = $splitInfo [0];
        // $inputInformations = ApplicationFormElement::getAllActiveElement();
        // $validation  = [];
        // foreach($inputInformations as $input){

        //     $required = $input->is_required == 1 ?'required':'';
        //     if($input->input_name == 'email' || $input->input_type == 'email'){
        //         $validation [$input->input_name]  = $required;
        //     }
        //     if($input->input_type == 'file'){
        //             $validation ['file.*']  = 'mimes:png,jpg,jepg,webp,pdf|'.$required;

        //     }
        //     if($input->input_type == 'select'){
        //         if($input->is_country == 1){
        //             $validation [$input->input_name] = $required.'|in:'.implode(',', $countries);
        //         }
        //     }
        //     if($input->input_type == 'number'){
        //         if($input->is_phone == 1){
        //             return [

        //                 $input->input_name  => Rule::phone()->country($iso)->mobile(),

        //                 ];
        //            }
        //             // $validation [$input->input_name] = Rule::phone()->country($iso)->mobile();
        //         }
        //         else{
        //             return [

        //              'phone' => Rule::phone()->country($iso)->mobile(),

        //                  ];
        //         }
        //     }
        //     if($input->input_type == 'date'){

        //         $validation [$input->input_name] = 'date|'.$required;

        //     }
        //     else{
        //         $validation [$input->input_name] = 'date|'.$required;
        //     }



        // }

        // return $validation;
        // dd( $validation);
        // foreach($inputInformations as $input){
        //     if($input->input_name == 'email' || $input->input_name == 'email'){
        //         return [
        //               $input->input_name =>'unique:users,email|'.$input->is_required == 1 ? 'required':
        //             // 'fname'=>'required',
        //             // 'lname'=>'required',
        //             // 'previousDegree'=>'required',
        //             // 'email' => 'required|unique:users,email',
        //             // 'phone' => Rule::phone()->country($iso)->mobile(),
        //             // 'country'=>'required|in:'.implode(',', $countries),
        //             // 'program'=>'required|in:CSE,EEE,BBA,MBA',
        //             // 'dob'=>'required|date',
        //             // 'file.*'=>'mimes:png,jpg,jepg,webp,pdf',
        //         ];
        //     }

        // }

    }

}
