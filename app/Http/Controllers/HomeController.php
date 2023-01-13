<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(session()->has('reservation')){
                if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0){
                    return view('dashboard');
                }else{
                    return redirect()->route('page.index', 'trips');
                }
           
        }else {

                if(!Auth::user()->user_type == 3){
                    return view('dashboard');
                }else {
                    return redirect()->route('page.index', 'trips');
                }
            
        }


        //
    }
}
