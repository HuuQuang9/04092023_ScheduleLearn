<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Models\Specialized;

class ClassroomController extends Controller
{

    protected $modelClass = Classroom::class;
    protected $folder = 'classrooms';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new $this->modelClass();
        $data = $model->getAll();
        $query = [
            'data' => $data,
        ];
        return view('pages.'.$this->folder.'.index', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schoolYears = (new SchoolYear())->getAll();
        $specializeds = (new Specialized())->getAll();

        $query = [
            'specializeds' => $specializeds,
            'schoolYears' => $schoolYears,
        ];
        return view('pages.classrooms.create', $query);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = new $this->modelClass();
        $data = $model->getDetail($id);

        $schoolYears = (new SchoolYear())->getAll();
        $specializeds = (new Specialized())->getAll();

        $query = [
            'specializeds' => $specializeds,
            'schoolYears' => $schoolYears,
            'data' => $data,
        ];

        return view('pages.classrooms.edit', $query);
    }
}
