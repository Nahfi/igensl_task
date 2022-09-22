<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApplicationFromCreateRequest;
use App\Models\ApplicationFormElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Repositories\Admin\AdminFormElementRepository;
class AdminApplicationFormController extends Controller
{
    /**
     * construct a method
     */
    public $user,$adminFormElementRepository;
    public function __construct(AdminFormElementRepository $adminFormElementRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->adminFormElementRepository = $adminFormElementRepository;
    }

    /**
     * get all application form inforamtion
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.application_form.index',[
            'formElements' => $this->adminFormElementRepository->index(),
            'existsPriorityIds'=>ApplicationFormElement::getAllActiveElement()->pluck('priority_id')->toArray()
        ]);
    }
    /**
     * create a dynamic application
     */
    public function store(ApplicationFromCreateRequest $request){
        if(is_null($this->user) || !$this->user->can('user.store')){
            abort(403,'Unauthorized access');
        }
        $this->adminFormElementRepository->create($request);
        return back()->with('form_element_create_success','Application Form Element Create Successfully');
    }
    /**
     *  dynamic application status update
     */
    public function update(Request $request , $id){
        if(is_null($this->user) || !$this->user->can('user.update')){
            abort(403,'Unauthorized access');
        }
        $request->validate([
            'status'=>'required |in:Active,Deactive'
        ]);
        $this->adminFormElementRepository->update($request,$id);
        return back()->with('form_element_update_success','Application Form Element Updated Successfully');
    }
    /**
     *  dynamic application delete
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('user.destroy')){
            abort(403,'Unauthorized access');
        }
        $this->adminFormElementRepository->findSpecifiFormElement($id)->delete();
        return back()->with('form_element_delete_success','Application Form Element Deleted Successfully');
    }

    /**
     *  check if priority id is exist or not
     */
    public function priorityCheck($priorityNumber){
        $totalElement = ApplicationFormElement::inputElementByPriority($priorityNumber);
        return json_encode([
            'totalElement'=>$totalElement
        ]);
    }

}
