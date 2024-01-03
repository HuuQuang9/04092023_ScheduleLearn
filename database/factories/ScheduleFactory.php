<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'location' => $this -> faker -> bothify('phong #0#'),
            'weekday' => $this -> faker -> randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']),
            'start_time' => $this -> faker ->time('H:i','now'),
            'end_time' => $this -> faker ->time('H:i','now'),
            'start_day' => $this -> faker ->date,
            'classroom_id' => $this ->faker ->randomElement(DB::table('classrooms')->pluck('id')),
            'subject_id' => $this -> faker ->randomElement(DB::table('subjects')->pluck('id')),
            'lecturer_id' => $this -> faker ->randomElement(DB::table('lecturers')->pluck('id')),
        ];
    }
}
