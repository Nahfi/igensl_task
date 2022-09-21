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

}
