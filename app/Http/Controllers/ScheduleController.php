<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Lecturer;

class ScheduleController extends Controller
{

    protected $modelClass = Schedule::class;
    protected $folder = 'schedules';

//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
   public function index()
   {
       $model = new $this->modelClass();
       $classrooms = (new Classroom())->getAllByRole();
       $data = $model->getAll();
       $query = [
           'data' => $data,
           'classrooms' => $classrooms
       ];
       return view('pages.schedules.index', $query);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
    $classrooms = (new Classroom())->getAll();
    $subjects = (new Subject())->getAll();
    $lecturers = (new Lecturer())->getAll();
    $query=[
        'classrooms'=>$classrooms,
        'subjects' => $subjects,
        'lecturers'=>$lecturers
    ];
       return view('pages/schedules/create', $query);
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
        $classrooms = (new Classroom())->getAll();
        $subjects = (new Subject())->getAll();
        $lecturers = (new Lecturer())->getAll();
        $query=[
            'data'=>$data,
            'classrooms'=>$classrooms,
            'subjects' => $subjects,
            'lecturers'=>$lecturers
        ];
        return view('pages/schedules/edit', $query);
    }

    /**
     * Lấy danh sách dữ liệu theo Id
     * @param  \App\Models\Student  $scheduleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItemsByClassroomToHtml($classroomId)
    {
        $model = new $this->modelClass();
        $data = $model->getItemsByClassroomToHtml($classroomId);
        return response()->json($data);
    }
    
    /**
     * Lấy danh sách dữ liệu theo Id
     * @param  \App\Models\Student  $scheduleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItemsByClassroom($classroomId)
    {
        $model = new $this->modelClass();
        $data = $model->getItemsByClassroom($classroomId);
        return response()->json($data);
    }


}
