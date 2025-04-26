<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomSettingController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return view('index');
});


// Rute untuk pengaturan kelas
Route::get('classrooms/settings', [ClassroomSettingController::class, 'index'])->name('classrooms.settings');
Route::post('classrooms/settings', [ClassroomSettingController::class, 'update'])->name('classrooms.settings.update');


Route::resource('teachers', TeacherController::class);
Route::resource('classrooms', ClassroomController::class);
Route::resource('students', StudentController::class);
