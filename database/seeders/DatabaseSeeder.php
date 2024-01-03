<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this ->call(SpecializedSeeder::class);
        $this ->call(SchoolYearSeeder::class);
        $this ->call(UserSeeder::class);
        $this ->call(ClassroomSeeder::class);
        $this ->call(SubjectSeeder::class);
        $this ->call(LecturerSeeder::class);
        $this ->call(StudentSeeder::class);
        $this ->call(ScheduleSeeder::class);
        $this ->call(LessonSeeder::class);
        $this ->call(AttendanceSeeder::class);
        $this ->call(UsersTableSeeder::class);
    }
}
