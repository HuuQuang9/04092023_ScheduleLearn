<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Lecturer;
use App\Models\Student;

class UserController extends Controller
{

    protected $modelClass = User::class;
    protected $folder = 'users';


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
        $uniqueUserEmailRule = Rule::unique('users', 'email')->where(function ($query) {
            return $query->where('delete', 0);
        });

        $validator = Validator::make($params, [
            'email' => ['required', 'email', $uniqueUserEmailRule],
        ]);

        if ($validator->fails()) {
            $err = [
                'error' => 'Email đã được sử dụng!',
            ];
            return back()->withErrors($err);
        }
        $model = new $this->modelClass();
        $params['position'] = 1;
        $model->addItem($params);
        return Redirect::route($this->folder . '.index');
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
        $uniqueUserEmailRule = Rule::unique('users', 'email')->where(function ($query) {
            return $query->where('delete', 0);
        })->ignore($id); // Loại trừ sinh viên hiện tại

        $validator = Validator::make($params, [
            'email' => ['required', 'email', $uniqueUserEmailRule],
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
