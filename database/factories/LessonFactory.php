<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this ->faker -> text(10),
            'start_time' => $this ->faker ->time('H:i'),
            'end_time' => $this ->faker ->time('H:i'),
            'date' => $this -> faker -> date,
            'substitute_instructor' => $this ->faker ->randomElement([0]),
            'schedule_id' => $this ->faker ->randomElement(DB::table('schedules')->pluck('id')),
            'lecturer_id' => $this ->faker ->randomElement(DB::table('lecturers')->pluck('id'))
        ];
    }
}
