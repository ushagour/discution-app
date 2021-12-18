<?php

namespace App\Models;
use App\Models\Model as ModelsModel;

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
}
