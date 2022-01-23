<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model as ModelsModel;

class Channel extends  ModelsModel
{
    use HasFactory;

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}
