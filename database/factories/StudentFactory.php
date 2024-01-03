<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this -> faker -> bothify('BKC#####'),
            'full_name' => $this -> faker -> name,
            'email' => $this -> faker -> email,
            'password' => $this -> faker -> password,
            'dob'	=> $this ->faker -> date,
            'gender' => $this -> faker -> randomElement([0, 1]),
            'address' => $this -> faker -> address	,
            'phone'	=> $this ->faker -> phoneNumber,
            'classroom_id' => $this -> faker ->randomElement(DB::table('classrooms')->pluck('id')),
        ];
    }
}
