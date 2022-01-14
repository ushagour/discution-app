<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReplyRequest;
use App\Models\Discussion;
use App\Models\like;
use App\Notifications\NewReplyAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   instance dyal object Discussion li ghadii ndiro lih replay
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReplyRequest $request, Discussion $discussion)
    {
        //had l kitaba below khassni nchoofha 
        auth()->user()->replies()->create([
            'content'=>$request->content,
            'discussion_id'=>$discussion->id

        ]);

        auth()->user()->point +=25;
        auth()->user()->save();

       // $discussion->author->notify( New NewReplyAdded($discussion)); //melii y tcriya chii replya nsiifto msg l autor dyal discussion 

       Session::flash('toaster-message','replay added  successfuly');
        Session::flash('toaster-class','success');
         return redirect()->back();        
    


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
    /**
     * like a reply 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {

         Like::create([
            'user_id'=>Auth::id(),
            'reply_id'=>$id

         ]);
         Session::flash('toaster-message',' reply likes successfuly');
         Session::flash('toaster-class','success');
          return redirect()->back();        
     
    }
    /**
     * unlike a reply 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlike($id)
    {

            $like = Like::where('reply_id',$id)->where('user_id',Auth::id())->first();

             $like->delete();
         
    Session::flash('toaster-message','you unliked the reply !');
    Session::flash('toaster-class','error');
     return redirect()->back();      
         
    }
}
