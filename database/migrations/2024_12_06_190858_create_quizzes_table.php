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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Quiz title
            $table->text('description')->nullable(); // Optional description of the quiz
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key linking to the user (teacher)
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
    
};
