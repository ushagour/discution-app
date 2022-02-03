<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model as ModelsModel;

class Action extends ModelsModel
{
    use HasFactory;

    public function user()
    {
        return $this->belongTo(User::class);
    }
}
