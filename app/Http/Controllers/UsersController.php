<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UsersController extends Controller
{
    //


    public function  notifications()
    {
        //mark all as read  for authonticated user 
          
                auth()->user()->unreadNotifications->markAsRead(); // function  to make  notification read 

                return view('users.notifications',['notifications'=>auth()->user()->notifications()->paginate(5)]);


        //displayn notfications 
    }
}
