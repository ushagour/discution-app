<?php

namespace App\Models;
use App\Models\Model as ModelsModel;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends ModelsModel
{
    use HasFactory;
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }
    
    public function likes()
    {

        return $this->hasMany(Like::class);
    }

    
              /*  is_liked_by_auth_user
              tell us if the authonticated user is likes a replay or not 
              
               @return true of false 
            */
    public function is_liked_by_auth_user()
    {

        $authUser =Auth::id(); //auser authenticated
        $likers =array(); //array of liklers fiih les id's  users lii dayriin like lhad reply initailite 


        #loop likes of this reply 
            foreach($this->likes as $like):
                array_push($likers,$like->user_id);// push  ids of users ho belong to likes table 

            endforeach;

        #check if auth user in likers array 
            if(in_array($authUser,$likers)) {
                # code...
                return true;
            } else {
                # code...
                return false;
                
            }
            




    }
}
