<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    public function includedInRace()
     {
        return $this->hasMany('App\Models\Better', 'horse_id', 'id');
     }
}
