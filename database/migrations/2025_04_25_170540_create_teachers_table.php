<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('full_name', 100);
            $table->enum('gender', ['Male', 'Female']);
            $table->string('birth_place', 50);
            $table->date('birth_date');
            $table->string('religion', 20);
            $table->string('phone', 15);
            $table->string('email', 100)->unique();
            $table->text('address');
            $table->enum('status', ['aktif', 'tidak aktif']);
            $table->string('photo', 255)->nullable();
            $table->string('position', 50);
            $table->string('subject', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};