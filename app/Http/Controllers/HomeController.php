<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Classroom;

class HomeController extends Controller
{
    public function view()
    {
        // Lấy danh sách học viên tính tỷ lệ đi học, nghỉ học, muộn, phép
        $student = Student::all()->where('delete', 0)->count();
        $students = Student::all()->where('delete', 0)->toArray();

        $schedules = (new Schedule())->getAll();

        $lecturer = Lecturer::all()->where('delete', 0)->count();
        $subject = Subject::all()->where('delete', 0)->count();
        $schedule = Schedule::all()->where('delete', 0)->count();

        // Tính tý lệ điểm danh
        $attendance = Attendance::all()->where('delete',0)->whereIn('attendance', ['H','M','N','P'])->count();
        $countH = Attendance::all()->where('delete',0)->where('attendance',"H")->count();
        $countM = Attendance::all()->where('delete',0)->where('attendance',"M")->count();
        $countN = Attendance::all()->where('delete',0)->where('attendance',"N")->count();
        $countP = Attendance::all()->where('delete',0)->where('attendance',"P")->count();
        $H = $countH > 0 ? $countH / $attendance * 100 : 0;
        $M = $countM > 0 ? $countM / $attendance * 100 : 0;
        $N = $countN > 0 ? $countN / $attendance * 100 : 0;
        $P = $countP > 0 ? $countP / $attendance * 100 : 0;

        $classrooms = Classroom::where('delete', 0)->get()->toArray();

        $query = [
            'attendance'=> $attendance,
            'student' => $student,
            'lecturer' => $lecturer,
            'subject' => $subject,
            'schedule' => $schedule,
            'schedules' => $schedules,
            'classrooms' => $classrooms,
            'H' => $H,
            'M' => $M,
            'N' => $N,
            'P' => $P,
        ];

        return view('pages/home/index', $query);
    }
}
