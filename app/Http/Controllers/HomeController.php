<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function profile()
    {
        return view('profile');
    }

    public function profileEdit()
    {
        return view('editprofile');
    }

    public function profileEditProcess(Request $request)
    {
        $parameter = $request->parameter;
        if($parameter == "name"){
            $user = Auth::user();
            $user->update([
                "name" => $request->name
            ]);
            return redirect()->back();
        }
        return $request;
    }
}
