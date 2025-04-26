<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('full_name');
            $table->string('parent_phone'); // Tambahkan setelah kolom 'phone'

            $table->string('birth_place');
            $table->date('birth_date');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('religion');
            $table->text('address');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('nationality');
            $table->string('photo')->nullable(); // Path foto siswa
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'birth_place',
                'parent_phone',
                'birth_date',
                'gender',
                'religion',
                'address',
                'phone',
                'email',
                'nationality',
                'photo',
            ]);
        });
    }
};