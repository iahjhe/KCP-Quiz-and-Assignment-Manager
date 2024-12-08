<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }
    public function create_teacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'teacher',
        ]);
    
        return redirect()->back()->with('success', 'Teacher account created successfully!');
    }

    public function manage_teacher()
    {
        // Fetch all users with the 'teacher' role
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.manage_teachers', compact('teachers'));
    }
    public function edit_teacher($id)
    {
        $teachers = User::where('id', $id)->where('role', 'teacher')->first();
    
        // If student is not found, redirect with an error message
        if (!$teachers) {
            return redirect()->route('admin.manage_teachers')->with('error', 'Teacher not found.');
        }
    
        return view('admin.edit_teacher', compact('teachers'));
    }
    public function update_teacher(Request $request, $id)
{
    // Find the teacher by ID
    $teachers = User::where('id', $id)->where('role', 'teacher')->first();

    // If no teacher is found, redirect with an error message
    if (!$teachers) {
        return redirect()->route('admin.manage_teachers')->with('error', 'Teacher not found.');
    }

    // Validate the incoming request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|string|max:255',
    ]);

    // Update the teacher's information
    $teachers->update($validated);

    // Redirect to the teacher management page with a success message
    return redirect()->route('admin.manage_teachers')->with('success', 'Teacher updated successfully!');
}

public function delete_teacher($id)
{
    $teachers = User::where('id', $id)->where('role', 'teacher')->first();
    $teachers->delete();

    return redirect()->back()->with('success', 'Teacher deleted successfully!');
}
public function manage_students()
{
    $students = User::where('role', 'student')->get();
    return view('admin.manage_students', compact('students'));
}

// Show edit form for a student
public function edit_student($id)
{
    $student = User::where('id', $id)->where('role', 'student')->first();

    // If student is not found, redirect with an error message
    if (!$student) {
        return redirect()->route('admin.manage_students')->with('error', 'Student not found.');
    }

    return view('admin.edit_student', compact('student'));
}

// Update student details
public function update_student(Request $request, $id)
{
    // Find the student by ID
    $student = User::where('id', $id)->where('role', 'student')->first();

    // If no student is found, redirect with an error message
    if (!$student) {
        return redirect()->route('admin.manage_students')->with('error', 'Student not found.');
    }

    // Validate the incoming request data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|in:student,teacher,admin',
    ]);

    // Update the student's information
    $student->update($validated);

    // Redirect to the student management page with a success message
    return redirect()->route('admin.manage_students')->with('success', 'Student updated successfully!');
}

// Delete a student
public function delete_student($id)
{
    $student = User::where('id', $id)->where('role', 'student')->first();

    // If student not found
    if (!$student) {
        return redirect()->route('admin.manage_students')->with('error', 'Student not found.');
    }

    // Delete the student
    $student->delete();

    // Redirect back with a success message
    return redirect()->route('admin.manage_students')->with('success', 'Student deleted successfully!');
}

// Create student account (your existing method)
public function create_student(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'student',
    ]);

    return redirect()->route('admin.manage_students')->with('success', 'Student account created successfully!');
}

}
