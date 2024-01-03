<?php

namespace App\Models;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Attendance extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'attendance'    ,
        'student_id'    ,
        'lesson_id'     ,
        'delete'        ,
    ];

    protected $modelClass = Attendance::class;

    protected $table = 'attendances';

    public function student(){
        return $this -> belongsTo(Student::class)->where('delete', false);
    }

    public function lesson(){
        return $this -> belongsTo(Lesson::class)->where('delete', false);
    }

    /**
     * Lấy tất cả dữ liệu
     * @return mixed: mảng
     */
    function getAll() {
        $model = $this->modelClass;
        date_default_timezone_set('UCT');
        return $model::with('student:id,full_name')
            ->with('lesson:id,name')
            ->where('delete', false)
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }



    function attendanceMulti($params)
    {
        $scheduleId = isset($params['schedule_id']) ? $params['schedule_id'] : 0;
        $classroomId = isset($params['classroom_id']) ? $params['classroom_id'] : 0;
    
        $date = isset($params['lesson_date']) ? $params['lesson_date'] : null;
        $scheduleIds = Schedule::where('delete', 0)->where('classroom_id', $classroomId)->where('subject_id', $scheduleId)->get()->pluck('id')->toArray();
        $lessons = Lesson::whereIn('schedule_id', $scheduleIds)->whereDate('date', $date)->get()->toArray();
        $lessonIds = array_column($lessons, 'id');
        foreach($params['students'] as $param) {
            $attendance = Attendance::where('student_id', $param['student_id'])->whereIn('lesson_id', $lessonIds)
                ->first();
            if ($attendance && $attendance->id) {
                $attendance->update(['attendance' => $param['attendance']]);
            } else {
                foreach($lessonIds as $lessonId) {
                    $param['lesson_id'] = $lessonId;
                    (new Attendance())->addItem($param);
                }
            }
            $lessonId = $param['lesson_id'] ?? 0;
        }
        if ($lessonId > 0) {
            $paramsUpdate = [
                'is_attendance' => true,
                'date_attendance' => Carbon::now()->format('Y-m-d'),
            ];
            if (isset($params['start_time'])) {
                $paramsUpdate['start_time'] = $params['start_time'];
            }
            if (isset($params['end_time'])) {
                $paramsUpdate['end_time'] = $params['end_time'];
            }
            (new Lesson())->updateItem($lessonId, $paramsUpdate);
        }
        return ['status' => true];
    }

    function reportAttendance($params)
    {
        $classroomId = isset($params['classroom_id']) ? $params['classroom_id'] : 0;
        $subjectId = isset($params['subject_id']) ? $params['subject_id'] : 0;
        $role = session()->get('user');
        if ($role['role'] == 2) {
            $classroomId = $role['classroom_id'];
        }

        $scheduleIds = Schedule::where('delete', 0)
            ->where('subject_id', $subjectId)
            ->where('classroom_id', $classroomId)
            ->get()
            ->pluck('id')
            ->toArray();

        $lessons = Lesson::where('delete', 0)
            ->whereIn('schedule_id', $scheduleIds)
            ->with('attendances')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();
        if (count($lessons) == 0) {
            return [
                'head' => [],
                'body' => [],
            ];
        }

        $lessonIds = array_column($lessons, 'id');

        $studentIds = Attendance::where('delete', 0)
            ->whereIn('lesson_id', $lessonIds)
            ->get()
            ->pluck('student_id')
            ->toArray();

        if ($role['role'] == 2) {
            $studentIds = [$role['id']];
        }

        $students = Student::where('delete', 0)
            ->whereIn('id', $studentIds)
            ->get()->toArray();

        $body = [];
        $head = [
            [
                'title' => 'Mã học viên'
            ],
            [
                'title' => 'Tên học viên'
            ],
            [
                'title' => 'Ngày sinh'
            ],
        ];
        foreach($lessons as $lesson) {
            $head[] = [
                'title' => Carbon::parse($lesson['date'], 'UTC')->format('d/m/Y'),
            ];
        }
        $head[] = ['title' => 'Nghỉ'];
        $head[] = ['title' => 'Tình trạng'];
        foreach($students as $key => $student) {
            $lessonArr = [];
            $n = 0;
            $attendanceTotal = 0;
            foreach($lessons as $lesson) {
                if (isset($lesson['attendances']) && is_array($lesson['attendances'])) {
                    foreach($lesson['attendances'] as $item) {
                        if ($item['student_id'] == $student['id']) {
                            $attendance = $item['attendance'];
                            $attendanceTotal++;
                            if ($attendance == 'N') {
                                $n++;
                            } else if ($attendance == 'M') {
                                $n += 0.3;
                            }else if ($attendance == 'P'){
                                $n += 0.3;
                            }
                        }
                    }
                }
            }
            $color = '#0c9204';
            if ($n > 0) {
                $cal = $attendanceTotal ? $n / $attendanceTotal * 100 : 0;
                if ($cal > 50) {
                    $color = 'red';
                } else if ($cal > 20 && $cal <= 50) {
                    $color = '#fff139';
                }
            }
            $studentArr = [
                '<span style="color:'.$color.'">'.$student['code'].'<p style="margin: 0;font-weight: 800">('.$n.'/'.$attendanceTotal.')</p>'.'</span>',
                '<span style="color:'.$color.'">'.$student['full_name'].'</span>',
                Carbon::parse($student['dob'], 'UTC')->format('d/m/Y'),
            ];
            foreach($lessons as $lesson) {
                $arr = [
                    'date' => $lesson['date'],
                    'is_attendance' => $lesson['is_attendance'],
                    'date_attendance' => $lesson['date_attendance'],
                    'attendance' => null,
                ];
                $attendance = '---';
                if (isset($lesson['attendances']) && is_array($lesson['attendances'])) {
                    foreach($lesson['attendances'] as $item) {
                        if ($item['student_id'] == $student['id']) {
                            $arr['attendance'] = $item;
                            $attendance = $item['attendance'];
                        }
                    }
                }
                $studentArr[] = $attendance;
                array_push($lessonArr, $arr);
            }
            $studentArr[] = '(' .$n.'/'.count($lessons). ')';
            $studentArr[] = '<span style="display: block; width: 50px; height: 50px;background: '.$color.';border-radius: 50%"></span>';
            $students[$key]['lessons'] = $lessonArr;
            $body[] = $studentArr;
        }

        return [
            'head' => $head,
            'body' => $body,
        ];
    }

    function checkAttendance($lecturer_id, $schedule_id){
        $currentTime = Date('Y-m-d H:i:s');
        $unixCurrentTime = strtotime($currentTime);
        $lesson = Lesson::all()
            ->where('is_attendance', 1)
            ->where('lecturer_id',$lecturer_id)
            ->oderBy('id', 'desc')
            -> get()
            -> firt();
        $startTime = $lesson -> start_time + $lesson -> date;
        $unixStartTime = strtotime($startTime);
        $endTime = $lesson -> end_time + $lesson -> date;
        $unixEndTime = strtotime($endTime);
        if($unixCurrentTime > $unixStartTime && $unixCurrentTime < $unixEndTime){
            if ($lesson -> schedule_id == $schedule_id){
                return 0;// update
            }else{
                return 2;// not attendance
            }
        }else{
            return 0;// attendance
        }
    }
}
