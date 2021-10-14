<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDiscussionRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class DiscussionController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth')->only('create','store'); 
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
        
    
        
        $data=([
            'title'=>$request->title,
            'slug' =>str::slug($request->title),
            'content'=>$request->content,
            'channel_id'=>$request->channel_id
        ]);


        Discussion::create($data);
        Session::flash('toaster-message', 'post created succesfuly!'); 
        Session::flash('toaster-class', 'success'); 
        
       return redirect()->back();
    //   dd($request);


  
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
}
