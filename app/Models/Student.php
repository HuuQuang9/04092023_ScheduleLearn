<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Student extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'code'          ,
        'full_name'     ,
        'email'         ,
        'password'      ,
        'dob'           ,
        'gender'        ,
        'address'       ,
        'phone'         ,
        'classroom_id'  ,
        'delete'        ,
        'image'
    ];

    protected $modelClass = Student::class;

    protected $table = 'students';

    public  function classroom(){
        return $this->belongsTo(Classroom::class)->where('delete', false);
    }

    /**
     * Lấy tất cả dữ liệu
     * @return mixed: mảng
     */
    function getAll() {
        $model = $this->modelClass;
        return $model::with('classroom')
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
        return $model::with('classroom')->where('id', $id)->where('delete', false)->first();
    }

    /**
     * The function retrieves items based on a given schedule ID and returns them along with their
     * associated classroom.
     * 
     * @param scheduleId The scheduleId parameter is the ID of a schedule.
     * 
     * @return an array of items that are associated with a specific schedule.
     */
    function getItemsBySchedule($scheduleId, $params)
    {
        $model = $this->modelClass;
        $date = isset($params['date']) ? $params['date'] : null;
        $classroomId = $params['classroom_id'] ?? 0;

        $scheduleIds = Schedule::where('delete', 0)->where('classroom_id', $classroomId)->where('subject_id', $scheduleId)->get()->pluck('id')->toArray();

        $students = $model::select('id', 'code', 'full_name')
            ->where('delete', false)
            ->where('classroom_id', $classroomId)
            ->orderBy('id', 'desc')
            ->get()->toArray();

        $studentIds = array_column($students, 'id');

        $attendances = Attendance::whereHas('lesson', function ($subQuery) use ($date, $scheduleIds) {
                $subQuery->whereDate('lessons.date', $date)->whereIn('lessons.schedule_id', $scheduleIds);
            })
            ->whereIn('student_id', $studentIds)
            ->get()
            ->toArray();

        $lesson = Lesson::whereIn('schedule_id', $scheduleIds)->whereDate('date', $date)->first();
        $dateNow = Carbon::now()->format('Y-m-d');
        $isCheck = true;
        $lessonAttendances = Lesson::whereDate('date_attendance', $dateNow)->where('delete', 0)->get()->toArray();
        $dateNowTime = Carbon::now();
        if (count($lessonAttendances) > 0) {
            foreach($lessonAttendances as $lessonAttendance) {
                if ($lessonAttendance['schedule_id'] != ($lesson['schedule_id'] ?? 0)) {
                    $start_date = Carbon::parse($dateNow.' '.$lessonAttendance['start_time']);
                    $end_date = Carbon::parse($dateNow.' '.$lessonAttendance['end_time']);
                    if ($start_date < $dateNowTime && $dateNowTime < $end_date) {
                        $isCheck = false;
                    }
                }
            } 
        }
        if (!$isCheck) {
            return [
                'lesson' => [],
                'students' => [],
            ];
        }
        $data['lesson'] = $lesson;
        $data['students'] = [];
        if ($data['lesson']) {
            foreach($students as $key => $student) {
                $students[$key]['attendance'] = 0;
                foreach($attendances as $attendance) {
                    if ($student['id'] == $attendance['student_id']) {
                        $students[$key]['attendance'] = $attendance['attendance'];
                    }
                }
            }
            $data['students'] = $students;
        }
        return $data;
    }
}
