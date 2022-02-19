<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\UsersController;
use App\Models\Discussion;
use Illuminate\Support\Facades\Route;

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
