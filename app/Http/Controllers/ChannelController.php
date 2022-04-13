<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;// darori initalise data table bach tkhdem biiha 
use Validator;
use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;



class ChannelController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('viewAny',Channel::class);

        if($request->ajax())
        {
            $data = Channel::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                      
                        /*
                        check if the user has the permission to see the delet and update buttons 
                         if the responce true return the buttons
                        */
                        $response = Gate::inspect('is-admin');

 
                        if ($response->allowed()) {
                            // The action is authorized...
                            $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                            $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                            
                        } else {
                            $button = $response->message();
                        }
                    
                        
                        
                        
                        return $button;


                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('channel.index',['title_page'=>'Channel Dashbord']);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('store',Channel::class);
        
        $rules = array(
            'name'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name'        =>  $request->name,
            'slug' =>str::slug($request->name),

        );

        Channel::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Channel::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     
        
        $rules = array(
            'name'         =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'slug'    =>  $request->slug,
            'name'     =>  $request->name
        );

        Channel::whereId($request->hidden_id)->update($form_data); //ToDo hta drreb tlila 

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Channel::class);

        $data = Channel::findOrFail($id);
        $data->delete();
    }
}
