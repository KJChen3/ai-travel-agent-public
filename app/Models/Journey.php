<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    //
    use HasFactory;

    protected $fillable = ['title', 'status'];

    public function details()
    {
        return $this->hasMany(JourneyDetail::class);
    }
}
