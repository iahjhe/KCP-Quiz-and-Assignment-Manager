<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    //
    public function index()
    {
       

    // Pass quizzes to the dashboard view
    return view('teacher.dashboard');
    }

    public function createQuiz()
    {
            $subjects = Subject::all(); 
    // Pass subjects to the view
    return view('teacher.create_quiz', compact('subjects'));
    }

    public function storeQuiz(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|min:3',
            'questions.*.correct_answer' => 'required|string',
            'subject_id' => 'required|exists:subjects,id', 
        ]);

        // Create the quiz
        $quiz = Quiz::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'subject_id' =>  $request->input('subject_id'),
            'user_id' => auth()->id(), // Assuming the logged-in teacher
        ]);

        // Save the questions
        foreach ($validated['questions'] as $questionData) {
            $question = new Question([
                'question' => $questionData['question'],
                'options' => json_encode($questionData['options']), 
                'subject_id' => $validated['subject_id'],// Store options as a JSON string
                'correct_answer' => $questionData['correct_answer'],
            ]);
            $quiz->questions()->save($question); // Assuming relationship is defined
        }

        return redirect()->route('teacher.dashboard')->with('success', 'Quiz created successfully!');
    }

    public function showQuizzes()
    {
        // Get all quizzes created by the authenticated teacher
        $quizzes = Quiz::where('user_id', auth()->user()->id)->get();
    
        // Pass the quizzes to the view
        return view('teacher.show_quiz', compact('quizzes'));
    }
    public function showQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        
        // Decode the questions field if it exists
        if ($quiz->questions) {
            $questions = json_decode($quiz->questions, true);
    
            // Decode options for each question
            foreach ($questions as &$question) {
                if (isset($question['options'])) {
                    $question['options'] = json_decode($question['options'], true);
                    // If options are not properly decoded, set them to an empty array
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $question['options'] = [];
                    }
                }
            }
            // Set the questions back on the model
            $quiz->setAttribute('questions', $questions);
        } else {
            $quiz->setAttribute('questions', []);
        }
    
        return view('teacher.quiz', compact('quiz'));
    }
    
    public function show_quiz()
    {
        return view('teacher.show_quiz');
    }

    public function quiz()
    {
        $quizzes = Quiz::where('user_id', auth()->user()->id)->get();
        return view('teacher.show_quiz', compact('quizzes'));
    }
    

    // In TeacherController.php
// In TeacherController.php
public function editQuiz($id)
{
    // Retrieve the quiz by ID
    $quiz = Quiz::findOrFail($id);

    // Decode the questions field if it exists
    $questions = [];
    if ($quiz->questions) {
        $questions = json_decode($quiz->questions, true);

        // Decode options for each question
        foreach ($questions as &$question) {
            if (isset($question['options'])) {
                // Ensure options are decoded as an array
                $question['options'] = json_decode($question['options'], true);
            }
        }
    }

    // Pass the quiz to the view for editing
    return view('teacher.edit_quiz', compact('quiz', 'questions'));
}

public function updateQuiz(Request $request, $id)
{
    // Validate the incoming request
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'questions' => 'required|array|min:1',
    ]);

    // Find the quiz
    $quiz = Quiz::findOrFail($id);

    // Update quiz details
    $quiz->title = $validated['title'];
    $quiz->description = $validated['description'] ?? null;
    $quiz->save();

    // Delete existing questions for this quiz before adding new ones
    $quiz->questions()->delete();

    // Add the updated questions to the questions table
    foreach ($validated['questions'] as $questionData) {
        $quiz->questions()->create([
            'question' => $questionData['question'],
            'options' => json_encode($questionData['options']),
            'correct_answer' => $questionData['correct_answer'],
        ]);
    }

    // Redirect back with success message
    return redirect()->route('teacher.editQuiz', $quiz->id)->with('success', 'Quiz updated successfully!');

}

public function deleteQuiz($id)
{
    // Find the quiz by its ID
    $quiz = Quiz::findOrFail($id);

    // Check if the quiz belongs to the authenticated teacher
    if ($quiz->user_id !== auth()->user()->id) {
        return redirect()->route('teacher.show_quiz')->with('error', 'You are not authorized to delete this quiz.');
    }

    // Delete the quiz
    $quiz->delete();

    // Redirect with success message
    return redirect()->back()->with('success', 'Quiz deleted successfully!');
}

public function manageStudents()
{
    // Get the students enrolled in subjects taught by the authenticated teacher
    // Assuming that the teacher can view all students assigned to them via the subject or course they teach.
    $students = User::where('role', 'student')->get(); // Fetch all students
    $subjects = Subject::all();
    return view('teacher.manage_students', compact('students', 'subjects'));
}

public function deleteStudent($id)
{
    // Find the student by their ID
    $student = User::findOrFail($id);

    // Check if the authenticated user is a teacher
    if (auth()->user()->role !== 'teacher') {
        return redirect()->route('teacher.manage_students')->with('error', 'You are not authorized to delete this student.');
    }

    // Delete the student
    $student->delete();

    // Redirect back with success message
    return redirect()->route('teacher.manage_students')->with('success', 'Student deleted successfully!');
}


public function assignSubject(Request $request, $userId)
{
    $user = User::findOrFail($userId);

    // Validate if the subjects exist
    $request->validate([
        'subject_id' => 'required|array|exists:subjects,id', // Ensure that subject_id is an array and each item exists in the subjects table
    ]);

    // Attach the selected subjects to the user (student)
    $user->subjects()->syncWithoutDetaching($request->subject_id); // Add subjects without removing previous assignments

    return redirect()->route('teacher.manage_students')->with('success', 'Subjects assigned successfully!');
}
// In TeacherController.php
public function deleteAssignedSubject($studentId, $subjectId)
{
    // Find the student
    $student = User::findOrFail($studentId);

    // Detach the subject from the student
    $student->subjects()->detach($subjectId);

    // Debugging
    Log::info("Subject detached", ['student_id' => $studentId, 'subject_id' => $subjectId]);

    // Redirect back
    return redirect()->route('teacher.manage_students')->with('success', 'Subject removed successfully!');
}


public function showResults()
    {
        // Fetch quizzes and results
        $quizzes = Quiz::with('results.student')->get(); // Assuming a 'results' relationship in the Quiz model

        return view('teacher.show_quiz_results', compact('quizzes'));
    }


}
