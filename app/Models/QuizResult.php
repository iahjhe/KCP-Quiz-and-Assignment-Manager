<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quiz_id', 'score', 'total'];

    // Relationship to Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

