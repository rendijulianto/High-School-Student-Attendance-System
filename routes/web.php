<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeachController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/teachers/import', [TeacherController::class, 'import'])->name('teachers.import');
    Route::post('/teachers/import', [TeacherController::class, 'importStore'])->name('teachers.importStore');
    Route::resource('teachers', TeacherController::class)->names('teachers');
    //teaches
    Route::get('/teaches/{teacher}/import', [TeachController::class, 'import'])->name('teaches.import');
    Route::post('/teaches/{teacher}/import', [TeachController::class, 'importStore'])->name('teaches.importStore');
    Route::get('/teaches/{teacher}', [TeachController::class, 'index'])->name('teaches.index');
    Route::get('/teaches/{teacher}/create', [TeachController::class, 'create'])->name('teaches.create');
    Route::post('/teaches/{teacher}', [TeachController::class, 'store'])->name('teaches.store');
    Route::delete('/teaches/{teach}', [TeachController::class, 'destroy'])->name('teaches.destroy');


    // students
    Route::get('/students/import', [StudentController::class, 'import'])->name('students.import');
    Route::post('/students/import', [StudentController::class, 'importStore'])->name('students.importStore');
    Route::resource('students', StudentController::class)->names('students');
    // subjects
    Route::get('/subjects/import', [SubjectController::class, 'import'])->name('subjects.import');
    Route::post('/subjects/import', [SubjectController::class, 'importStore'])->name('subjects.importStore');
    Route::resource('subjects', SubjectController::class)->names('subjects');
});


require __DIR__.'/auth.php';
