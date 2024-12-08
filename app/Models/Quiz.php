<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'subject_id']; // Changed teacher_id to user_id

    // Define the relationship with the Teacher (User model)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function questions()
{
    return $this->hasMany(Question::class);
}
public function subject() {
    return $this->belongsTo(Subject::class);
}
public function results()
{
    return $this->hasMany(Result::class);
}
}
