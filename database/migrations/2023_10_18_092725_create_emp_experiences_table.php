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
        Schema::create('emp_experiences', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('company');
            $table->string('role');
            $table->decimal('year_of_experience',4,1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_experiences');
    }
};
