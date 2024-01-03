<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Schedule extends BaseModel
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'location'      ,
        'weekday'       ,
        'start_time'    ,
        'end_time'      ,
        'start_day'     ,
        'classroom_id'  ,
        'subject_id'    ,
        'lecturer_id'   ,
        'delete'        ,
    ];

    protected $modelClass = Schedule::class;

    protected $table = 'schedules';

    public function lecturer(){
        return $this->belongsTo(Lecturer::class)->where('delete', false);
    }

    public function subject(){
        return $this->belongsTo(Subject::class)->where('delete', false);
    }

    public  function classroom(){
        return $this->belongsTo(Classroom::class)->where('delete', false);
    }

    /**
     * Thêm mới dữ liệu
     * @param $params: biến truyền vào
     * @return mixed: mảng
     */
    function addItem($params)
    {
        //biến modelClass sẽ cho biết nó sẽ gọi tới model nào
        //Nó được truyền giá trị từ Model cái mà được gọi thông qua controller và được kế thừa từ baseModel
        $model = new $this->modelClass();
        $params['weekday'] = implode(',', $params['weekdays']);
        //biến $params được gửi tới thông qua form bao gồm $column(tên cột trong bảng dữ liệu) và $param(giá trị sẽ lưu vào cột đó)
        if(is_array($params)) {
            foreach ($params as $column => $param) {
                //kiểm tra xem các dữ liệu gửi tới trong mảng params có nằm trong fillable không
                if (in_array($column, $this->fillable)) {
                    $model->$column = strip_tags(trim($param));
                }
            }
        }

        $model->save();

        $dayOfWeeks = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $dayOfWeeksVi = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];

        // $paramsCreate = [];
        // foreach($params['weekdays'] as $item) {
        //     $params['weekday'] = $item;
        //     $schedule = (new Schedule())->create($params);
        //     $dayOfWeek = array_search($params['weekday'], $dayOfWeeks);
        //     $paramsCreate[] = [
        //         'schedule_id' => $schedule->id,
        //         'day_of_week' => $dayOfWeek,
        //     ];
        // }
        $dayOfWeekArr = [];
        if (isset($params['weekdays']) && is_array($params['weekdays'])) {
            foreach($params['weekdays'] as $weekday) {
                $dayOfWeek = array_search($weekday, $dayOfWeeks);
                $dayOfWeekArr[] = $dayOfWeek;
            }
        }
        $start  = new Carbon('2023-01-01 '. $params['start_time']);
        $end    = new Carbon('2023-01-01 '. $params['end_time']);
        $hour = (int)$start->diff($end)->format('%H');
        $minute = (int)$start->diff($end)->format('%I');
        $hour += ($minute / 60);
        $hourSubject = (int)(Subject::find($params['subject_id']))->hour;
        $hour = ceil($hourSubject / $hour);

        $startDate = Carbon::parse($params['start_day']);
        $start = $startDate->copy();
        $endDate = $startDate->add($hour, 'weeks');
        $lessonParams = [];
        
        $dayOfWeek = array_search($params['weekday'], $dayOfWeeks);

        while ($start <= $endDate) {
            $arr = [
                'substitute_instructor' => 0,
                'start_time' => $params['start_time'],
                'end_time' => $params['end_time'],
                'lecturer_id' => $params['lecturer_id'],
                'schedule_id' => $model->id,
                'name' => $params['location'] . ' - ' . $dayOfWeeksVi[$dayOfWeek],
            ];
            $day = $start->dayOfWeek;
            // if (in_array($day, $dayOfWeekArr) && count($lessonParams) < $hour) {
            //     $scheduleSearch = array_search($day, array_column($paramsCreate, 'day_of_week'));
            //     if ($scheduleSearch > -1) {
            //        $schedule = $paramsCreate[$scheduleSearch];
            //        $arr['schedule_id'] = $schedule['schedule_id'];
            //     }
            //     $arr['date'] = $start->format('Y-m-d');
            //     $lessonParams[] = $arr;
            // }
            if (in_array($day, $dayOfWeekArr) && count($lessonParams) < $hour) {
                $arr['date'] = $start->format('Y-m-d');
                $lessonParams[] = $arr;
            }
            $start->addDay();
        }
        DB::table('lessons')->insert($lessonParams);
        return $model->id;
    }

    /**
     * Lấy tất cả dữ liệu
     * @return mixed: mảng
     */
    function getAll() {
        $model = $this->modelClass;
        $email = session()->get('user')['email'];
        $user = Student::where('email',$email)->first();
        $lecturer = Lecturer::where('email',$email)->first();
        $class_id = $user->classroom_id ?? 0;
        $lecturer_id = $lecturer->id ?? 0;

        $scheduleIds = Lesson::where('approved', 1)->where('delete', 0)
            ->where('substitute_instructor', session()->get('user')['id'])
            ->get()->pluck('schedule_id')->toArray();

        return Schedule::where('delete', false)
            ->with('lecturer')
            ->with('classroom')
            ->with('subject')
            ->where(function ($query) use ($class_id, $lecturer_id){
                if(session()->get('user')['role'] == 2 && $class_id > 0){
                    $query->where('classroom_id', $class_id);
                }
                if(session()->get('user')['role'] == 1 && $lecturer_id > 0){
                    $query->where('lecturer_id', $lecturer_id);
                }
            })
            ->where('delete', false)
            ->orWhereIn('id', $scheduleIds)
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
        return $model::with('subject')
            ->with('lecturer')
            ->with('classroom')
            ->where('id', $id)
            ->where('delete', false)
            ->first();
    }

    function getItemsByClassroom($classroomId) {
        $subjectIds = (new Schedule())
            ->where('delete', 0)
            ->where('classroom_id', $classroomId)
            ->get()
            ->pluck('subject_id')
            ->toArray();
        $subjects = Subject::where('delete', 0)
            ->whereIn('id', $subjectIds)
            ->get()->toArray();

        return $subjects;
    }

    function getItemsByClassroomToHtml($classroomId) {
        $model = $this->modelClass;
        $email = session()->get('user')['email'];
        $user = Student::where('email',$email)->first();
        $lecturer = Lecturer::where('email',$email)->first();
        $lecturer_id = $lecturer->id ?? 0;
        $class_id = $user->classroom_id ?? 0;

        $data = $model::where('delete', false)
            ->with('lecturer')
            ->with('classroom')
            ->with('subject')
            ->where('classroom_id', $classroomId)
            ->where(function ($query) use ($class_id, $lecturer_id){
                if(session()->get('user')['role'] == 2 && $class_id > 0){
                    $query->where('classroom_id', $class_id);
                }
                if(session()->get('user')['role'] == 1 && $lecturer_id > 0){
                    $query->where('lecturer_id', $lecturer_id);
                }
            })
            ->where('delete', false)
            ->orderBy('id', 'desc')
            ->get()->toArray();

        ob_start();
        foreach ($data as $key => $item){
        ?>
        <tr>
            <td class='text-center align-middle'><?php echo $key + 1 ?></td>
            <td class='text-center align-middle'><?php echo $item['location'] ?></td>
            <td class='text-center align-middle'>
                <?php
                $weekdays = explode(',',$item['weekday']);
                $name = null;
                foreach($weekdays as $weekday) {
                    if ($weekday == 'Sunday') {
                        $name .= ($name ? ' - ' : '') . 'Chủ nhật';
                    } else if ($weekday == 'Monday') {
                        $name .= ($name ? ' - ' : '') . 'Thứ hai';
                    } else if ($weekday == 'Tuesday') {
                        $name .= ($name ? ' - ' : '') . 'Thứ ba';
                    } else if ($weekday == 'Wednesday') {
                        $name .= ($name ? ' - ' : '') . 'Thứ tư';
                    } else if ($weekday == 'Thursday') {
                        $name .= ($name ? ' - ' : '') . 'Thứ năm';
                    } else if ($weekday == 'Friday') {
                        $name .= ($name ? ' - ' : '') . 'Thứ sáu';
                    } else if ($weekday == 'Saturday') {
                        $name .= ($name ? ' - ' : '') . 'Thứ bảy';
                    }
                }
                echo $name;
                ?>
            </td>
            <td class='text-center align-middle white-space-no-wrap'>
                <?php echo $item['start_time'] . '-' . $item['end_time'] ?>
            </td>
            <td class='text-center align-middle white-space-no-wrap'><?php echo $item['start_day'] ?></td>
            <td class='text-center align-middle'><?php echo $item['classroom']['name'] ?? '---' ?></td>
            <td class='text-center align-middle white-space-no-wrap'>
                <?php echo $item['subject']['name'] ?? '---' ?></td>
            <td class='text-center align-middle'><?php echo $item['lecturer']['full_name'] ?? '---' ?></td>
            <td class='text-center white-space-no-wrap'>
                <?php if(checkRoleMenu([0, 3])){ ?>
                    <a href='<?php echo route('schedules.edit', ['id' => $item['id']]) ?>'
                        class='btn btn-warning btn-circle'>
                        <i class='fas fa-edit'></i>
                    </a>
                    <form method='POST' style='display: none'
                        id='form-submit-delete-<?php echo $item['id'] ?>'
                        action='<?php echo route('schedules.destroy', ['id' => $item['id']]) ?>'>
                        <?php //echo @method('DELETE') ?>
                        <?php echo csrf_field() ?>
                        <button type='submit' id='submit-delete-form'>submit</button>
                    </form>
                    <button type='button' class='btn btn-danger btn-circle delete'
                        data-id='<?php echo $item['id'] ?>' data-target='#deleteModal' data-toggle='modal'>
                        <i class='fas fa-trash'></i>
                    </button>
                <?php } ?>
            </td>
        </tr>
        <?php
        }
        $content = ob_get_contents();    
        ob_end_clean();
        return $content;
    }
}
