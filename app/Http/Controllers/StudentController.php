<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Student;
use App\Models\Classroom;


class StudentController extends Controller
{

    protected $modelClass = Student::class;
    protected $folder = 'students';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = (new Classroom())->getAll();
        $query = [
            'classrooms' => $classrooms,
        ];
        return view('pages/students/create', $query);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        // Tạo một Rule Validation custom
        $uniqueStudentEmailRule = Rule::unique('students', 'email')->where(function ($query) {
            return $query->where('delete', 0);
        });

        $validator = Validator::make($params, [
            'email' => ['required', 'email', $uniqueStudentEmailRule],
        ]);

        if ($validator->fails()) {
            $err = [
                'error' => 'Email đã được sử dụng!',
            ];
            return back()->withErrors($err);
        }
        $model = new $this->modelClass();
        $model->addItem($params);
        return Redirect::route($this->folder . '.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = new $this->modelClass();
        $data = $model->getDetail($id);
        $classrooms = (new Classroom())->getAll();
        $query = [
            'data' => $data,
            'classrooms' => $classrooms,
        ];
        return view('pages.' . $this->folder . '.edit', $query);
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
        $params = $request->all();
        // Tạo một Rule Validation custom giống như trong hàm store
        $uniqueStudentEmailRule = Rule::unique('students', 'email')->where(function ($query) {
            return $query->where('delete', 0);
        })->ignore($id); // Loại trừ sinh viên hiện tại

        $validator = Validator::make($params, [
            'email' => ['required', 'email', $uniqueStudentEmailRule],
        ]);

        if ($validator->fails()) {
            $err = [
                'error' => 'Email đã được sử dụng!',
            ];
            return back()->withErrors($err);
        }

        $model->updateItem($id, $params);
        return Redirect::route($this->folder . '.index');
    }

    /**
     * Lấy danh sách dữ liệu theo Id
     * @param  \App\Models\Student  $scheduleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItemsBySchedule($scheduleId, Request $request)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        $data = $model->getItemsBySchedule($scheduleId, $params);
        return response()->json($data);
    }
}
