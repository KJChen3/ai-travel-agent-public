<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourneyDetail extends Model
{
    //
    use HasFactory;

    protected $fillable = ['journey_id', 'date', 'sequence', 'type', 'name', 'introduction', 'time', 'price'];

    public function journey()
    {
        return $this->belongsTo(Journey::class);
    }
}
