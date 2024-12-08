<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\StudentResultController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grouping routes that require authentication
Route::middleware('auth')->group(function () {

    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Role-based routes (authenticated users only)
    Route::get('/student/portal', [StudentController::class, 'index'])->name('student.portal');
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


 
    // Teacher management routes
    Route::get('/admin/manage_teachers', [AdminController::class, 'manage_teacher'])->name('admin.manage_teachers');
    Route::post('create_teacher', [AdminController::class, 'create_teacher'])->name('create_teacher');
    Route::get('/edit_teacher/{id}', [AdminController::class, 'edit_teacher'])->name('admin.edit_teacher');
    Route::put('/admin/update-teacher/{id}', [AdminController::class, 'update_teacher'])->name('admin.update-teacher');
    Route::delete('/delete_teacher/{id}', [AdminController::class, 'delete_teacher'])->name('admin.delete_teacher');

    Route::get('/admin/manage_students', [AdminController::class, 'manage_students'])->name('admin.manage_students');
    Route::delete('/delete_student/{id}', [AdminController::class, 'delete_student'])->name('admin.delete_student');
    Route::get('/edit_student/{id}', [AdminController::class, 'edit_student'])->name('admin.edit_student');
    Route::put('/update_student/{id}', [AdminController::class, 'update_student'])->name('admin.update_student');
    Route::post('/create-student', [AdminController::class, 'create_student'])->name('admin.store_student');
    

    Route::get('/teacher/create-quiz', [TeacherController::class, 'createQuiz'])->name('teacher.create_quiz');
    Route::post('/teacher/store-quiz', [TeacherController::class, 'storeQuiz'])->name('teacher.storeQuiz');
    Route::get('/teacher/quizzes', [TeacherController::class, 'showQuizzes'])->name('teacher.showQuizzes');
    Route::get('/teacher/quizzes', [TeacherController::class, 'quiz'])->name('teacher.show_quiz');
    Route::get('/teacher/quiz/{id}', [TeacherController::class, 'showQuiz'])->name('teacher.showQuiz');
// In routes/web.php
// In web.php (routes)
Route::get('/teacher/quiz/edit/{id}', [TeacherController::class, 'editQuiz'])->name('teacher.editQuiz');
Route::put('/teacher/quiz/update/{id}', [TeacherController::class, 'updateQuiz'])->name('teacher.updateQuiz');


    Route::delete('/teacher/quiz/delete/{id}', [TeacherController::class, 'deleteQuiz'])->name('teacher.deleteQuiz');

    Route::get('/teacher/manage-students', [TeacherController::class, 'manageStudents'])->name('teacher.manage_students');
    Route::delete('/teacher/delete-student/{id}', [TeacherController::class, 'deleteStudent'])->name('teacher.delete_student');
    Route::post('/teacher/student/{id}/assign-subject', [TeacherController::class, 'assignSubject'])->name('teacher.assign_subject');

    Route::delete('/students/{student}/subjects/{subject}', [TeacherController::class, 'deleteAssignedSubject'])->name('teacher.delete_assigned_subject');

// Route to join a class using the invitation code
Route::post('/student/join-class', [StudentController::class, 'joinClass'])->name('student.join_class');

// Routes for viewing quizzes and results
Route::get('/student/quizzes', [StudentController::class, 'viewQuizzes'])->name('student.view_quizzes');
Route::get('/student/results', [StudentQuizController::class, 'viewResults'])->name('student.view_results');

Route::get('/student/quizzes', [StudentQuizController::class, 'index'])->name('student.view_quizzes');
Route::get('/student/quiz/{id}/answer', [StudentQuizController::class, 'answerQuiz'])->name('student.answer_quiz');
Route::post('/student/quiz/{id}/submit', [StudentQuizController::class, 'submitQuiz'])->name('student.submit_quiz');
Route::get('/student/results', [StudentResultController::class, 'index'])->name('student.view_results');

Route::get('/teacher/quiz-results', [TeacherController::class, 'showResults'])->name('teacher.show_quiz_results');
});

// Include authentication routes (login, registration, etc.)
require __DIR__.'/auth.php';
