<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attendance' => $this ->faker ->randomElement(['D', 'N', 'M', 'P']),
            'student_id' => $this ->faker ->randomElement(DB::table('students')->pluck('id')),
            'lesson_id'	=> $this ->faker ->randomElement(DB::table('lessons')->pluck('id'))

        ];
    }
}
