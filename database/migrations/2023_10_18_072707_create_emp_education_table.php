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
        Schema::create('emp_education', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('institution');
            $table->string('course');
            $table->decimal('cgpa', 3, 1);
            $table->year('graduation_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_education');
    }
};
