<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name'];
    public function subject()
{
    return $this->belongsTo(Subject::class);
}
public function users()
{
    return $this->belongsToMany(User::class);
}

// app/Models/Subject.php
public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id'); // Ensure teacher_id is the foreign key
}
public function quizzes() {
    return $this->hasMany(Quiz::class, 'user_id', 'id');
}


}
