<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = collect([
            [
            'name'=>'Talha',
            'email'=>'talha@gmail.com'
            ],
            [
            'name'=>'Raza',
            'email'=>'raza@gmail.com'
            ],
            [
            'name'=>'Ahmar',
            'email'=>'ahmar@gmail.com'
            ]
        ]);
        $students->each(function($student){
            student::insert($student);
        });
        // student::create([
        //     'name'=>'Talha',
        //     'email'=>'talha@gmail.com'
        // ]);
    }
}
