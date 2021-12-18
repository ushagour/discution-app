<?php

namespace App\Models;
use App\Models\Model as ModelsModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends  ModelsModel
{
    use HasFactory;


    public function reply()
    {
        return  $this->belongTo(Reply::class);//belongTo one reply

    }
    public function user()
    {
        return  $this->belongTo(User::class);//

    }

}
