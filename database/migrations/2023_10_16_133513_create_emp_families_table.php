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
        Schema::create('emp_families', function (Blueprint $table) {
            $table->id('family_id');
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete;
            $table->string('family_name');
            $table->string('relationship');
            $table->date('dob');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_families');
    }
};