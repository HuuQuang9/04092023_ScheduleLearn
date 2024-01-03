<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SchoolYear;
use App\Models\Specialized;

class SubjectController extends Controller
{

    protected $modelClass = Subject::class;
    protected $folder = 'subjects';

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
        return view('pages/subjects/index', $query);
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
        return view('pages/subjects/create', $query);
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



        $specializeds = (new Specialized())->getAll();
        $schoolYears = (new SchoolYear())->getAll();
        $query = [
            'data' => $data,
            'specializeds' => $specializeds,
            'schoolYears' => $schoolYears,
        ];
        return view('pages.' . $this->folder . '.edit', $query);
    }
}
