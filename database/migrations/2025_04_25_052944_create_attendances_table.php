<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->tinyInteger('period')->comment('Jam ke-berapa (1-9)');
            $table->enum('status', ['Hadir', 'Terlambat', 'Izin', 'Sakit', 'Alpha']);
            $table->time('check_in_time')->nullable();
            $table->string('recorded_by')->nullable(); // Nama guru/petugas yang input
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
