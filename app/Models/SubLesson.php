<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class SubLesson extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name'              ,
        'start_time'        ,
        'end_time'          ,
        'date'              ,
        'substitute_instructor'     ,
        'schedule_id'       ,
        'lecturer_id'       ,
        'delete'            ,
        'is_attendance'     ,
        'date_attendance'   ,
        'approved'
    ];

    protected $modelClass = SubLesson::class;

    protected $table = 'lessons';

    public function lecturer(){
        return $this->belongsTo(Lecturer::class)->where('delete', false);
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class)->where('delete', false);
    }

    public function substituteInstructor(){
        return $this->belongsTo(Lecturer::class, 'substitute_instructor', 'id')->where('delete', false);
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Lấy tất cả dữ liệu
     * @return mixed: mảng
     */
    function getAll() {
        $model = $this->modelClass;
        $userId = 0;
        if (session()->get('user')['role'] == 1) {
            $userId =  session()->get('user')['id'];
        }
        return $model::with('lecturer:id,full_name')
            ->with('schedule')
            ->with('substituteInstructor:id,full_name')
            ->where('delete', false)
            ->where(function ($query) use ($userId){
                $query->where('substitute_instructor', $userId);
            })
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }
    
    
}
