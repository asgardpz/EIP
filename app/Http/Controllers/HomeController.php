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
         //return view('home');
         return view('index2');
    }

    public function index2()
    {
        return view('index2');
    }

    public function index3()
    {
        return view('index3');
    }

    public function index4()
    {
        return view('index4');
    }

}
