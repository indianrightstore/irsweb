<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    /* if(env('APP_ENV') == 'local'){
        $ip = '125.63.113.190'; // india
        // $ip = '157.230.180.186'; // United States
       //  $ip = '198.50.145.28'; // canada
    }else{
        $ip = \Request::ip();
    }
    
         $data = \Location::get($ip); */
         //dd($data);
       
        return view('admin.dashboard');
    }
}
