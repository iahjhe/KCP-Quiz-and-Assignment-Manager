<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade'); // Foreign key to quizzes table
            $table->string('question'); // The question text
            $table->json('options'); // Options as a JSON array
            $table->string('correct_answer'); // Correct answer
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
