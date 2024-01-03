<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecturer extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'full_name'     ,
        'email'         ,
        'password'      ,
        'dob'           ,
        'gender'        ,
        'address'       ,
        'phone'         ,
        'specialized_id'         ,
        'delete'        ,
        'image'
    ];

    protected $modelClass = Lecturer::class;

    protected $table = 'lecturers';

    /**
     * The function "specialized" returns a relationship to the "Specialized" model where the "delete"
     * attribute is set to false.
     * 
     * @return a relationship to the "Specialized" model. The relationship is defined using the "belongsTo"
     * method, which indicates that the current model belongs to the "Specialized" model. The "where"
     * method is used to add a condition to the relationship query, specifying that the "delete" column
     * should be false.
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
        return $model::with('specialized')
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
        return $model::with('specialized')->where('id', $id)->where('delete', false)->first();
    }

    /**
     * The function retrieves items associated with a specific classroom, ordered by ID in descending
     * order, and excluding items that have been marked as deleted.
     * 
     * @param classroomId The parameter `` is the ID of the classroom for which you want to
     * retrieve items.
     * 
     * @return an array of items that belong to a specific classroom.
     */
    function getItemsByClassroom($classroomId)
    {
        $model = $this->modelClass;
        return $model::with('specialized')
            ->whereHas('specialized.classrooms', function($query) use ($classroomId) {
                $query->where('classrooms.id', $classroomId);
            })
            ->where('delete', false)
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }
}
