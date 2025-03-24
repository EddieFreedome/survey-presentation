<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table= "answers";
    protected $fillable = ['text', 'points'];

    public function question(){
        //aggiunge campi aggiuntivi della pivot oltre gli id
        // return $this->belongsToMany(Question::class)->withPivot('is_right');
        return $this->belongsToMany(Question::class);
    }
}
