<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends BaseModel
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'specialized_id',
        'school_year_id',
        'delete'
    ];

    protected $modelClass = Classroom::class;

    protected $table = 'classrooms';

    public function schoolYear(){
        return $this -> belongsTo( SchoolYear::class)->where('delete', false);
    }
    public  function specialized(){
        return $this -> belongsTo(Specialized::class)->where('delete', false);
    }

    /**
     * Lấy tất cả dữ liệu
     * @return mixed: mảng
     */
    function getAll() {
        $model = $this->modelClass;
        return $model::with('schoolYear')
            ->with('specialized')
            ->where('delete', false)
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }

    /**
     * Lấy tất cả dữ liệu
     * @return mixed: mảng
     */
    function getAllByRole() {
        $model = $this->modelClass;
        $email = session()->get('user')['email'];
        $user = Student::where('email',$email)->first();
        $class_id = $user->classroom_id ?? 0;
        return $model::with('schoolYear')
            ->with('specialized')
            ->where('delete', false)
            ->where(function ($query) use ($class_id){
                if(session()->get('user')['role'] == 2 && $class_id > 0){
                    $query->where('id', $class_id);
                }
            })
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }

    /**
     * Lấy chi tiết dữ liệu
     * @param $id: ID dòng dữ liệu
     * @return mixed
     */
    function getDetail($id)
    {
        $model = $this->modelClass;
        return $model::with('schoolYear')->with('specialized')->where('id', $id)->where('delete', false)->first();
    }
}
