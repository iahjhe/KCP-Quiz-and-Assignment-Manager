<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\Result;
use App\Notifications\QuizSubmitted;


class StudentQuizController extends Controller
{
    // Display the list of quizzes for the student
    public function index()
    {
        // Fetch all quizzes
        $quizzes = Quiz::all();

        return view('student.quizzes.index', compact('quizzes'));
    }
    public function answerQuiz($id)
    {
        // Fetch the quiz with its questions
        $quiz = Quiz::with('questions')->findOrFail($id);

        return view('student.quizzes.answer', compact('quiz'));
    }

public function submitQuiz(Request $request, $id)
{
    $quiz = Quiz::findOrFail($id);
    $answers = $request->input('answers');

    $score = 0;
    $total = $quiz->questions->count();

    foreach ($quiz->questions as $question) {
        if (isset($answers[$question->id]) && $answers[$question->id] == $question->correct_answer) {
            $score++;
        }
    }

    // Save the result
    Result::create([
        'quiz_id' => $quiz->id,
        'student_id' => auth()->id(),
        'score' => $score,
        'total' => $total,
    ]);

    session()->flash('status', 'Quiz answered successfully!');
    return redirect()->route('student.view_quizzes');
}
    
}
