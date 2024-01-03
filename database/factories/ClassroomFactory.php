<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this -> faker -> bothify('BT?##'),
            'specialized_id' => $this -> faker ->randomElement(DB::table('specializeds')->pluck('id')),
            'school_year_id' => $this -> faker ->randomElement(DB::table('school_years')->pluck('id')),

        ];
    }
}
