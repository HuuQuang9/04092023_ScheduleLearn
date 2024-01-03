<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'code'    ,
        'name'    ,
        'hour'     ,
        'specialized_id'     ,
        'school_year_id'     ,
        'delete'        ,
    ];

    protected $modelClass = Subject::class;

    protected $table = 'subjects';

    /**
     * The function returns a relationship to the SchoolYear model where the "delete" attribute is set to
     * false.
     * 
     * @return a relationship to the "SchoolYear" model. The relationship is defined using the "belongsTo"
     * method, which indicates that the current model belongs to a "SchoolYear" model. The "where" method
     * is used to add a condition to the relationship query, specifying that the "delete" column should be
     * false.
     */
    public function schoolYear(){
        return $this->belongsTo( SchoolYear::class)->where('delete', false);
    }
    
    /**
     * The function returns a relationship to the "Specialized" model where the "delete" attribute is
     * set to false.
     * 
     * @return a relationship to the "Specialized" model, with a condition that the "delete" column is
     * set to false.
     */
    public  function specialized(){
        return $this->belongsTo(Specialized::class)->where('delete', false);
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
     * Lấy chi tiết dữ liệu
     * @param $id: ID dòng dữ liệu
     * @return mixed
     */
    function getDetail($id)
    {
        $model = $this->modelClass;
        return $model::with('schoolYear')->with('specialized')->where('id', $id)->where('delete', false)->first();
    }

    /**
     * The function retrieves items associated with a specific classroom, including related school years
     * and specialized fields.
     * 
     * @param classroomId The parameter `` is the ID of a classroom.
     * 
     * @return an array of items that belong to a specific classroom.
     */
    function getItemsByClassroom($classroomId)
    {
        $model = $this->modelClass;
        return $model::with('schoolYear')
            ->with('specialized')
            ->whereHas('specialized.classrooms', function($query) use ($classroomId) {
                $query->where('classrooms.id', $classroomId);
            })
            ->where('delete', false)
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }
}
