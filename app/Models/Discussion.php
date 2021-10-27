<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends ModelsModel
{
    use HasFactory;



   public function author()
   {

    return $this->belongsTo(User::class,'user_id'); //we specify the colum if we use defrent function name 
   }
   public function getRouteKeyName()//methode overwrite what laravel mothode do!! mohhiim sEWLL3LIIHA 
   {
       return 'slug';
   }
   public function replies()
   {
       return $this->hasMany(Reply::class);
   }

}
