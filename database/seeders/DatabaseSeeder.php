<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\EmpEducation::factory(5)->create();
        \App\Models\EmpFamily::factory(5)->create();
        \App\Models\EmpExperience::factory(5)->create();
    }
}
