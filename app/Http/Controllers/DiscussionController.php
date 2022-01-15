<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDiscussionRequest;
use App\Models\Reply;
use App\Notifications\NewReplyAdded;
use App\Notifications\ReplyMarkedAsBestReply;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Auth;
use Illuminate\Validation\ValidationException;
class DiscussionController extends Controller
{

    public function __construct()
    {
         $this->middleware(['auth','verified'])->only('create','store'); 
        //  how to make middleaware auth only for function create and store
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //



    return view('discussions.index',['discussions'=>Discussion::filterByChannels()->paginate(3)]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('discussions.create')->with('channels',Channel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        
        $request->validate([
            'title' => ['required','max:255'],
            'content' => ['required'],

        ]);
    
        
        $data=([
            'title'=>$request->title,
            'slug' =>str::slug($request->title),
            'content'=>$request->content,
            'channel_id'=>$request->channel_id,
            'user_id'=> Auth::id()
        ]);


        Discussion::create($data);

        Session::flash('toaster-message','discussion created sucssfuly');
        Session::flash('toaster-class','success');
         return redirect()->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)//Todo 9llb 3la route model bunding
    {
        //
        // dd($discussion);
        return view('discussions.show')->with('discussion',$discussion);

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

    /**ali
     * function make  reply as best relpy 
     *
     * @param $discussion 
     * @param $reply
     * @return \Illuminate\Http\Response
     */
    public function BestReply(Discussion $discussion,Reply $reply)
    {
        //

        // echo'ali';
        $discussion->MarkAsBest($reply); //hena object dyal discussion howa lii feh wahd function Mark s best reply kanssiftoo lih en parametre object reply 
       
       
       if ($discussion->author->id !== auth::id()) {
           # code... check if the owner of the discussion is not authonticated user 
           $discussion->author->notify(New NewReplyAdded($discussion));// we will create a notification for users how marks best replay 
       }
       Session::flash('toaster-message','replay marked as best reply');
        Session::flash('toaster-class','warning');
         return redirect()->back();
    }
}
