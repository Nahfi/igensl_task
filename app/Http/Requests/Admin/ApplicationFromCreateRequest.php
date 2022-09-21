<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationFromCreateRequest extends FormRequest
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
        if(request()->input_type == 'select'){
            if (!request()->has('is_country')) {

                return [
                    'input_value'=>'required',
                    'input_label'=>'required|unique:application_form_elements,input_label',
                    'input_type'=>'required|in:email,file,text,select,textarea,date,number',
                    'status'=>'required|in:Active,Deactive',
                    'priority_id'=>'required|unique:application_form_elements,priority_id',
                ];
            }
            else{
                return [
                    'input_label'=>'required|unique:application_form_elements,input_label',
                    'input_type'=>'required|in:email,file,text,select,textarea,date,number',
                    'status'=>'required|in:Active,Deactive',
                    'priority_id'=>'required|unique:application_form_elements,priority_id',
                ];
            }
        }
        else{
            if(request()->input_type == 'file'){
                return [
                    'input_label'=>'required|unique:application_form_elements,input_label',
                    'input_type'=>'required|unique:application_form_elements,input_type',
                    'status'=>'required|in:Active,Deactive',
                    'priority_id'=>'required|unique:application_form_elements,priority_id',
                ];
            }
            else{
                return [
                    'input_label'=>'required|unique:application_form_elements,input_label',
                    'input_type'=>'required|in:email,file,text,select,textarea,date,number',
                    'status'=>'required|in:Active,Deactive',
                    'priority_id'=>'required|unique:application_form_elements,priority_id',
                ];
            }


        }

    }
}
