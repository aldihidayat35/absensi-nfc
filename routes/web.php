<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomSettingController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\TeacherAuthController;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('auth.teacher-login');
});
Route::get('login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');

Route::get('teacher/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
Route::post('teacher/login', [TeacherAuthController::class, 'login']);
Route::post('teacher/logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');

// yang bisa diakses guru

    Route::get('/classrooms/overview', [ClassroomController::class, 'overview']);


// yang bisa diakses admin
    // Rute untuk halaman utama
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('classrooms/overview', [ClassroomController::class, 'overview'])->name('classrooms.overview');
    Route::get('classrooms/settings', [ClassroomSettingController::class, 'index'])->name('classrooms.settings');
    Route::post('classrooms/settings', [ClassroomSettingController::class, 'update'])->name('classrooms.settings.update');

    // Rute untuk pengelolaan siswa
    Route::resource('students', StudentController::class);

    // Rute untuk pengelolaan guru
    Route::resource('teachers', TeacherController::class);

    // Rute untuk pengelolaan kelas
    Route::resource('classrooms', ClassroomController::class);

    // Rute untuk pengelolaan mata pelajaran
    Route::resource('subjects', SubjectController::class);