<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\BaseModel;
use Illuminate\Support\Facades\Redirect;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $modelClass = BaseModel::class;
    protected $model;
    protected $folder;

    public function __construct()
    {
        $this->model = new $this->modelClass;
    }

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
        return view('pages.' . $this->folder . '.index', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.' . $this->folder . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        $model->addItem($params);
        return Redirect::route($this->folder . '.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = new $this->modelClass();
        $data = $model->getDetail($id);
        $query = [
            'data' => $data,
        ];
        return view('pages.' . $this->folder . '.edit', $query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStudentRequest $request
     * @param \App\Models\Student $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = new $this->modelClass();
        $params = $request->all();
        $model->updateItem($id, $params);
        return Redirect::route($this->folder . '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = new $this->modelClass();
        $model->removeItem($id);
        return Redirect::route($this->folder . '.index');
    }

    /**
     * Lấy danh sách dữ liệu theo Id
     * @param  \App\Models\Student  $classroomId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getItemsByClassroom($classroomId)
    {
        $model = new $this->modelClass();
        $data = $model->getItemsByClassroom($classroomId);
        return response()->json($data);
    }
}
