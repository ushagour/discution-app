<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\UsersController;
use App\Models\Discussion;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/lockscreen', [App\Http\Controllers\LockSceenController::class, 'lockscreen'])->name('lockscreen');
Route::POST('/unlock', [App\Http\Controllers\LockSceenController::class, 'unlock'])->name('login.unlock');

Auth::routes(['verify'=>true]); 
Route::resource('discussions',DiscussionController::class);
Route::POST('discussions/{discussion}/update',  [DiscussionController::class,'update'])->name('discussions.update');

Route::resource('discussions/{discussion}/replies',RepliesController::class); //todo hta ntell 3la hadii kiifach katkhdm 

Route::POST('discussions/{discussion}/replies/{reply}',[DiscussionController::class,'BestReply'])->name('discussion.best-reply');

Route::get('users/notifications',[UsersController::class,'notifications'])->name('users.notifications');//had route dyal notification bach y9rahoom 

Route::get('reply/like/{id}',[RepliesController::class,'like'])->name('reply.like');
Route::get('reply/unlike/{id}',[RepliesController::class,'unlike'])->name('reply.unlike');

// Route ::get('test', function (){
// //    echo request()->query('channel');
// return view('welcome');

// });

# Channels resource 
Route::resource('channel',ChannelController::class);
Route::post('channel/update',  [ChannelController::class,'update'])->name('channel.update');
Route::get('channel/destroy/{id}', [ChannelController::class,'destroy']); 
 Route::get('/channel', [App\Http\Controllers\ChannelController::class, 'index'])->name('channel.index');


 Route::get('user/profile',[UsersController::class,'profile'])->name('user.profile');
 Route::get('/result',[App\Http\Controllers\HomeController::class,'Search'])->name('Search');


 Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login-github');
 
Route::get('/auth/github/callback', function () {
 
    try {
        // exception hiiya  git hub ga3  ma autoriza liina user bach y tautonticca l app
        $SocialiteUser = Socialite::driver('github')->user();

    } catch (\Throwable $th) {
        //throw $th; ok rj3o l login page 

        return redirect('login');
    }

 
    $user = User::where('provider_id', $SocialiteUser->id)->first();
 
    if ($user) {
        $user->update([
            'provider_token' => $SocialiteUser->token,
            'provider_refresh_token' => $SocialiteUser->refreshToken,
        ]);
    } else {
        
        $user = User::create([
            'name' => $SocialiteUser->name,
            'email' => $SocialiteUser->email,
            'password' => Hash::make('password'), 
            'provider_id' => $SocialiteUser->id,
            'provider_token' => $SocialiteUser->token,
            'provider_refresh_token' => $SocialiteUser->refreshToken,
        ]);
    }
    // dd($user);
 
    Auth::login($user);
 
    return redirect('/');
});