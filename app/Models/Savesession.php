<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savesession extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tot_time_answering', 'tot_points', 'tot_correct', 'tot_wrong'];
    // protected $table = "savesessions";
    
    protected $casts = [
        'tot_time_answering' => 'integer',
        'tot_points' => 'integer',
        'tot_correct' => 'integer',
        'tot_wrong' => 'integer',
    ];
}
