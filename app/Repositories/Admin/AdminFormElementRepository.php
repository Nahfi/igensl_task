<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Models\ApplicationFormElement;
use App\Services\FileService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminFormElementRepository{


    /**
     * get all  form element
     */
    public function index(){
        return ApplicationFormElement::orderBy('priority_id', 'ASC')->get();
    }
    // clear special char
    public function clean($inputName) {
        $inputName = str_replace(' ', '_', $inputName);
        return (preg_replace('/[^A-Za-z\_]/', '', $inputName));
    }

    /**
     * create user application form element
     */
    public function create($request){
        $formBuilder =  new ApplicationFormElement();
        if($request->has('is_required')){
            $formBuilder->is_required = $request->is_required;
        }
        if($request->input_type == 'select'){
            if($request->has('is_country')){
                $formBuilder->is_country = $request->is_country;
            }
            if($request->has('input_value')){
                $formBuilder->input_value = json_encode($request->get('input_value'));
            }
        }
        if($request->input_type == 'number'){
            if($request->has('is_mobile')){
                $formBuilder->is_mobile = $request->is_mobile;
            }
        }
        if ($request->input_type == 'file') {
            $formBuilder->input_name = 'file[]';
        }
        else{
            $formBuilder->input_name = strtolower($this->clean($request->input_label));
        }
        $formBuilder->input_label = ucfirst(str_replace('_', ' ', $this->clean($request->input_label)));
        $formBuilder->input_type = $request->input_type;
        $formBuilder->priority_id = $request->priority_id;
        $formBuilder->status = $request->status;
        $formBuilder->save();

    }

}
