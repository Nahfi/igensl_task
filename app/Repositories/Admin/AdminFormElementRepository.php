<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Services\FileService;
use Illuminate\Support\Facades\Hash;

class AdminFormElementRepository{

    /**
     * create user form element
     */
    public function create($adminData){

    }

    /**
     * get all  form element
     */
    public function index(){

    }
    // clear special char
    public function clean($inputName) {
        $inputName = str_replace(' ', '-', $inputName);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $inputName);
     }

}
