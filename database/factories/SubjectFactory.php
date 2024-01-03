<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this -> faker -> companySuffix,
            'name' => $this -> faker -> company,
            'hour' => $this ->faker ->randomElement([20, 30, 40, 60]),
            'specialized_id' => $this -> faker ->randomElement(DB::table('specializeds')->pluck('id')),
            'school_year_id' => $this -> faker ->randomElement(DB::table('school_years')->pluck('id')),

        ];
    }
}
