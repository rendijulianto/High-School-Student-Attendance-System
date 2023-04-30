<?php
// DashboardController
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeachController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GradeStudentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PresenceController;
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

Route::get('/login/teacher', [LoginController::class, 'index'])->name('login.teacher');
Route::post('/login/teacher', [LoginController::class, 'isLogin'])->name('isLogin.teacher');


Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // teachers
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
    // grades
    Route::get('/grades/import', [GradeController::class, 'import'])->name('grades.import');
    Route::post('/grades/import', [GradeController::class, 'importStore'])->name('grades.importStore');
    Route::resource('grades', GradeController::class)->names('grades');
    // grade students
    Route::get('/gradeStudents/{grade}/import', [GradeStudentController::class, 'import'])->name('gradeStudents.import');
    Route::post('/gradeStudents/{grade}/import', [GradeStudentController::class, 'importStore'])->name('gradeStudents.importStore');
    Route::get('/gradeStudents/{grade}', [GradeStudentController::class, 'index'])->name('gradeStudents.index');
    Route::get('/gradeStudents/{grade}/create', [GradeStudentController::class, 'create'])->name('gradeStudents.create');
    Route::post('/gradeStudents/{grade}', [GradeStudentController::class, 'store'])->name('gradeStudents.store');
    Route::delete('/gradeStudents/{gradeStudent}', [GradeStudentController::class, 'destroy'])->name('gradeStudents.destroy');
    // schedules
    Route::get('/schedules/{grade}/import', [ScheduleController::class, 'import'])->name('schedules.import');
    Route::post('/schedules/{grade}/import', [ScheduleController::class, 'importStore'])->name('schedules.importStore');
    Route::get('/schedules/{grade}', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/{grade}/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules/{grade}', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    // ajax
    Route::get('/ajax/teach/{subject_id}', [AjaxController::class, 'teach'])->name('ajax.teach');
});

Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])->name('dashboard.teacher');
    // presences
    Route::get('/presences/{schedule}/view', [PresenceController::class, 'view'])->name('presences.view');
    Route::get('/presences/{schedule}/create', [PresenceController::class, 'create'])->name('presences.create');
    Route::get('/presences', [PresenceController::class, 'index'])->name('presences.index');
    Route::post('/presences/{schedule}', [PresenceController::class, 'store'])->name('presences.store');
    Route::get('/presences/{schedule}/edit', [PresenceController::class, 'edit'])->name('presences.edit');
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';
