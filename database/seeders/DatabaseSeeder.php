<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\citie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\student;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        user::factory(10)->create();
        student::factory(10)->create();
        citie::factory(5)->create();
    }
}
