<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Hash;

class LockSceenController extends Controller
{
    //


    public function lockscreen()
    {


        if (!session('lock-expires-at')) {
            return redirect('/');
        }
        if (session('lock-expires-at')>now()) {
            return redirect('/');
            
        }


        return view('auth.lockscreen');
    }
    public function unlock(Request $req)
    {

        $req->validate([
            'password' => ['required','max:9']

        ]);
        $password = $req->input('password');

        $check =Hash::check($password,\Auth::user()->password);


        if(!$check){
            session::error('error password','Error');
            return redirect('lockscreen');
        }
        
        Session(['lock-expires-at'=>now()->addMinute($req->user()->getLockoutTime())]);//dreb 3liiha 
        return redirect('/');
    }
}
