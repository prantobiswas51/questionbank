<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use App\Models\Year;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Year::create([
            'year' => '1',
        ]);
        Year::create([
            'year' => '2',
        ]);
        Year::create([
            'year' => '3',
        ]);
        Year::create([
            'year' => '4',
        ]);

        Subject::create([
            'year_id' => 4,
            'subject_name' => 'English',
        ]);
    }
}
