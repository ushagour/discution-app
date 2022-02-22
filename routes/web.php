<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\UsersController;
use App\Models\Discussion;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
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
 
    // try {
    //     // exception hiiya  git hub ga3  ma autoriza liina user bach y tautonticca l app
    //     $SocialiteUser = Socialite::driver('github')->user();

    // } catch (\Throwable $th) {
    //     //throw $th; ok rj3o l login page 

    //     return redirect('login');
    // }

    $githubUser = Socialite::driver('github')->user();
 
    dd($githubUser);
    $user = User::create([
                    'name' => $githubUser->name,
                    'email' => $githubUser->email,
                    'provider_id' => $githubUser->id,
                    'provider_token' => $githubUser->token,
                    'provider_refresh_token' => $githubUser->refreshToken,
                ]);
//     $user = User::where('provider_id', $githubUser->id)->first();
//     if ($user==null) {
//         $user = User::create([
//             'name' => $githubUser->name,
//             'email' => $githubUser->email,
//             'provider_id' => $githubUser->id,
//             'github_token' => $githubUser->token,
//             'github_refresh_token' => $githubUser->refreshToken,
//         ]);
//     } else {
//         $user->update([
//             'github_token' => $githubUser->token,
//             'github_refresh_token' => $githubUser->refreshToken,
//         ]);
//     }
//  dd($user);
    // Auth::login($user);
 
    // return redirect('/');
});