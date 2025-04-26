<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Classroom;
use App\Models\Student;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Bagikan data ke seluruh halaman
        View::composer('layout.partials.sidebar._stats', function ($view) {
            $totalClasses = Classroom::count(); // Hitung total kelas
            $totalStudents = Student::count(); // Hitung total siswa

            $view->with([
                'totalClasses' => $totalClasses,
                'totalStudents' => $totalStudents,
            ]);
        });
    }

    public function register()
    {
        //
    }
}