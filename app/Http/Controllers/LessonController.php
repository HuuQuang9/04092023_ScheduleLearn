<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Lecturer;
use App\Models\Schedule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    protected $modelClass = Lesson::class;
    protected $folder = 'lessons';

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
        $schedules = (new Schedule())->getAll();
        $model = new $this->modelClass;
        $data = $model->getAll();
        $query =[
            'schedules' => $schedules,
            'data' => $data
        ];
       return view('pages/lessons/index', $query);
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        if ($params['substitute_instructor'] == 0) {
            $params['substitute_instructor'] = $params['lecturer_id'];
        }
        $model->addItem($params);
        return Redirect::route($this->folder.'.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        if ($params['substitute_instructor'] == 0) {
            $params['substitute_instructor'] = $params['lecturer_id'];
        }
        $model->updateItem($id, $params);
        return Redirect::route($this->folder.'.index');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
        $lecturers = (new Lecturer())->getAll();
        $schedules = (new Schedule())->getAll();
        $query=[
            'lecturers'=>$lecturers,
            'schedules'=>$schedules
        ];
        return view('pages/lessons/create', $query);
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
         $lecturers = (new Lecturer())->getAll();
         $schedules = (new Schedule())->getAll();
         $query=[
            'data'=>$data,
             'lecturers'=>$lecturers,
             'schedules'=>$schedules
         ];
         return view('pages/lessons/edit', $query);
    }

    /**
     * Lấy danh sách dữ liệu theo Id
     * @param  \App\Models\Student  $scheduleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItemsBySchedule(Request $request)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        $data = $model->getItemsBySchedule($params);
        return response()->json($data);
    }
    
    /**
     * Lấy danh sách dữ liệu theo Id
     * @param  \App\Models\Student  $scheduleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReportItemsBySchedule(Request $request)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        $data = $model->getReportItemsBySchedule($params);
        return response()->json($data);
    }
    
    /**
     * Lấy danh sách dữ liệu theo Id
     * @param  \App\Models\Student  $scheduleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItemsByScheduleToHtml($scheduleId)
    {
        $model = new $this->modelClass();
        $data = $model->getItemsByScheduleToHtml($scheduleId);
        return response()->json($data);
    }
}
