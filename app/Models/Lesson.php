<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Lesson extends BaseModel
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
    ];

    protected $modelClass = Lesson::class;

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
            $email = session()->get('user')['email'];
            $user = Lecturer::where('email',$email)->first();
            $userId = $user->id ?? 0;
        }
        return $model::with('lecturer:id,full_name')
            ->with('schedule')
            ->with('substituteInstructor:id,full_name')
            ->where('delete', false)
            ->where(function ($query) use ($userId){
                $query->where('lecturer_id', $userId);
            })
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }

    function getItemsBySchedule($params)
    {
        $model = $this->modelClass;
        $scheduleIds = Schedule::where('delete', 0)->where('classroom_id', $params['classroom_id'])
            ->where('subject_id', $params['subject_id'])->get()->pluck('id')->toArray();

        $scheduleId = 0;

        $userId = 0;
        if (session()->get('user')['role'] == 1) {
            $email = session()->get('user')['email'];
            $user = Lecturer::where('email',$email)->first();
            $userId = $user->id ?? 0;
        }

        return $model::select('*')
            ->where('delete', false)
            ->whereIn('schedule_id', $scheduleIds)
            ->where(function ($query) {
                if(session()->get('user')['role'] == 0) {
                    $query->where('is_attendance', true);
                }
            })
            ->where(function ($query) use ($userId){
                if ($userId > 0) {
                    $query->where('lecturer_id', $userId)
                          ->orWhere('substitute_instructor', $userId);
                }
            })
            ->orderBy('date', 'ASC')
            ->get()->toArray();
    }

    function getReportItemsBySchedule($params){

        $subject_id = $params['subject_id'] ?? 0;
        $classroom_id = $params['classroom_id'] ?? 0;

        $schedule = Schedule::where('delete', 0)->where('classroom_id', $classroom_id)->where('subject_id', $subject_id)->first();
        $scheduleId = $schedule->id ?? 0;
        $lessons = Lesson::where('schedule_id', $scheduleId)
            ->with('attendances')
            ->get()
            ->toArray();

        $labels = ['H','M','N','P'];
        $datasets = [];
        foreach($labels as $label) {
            $numbers = [];
            foreach($lessons as $lesson) {
                $h = 0;
                $attendances = $lesson['attendances'];
                foreach($attendances as $attendance) {
                    if ($attendance['attendance'] == $label) {
                        $h += 1;
                    }
                }
                array_push($numbers, $h);
            }
            $arr = [
                'label' => $label,
                'data' => $numbers,
            ];
            array_push($datasets, $arr);
        }
        $data = [
            'labels' => array_column($lessons, 'name'),
            'datasets' => $datasets,
        ];

        return $data;
    }
    
    function getItemsByScheduleToHtml($scheduleId)
    {
        $model = $this->modelClass;

        $userId = 0;
        if (session()->get('user')['role'] == 1) {
            $email = session()->get('user')['email'];
            $user = Lecturer::where('email',$email)->first();
            $userId = $user->id ?? 0;
        }

        $data = $model::select('*')
            ->with('lecturer:id,full_name')
            ->with('schedule')
            ->with('substituteInstructor:id,full_name')
            ->where('delete', false)
            ->where('schedule_id', $scheduleId)
            ->where(function ($query) {
                if(session()->get('user')['role'] == 0) {
                    $query->where('is_attendance', true);
                }
            })
            ->where(function ($query) use ($userId){
                $query->where('lecturer_id', $userId);
            })
            ->orderBy('id', 'desc')
            ->get()->toArray();
        
        ob_start();
        foreach ($data as $key => $item){
        ?>
        <tr>
            <td class='text-center align-middle'><?php echo $key + 1 ?></td>
            <td class='text-center align-middle'><?php echo $item['name'] ?></td>
            <td class='text-center align-middle'>
                <?php
                    if ($item['is_attendance'] == 1){
                        $name = 'Đã điểm danh';
                    }else {
                        $name = 'Chưa điểm danh';
                    }
                    echo $name;
                ?>
            </td>
            <td class='text-center align-middle'><?php echo $item['start_time'] ?></td>
            <td class='text-center align-middle'><?php echo $item['end_time'] ?></td>
            <td class='text-center align-middle  white-space-no-wrap'><?php echo $item['date'] ?></td>
            <td class='text-center align-middle  white-space-no-wrap'>
                <?php echo $item['schedule'] ? $item['schedule']['location'] . ':' . $item['schedule']['start_time'] . '-' . $item['schedule']['end_time'] : '---' ?>
            </td>
            <td class='text-center align-middle'><?php echo $item['lecturer']['full_name'] ?? '---' ?></td>
            <td class='text-center align-middle'>
                <?php echo Carbon::parse($item['date_attendance'], 'x')->format('d/m/Y') ?>
            </td>
            <td class='text-center white-space-no-wrap'>
                <a href='<?php echo route('lessons.edit', ['id' => $item['id']]) ?>'
                    class='btn btn-warning btn-circle'>
                    <i class='fas fa-edit'></i>
                </a>
                <form method='POST' style='display: none' id='form-submit-delete-<?php echo $item['id'] ?>'
                    action='<?php echo route('lessons.destroy', ['id' => $item['id']]) ?>'>
                    <?php //@method('DELETE') ?>
                    <?php csrf_field() ?>
                    <button type='submit' id='submit-delete-form'>submit</button>
                </form>
                <?php if(checkRoleMenu([0, 3])) { ?>
                    <button type='button' class='btn btn-danger btn-circle delete'
                        data-target='#deleteModal' data-id='<?php echo $item['id'] ?>' data-toggle='modal'>
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
