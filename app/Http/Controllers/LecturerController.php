<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Lecturer;
use App\Models\Specialized;

class LecturerController extends Controller
{

    protected $modelClass = Lecturer::class;
    protected $folder = 'lecturers';

    //    /**
    //     * Display a listing of the resource.
    //     *
    //     * @return \Illuminate\Http\Response
    //     */
    //    public function index()
    //    {
    //        return view('pages/lecturers/index');
    //    }
    //
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specializeds = (new Specialized())->getAll();

        $query = [
            'specializeds' => $specializeds,
        ];
        return view('pages/lecturers/create', $query);
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
        $uniqueStudentEmailRule = Rule::unique('lecturers', 'email')->where(function ($query) {
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
     * Show the form for creating a new resource.
     * @param  \App\Models\Lecturer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = new $this->modelClass();
        $data = $model->getDetail($id);
        $specializeds = (new Specialized())->getAll();

        $query = [
            'data' => $data,
            'specializeds' => $specializeds,
        ];
        return view('pages/lecturers/edit', $query);
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
        // Tạo một Rule Validation custom giống như trong hàm store
        $uniqueLecturerEmailRule = Rule::unique('lecturers', 'email')->where(function ($query) {
            return $query->where('delete', 0);
        })->ignore($id); // Loại trừ sinh viên hiện tại

        $validator = Validator::make($params, [
            'email' => ['required', 'email', $uniqueLecturerEmailRule],
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
}
