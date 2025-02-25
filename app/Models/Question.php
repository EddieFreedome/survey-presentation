<?php

namespace App\Models;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table="questions";

    public function answers(){
        return $this->belongsToMany(Answer::class)->withPivot('is_right');
    }
}
