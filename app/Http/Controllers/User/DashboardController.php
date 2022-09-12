<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{

    /**
     * Show the user dashboard
     */
     public function index(){

        return view('user.pages.home.index',);
     }

}