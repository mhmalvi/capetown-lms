<?php

namespace Database\Seeders;

use App\Models\CourseUnit;
use Illuminate\Database\Seeder;

class CourseUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Core Unit'],
            ['name' => 'Elective Unit'],
        ];

        CourseUnit::insert($data);
    }
}
