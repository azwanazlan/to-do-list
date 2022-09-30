<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

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

    public function home()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
    }

    public function index()
    {
        $data = Content::where('user_id', Auth::id())->get();
        //$data = DB::table('contents')->where('user_id', Auth::id())->get();
        return view('home', ['contents' => $data]);
    }

    public function read()
    {
        $data = Content::all();
        //$data = DB::table('contents')->where('user_id', Auth::id())->get();
        return view('read', ['contents' => $data]);


    }
    }


