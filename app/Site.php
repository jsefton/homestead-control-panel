<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    public function homestead()
    {
        return $this->belongsTo('\App\Homestead');
    }
}
