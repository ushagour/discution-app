<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\Discussion;
use Auth;


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
        



        return view('discussions.index',['discussions'=>$result]);

    }
}
