<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Horse;

class Better extends Model
{
    use HasFactory;

    public function hasBetOnHorse()
    {
      return $this->belongsTo(Horse::class, 'horse_id', 'id');
    }
}
