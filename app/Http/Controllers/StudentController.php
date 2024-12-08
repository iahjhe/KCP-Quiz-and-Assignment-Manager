<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{
    public function index()
    {
        return view('student.portal');
    }

    public function joinClass(Request $request)
    {
        return view('student.join_class');
    }

    // Function to view quizzes
    public function viewQuizzes()
    {
        $student = Auth::user();
        // Fetch quizzes for the subjects the student is enrolled in
        $quizzes = Quiz::whereIn('subject_id', $student->subjects->pluck('id'))->get();

        return view('student.quizzes', compact('quizzes'));
    }

    // Function to take a specific quiz
    public function takeQuiz(Quiz $quiz)
    {
        // Fetch the questions for the quiz
        $questions = $quiz->questions;

        return view('student.take-quiz', compact('quiz', 'questions'));
    }
    // Function to view quiz results
    public function viewResults()
    {
        $student = Auth::user();
        $results = $student->quizResults(); // Assuming quizResults() is a method that returns quiz results for the student

        return view('student.results', compact('results'));
    }

    // Function to handle quiz submission


}
