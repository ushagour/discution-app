<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::resource('discussions',DiscussionController::class);
Route::resource('discussions/{discussion}/replies',RepliesController::class); //todo hta ntell 3la hadii kiifach katkhdm 

Route::POST('discussions/{discussion}/replies/{reply}',[DiscussionController::class,'BestReply'])->name('discussion.best-reply');

Route::get('users/notifications',[UsersController::class,'notifications'])->name('users.notifications');//had route dyal notification bach y9rahoom 
