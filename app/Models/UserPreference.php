<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPreference extends Model
{
    use HasFactory;

    protected $table = 'user_preferences'; // 資料表名稱
    protected $fillable = [
        'user_id',
        'pref1',
        'pref2',
        'pref3',
        'pref4',
        'pref5',
        'pref6',
        'pref7',
        'pref8',
    ];
}
