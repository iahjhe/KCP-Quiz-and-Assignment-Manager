<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Define the fillable attributes for the model
    protected $fillable = ['quiz_id', 'question', 'options', 'correct_answer'];

    // Cast the options attribute to an array
    protected $casts = [
        'options' => 'array',
    ];

    // Define the relationship with the Quiz model
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}

