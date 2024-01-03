<?php

namespace App\Http\Controllers;

use App\Models\SubLesson;
use App\Models\Schedule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class SubLessonController extends Controller
{

    protected $modelClass = SubLesson::class;
    protected $folder = 'subLessons';

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
        $model = new $this->modelClass;
        $data = $model->getAll();
        $query =[
            'data' => $data
        ];
       return view('pages/subLessons/index', $query);
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
        $model->updateItem($id, ['approved' => (int)$params['approved']]);
        return Redirect::route($this->folder.'.index');
    }
}
