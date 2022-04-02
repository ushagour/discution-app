<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Discussion;
use Auth;
use Illuminate\Support\Facades\Http;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        switch (request('filters')) {
            case 'me':
                $result = Discussion::where('user_id',Auth::id())->paginate(3);
                break;
            
            default:
            $result = Discussion::orderBy('created_at')->paginate(3);
                break;
        }
        


        $response =Http::get('https://freegeoip.app/json/');


        if ($response->status() !== 200) {
           return 'err';
       }
       
       $countryCode = $response->json('country_code', 'US');
       
       if (empty($countryCode)) {
           return 'err';
       }
       
    
       

        return view('discussions.index',['discussions'=>$result,'title_page'=>'AskMe',"countryCode"=>$countryCode]);

    }
    public function Search()
    {

     $discussion =Discussion:: where('title','like','%'.request('query').'%')
                                ->orWhere('content', 'LIKE', '%'.request('query').'%') 
                                ->paginate(4);
//ToDO hta nziid l3iiba dyal appercase 3la hssab recherch 
    //  dd($discussion);
     return view('discussions.search')->with('query',request('query'))
                          ->with('results',$discussion);
                    
    }
}
