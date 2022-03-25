<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class UsersController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  notifications()
    {
        //mark all as read  for authonticated user 
          
                auth()->user()->unreadNotifications->markAsRead(); // function  to make  notification read 

                return view('users.notifications',['notifications'=>auth()->user()->notifications()->paginate(5)]);


        //displayn notfications 
    }


    public function index()
    {
        //

        $users = User::all();
        return view('users.index')->with('users',$users);

  

        
    }
public function show()
{
      
    $user = auth()->user();
    $actions = auth()->user()->actions()->get();
  

    // dd($actions);
    return view('users.profile')->with('auth_user',$user)->with('actions',$actions);
 
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function update(Request $request){

    $validatedData = $request->validate([

        'name' => 'required|max:255',
        'email' => 'required|email'
      
    ]);

            $user = User::find(2);
        if ($request->has('avatar')) {

                $path = $request->file('avatar')->store('avatars');
                $user->profile->avatar=$path;     
                    // echo $path;
                    // dd($user->profile->avatar) ;
                $user->profile->save();
        }


        //hena derna filled bach ntestiw wach input kayn f request w not empty 
        if ($request->filled('profileNewPassword')) {

            $NewPassword = Hash::make($request->newpassword);
    
            $user->password = $NewPassword; 
            $user->save();
            }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile->facebook = $request->facebook;
        $user->profile->github = $request->github;
        $user->profile->google = $request->google;
        $user->profile->linkdin = $request->linkdin;


        
        $user->profile->save();//profile cant be a methode so cant accespet any arguemnt( )
        $user->save();


        Session::flash('toaster-message', 'user  updated succesfuly!'); 
        Session::flash('toaster-class', 'info'); 

  return redirect()->back();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
                $user =User::find($id);
                $user->profile->delete();
                $user->delete();
           //  return   Session::flush('info','user deleted succesfuly ');
                //  return   redirect()->back();

 }

    /**
     * change stage of boolien champ isadmin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggle($id,$state)
    {
        //

        $user = User::find($id);
        $user->is_admin = !$state;
        $user->save();
        Session::flash("success",'Succefuly permition changed ');
        return redirect()->route('users.index');


    }

}
