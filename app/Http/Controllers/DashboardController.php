<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Grade, Student, Teacher};
// Inertia
use Inertia\Inertia;
class DashboardController extends Controller
{
    public function index()
    {
        $total_student = Student::count();
        $total_teacher = Teacher::count();
        $total_grade = Grade::count();
        return Inertia::render('Dashboard', [
            'total_student' => $total_student,
            'total_teacher' => $total_teacher,
            'total_grade' => $total_grade,
        ]);
    }

    public function teacher()
    {
        $total_student = Student::count();
        $total_teacher = Teacher::count();
        $total_grade = Grade::count();
        return Inertia::render('DashboardTeacher', [
            'total_student' => $total_student,
            'total_teacher' => $total_teacher,
            'total_grade' => $total_grade,
        ]);
    }
}
