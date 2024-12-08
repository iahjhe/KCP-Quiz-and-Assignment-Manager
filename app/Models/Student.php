<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    public function subjects() {
        return $this->belongsToMany(Subject::class);
    }
    
    public function quizzes() {
        return $this->hasManyThrough(Quiz::class, Subject::class, 'id', 'user_id', 'id', 'id');
    }
    
}
