<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Model as ModelsModel;


class Profile extends ModelsModel
{
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
