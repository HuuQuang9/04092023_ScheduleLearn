<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    protected $modelClass = Attendance::class;
    protected $folder = 'attendances';

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
        $role = session()->get('user');
        $roleL = $role['role'];
        $lecturerId = $role['id'];
        $classroomIds = (new Schedule())
            ->where('delete', 0)
            ->where(function($query) use ($roleL, $lecturerId) {
                if ($roleL == 1) {
                    $query->where('lecturer_id', $lecturerId);
                }
            })
            ->get()
            ->pluck('classroom_id')
            ->toArray();
        $classrooms = Classroom::whereIn('id', $classroomIds)->where('delete', 0)->get()->toArray();
        $subjects = [];
        $schedules = (new Schedule())->getAll();
        if ($role['role'] == 2) {
            $subjectIds = (new Schedule())
            ->where('delete', 0)
            ->where('classroom_id', $role['classroom_id'])
            ->get()
            ->pluck('subject_id')
            ->toArray();
            $subjects = Subject::where('delete', 0)->whereIn('id', $subjectIds)->get()->toArray();
        }
        $query =[
            'classrooms' => $classrooms,
            'schedules' => $schedules,
            'subjects' => $subjects,
        ];
       return view('pages/attendances/index', $query);
   }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function add()
    {
        $role = session()->get('user');
        $roleL = $role['role'];
        $lecturerId = $role['id'];
        $classroomIds = (new Schedule())
            ->where('delete', 0)
            ->where(function($query) use ($roleL, $lecturerId) {
                if ($roleL == 1) {
                    $query->where('lecturer_id', $lecturerId);
                }
            })
            ->get()
            ->pluck('classroom_id')
            ->toArray();
        $classrooms = Classroom::whereIn('id', $classroomIds)->where('delete', 0)->get()->toArray();
        $subjects = [];
        $schedules = (new Schedule())->getAll();
        if ($role['role'] == 2) {
            $subjectIds = (new Schedule())
                ->where('delete', 0)
                ->where('classroom_id', $role['classroom_id'])
                ->get()
                ->pluck('subject_id')
                ->toArray();
            $subjects = Subject::where('delete', 0)->whereIn('id', $subjectIds)->get()->toArray();
        }
        $query =[
            'classrooms' => $classrooms,
            'schedules' => $schedules,
            'subjects' => $subjects,
        ];
        return view('pages/attendances/add', $query);
    }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
        $lessons = (new Lesson())->getAll();
        $students = (new Student())->getAll();
        $query =[
            'lessons'=> $lessons,
            'students' =>$students
        ];
        return view('pages/attendances/create', $query);
   }


   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $model = new $this->modelClass();
        $data = $model->getDetail($id);
         $lessons = (new Lesson())->getAll();
         $students = (new Student())->getAll();
         $query =[
            'data'=>$data,
            'lessons'=> $lessons,
            'students' =>$students
         ];
         return view('pages/attendances/edit', $query);
    }

    /**
     * Điểm danh nhiều học viên theo buổi học
     * @return \Illuminate\Http\JsonResponse
     */
    public function attendanceMulti(Request $request)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        $data = $model->attendanceMulti($params);
        return response()->json($data);
    }

    /**
     * Thống kê điểm danh
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportAttendance(Request $request)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        $data = $model->reportAttendance($params);
        return response()->json($data);
    }
}
