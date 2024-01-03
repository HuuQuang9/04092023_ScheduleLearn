<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class LecturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this -> faker -> name,
            'email' => $this -> faker -> email,
            'password' => $this -> faker -> password,
            'dob'	=> $this ->faker -> date,
            'gender' => $this -> faker -> randomElement([0, 1]),
            'address' => $this -> faker -> address	,
            'phone'	=> $this ->faker -> phoneNumber,
            'specialized_id' => $this -> faker ->randomElement(DB::table('specializeds')->pluck('id')),
        ];
    }
}
