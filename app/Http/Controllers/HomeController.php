<?php

namespace App\Http\Controllers;
use App\Movie;
use Illuminate\Http\Request;
use Auth;

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
        return view('home');
    }

    public function getHome() {

        if (Auth::check()) {
            
            $arrayPeliculas = Movie::all();
            
            return view('catalog.index', array('arrayPeliculas'=>$arrayPeliculas));

        }else{

            return view('passwords.login');

        }


    }
}
