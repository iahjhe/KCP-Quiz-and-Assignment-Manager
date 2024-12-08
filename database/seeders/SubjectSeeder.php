<?php

namespace Database\Seeders;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Subject::create(['name' => 'Mathematics']);
        \App\Models\Subject::create(['name' => 'Science']);
        \App\Models\Subject::create(['name' => 'History']);
        // Add more subjects as needed
    }
    
}
