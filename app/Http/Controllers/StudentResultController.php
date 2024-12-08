<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;

class StudentResultController extends Controller
{
    /**
     * Display the results for the logged-in student.
     */
    public function index()
    {
        // Fetch results for the logged-in student
        $results = Result::where('student_id', auth()->id())->with('quiz')->get();

        return view('student.results.index', compact('results'));
    }
}
