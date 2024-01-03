<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SubLessonController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\SpecializedController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'submitLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['isLogin']], function () {

    /**
     * Trang dashboard
     */
    Route::get('/', [HomeController::class, 'view'])->name('home');

    /**
     * Thay đổi mật khẩu
     */
    Route::prefix('auth')->group(function () {
        // Password
        Route::get('/{id}/password', [AuthController::class, 'editPass'])->name('auth.editPass');
        Route::put('/{id}/password', [AuthController::class, 'updatePass'])->name('auth.updatePass');
        // Profile
        Route::get('/{id}/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
        Route::put('/{id}/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    });

    /**
     * Cập nhật tài khoản
     */
    Route::prefix('users')->group(function () {
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/create', [UserController::class, 'store'])->name('users.store');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/{id}/edit', [UserController::class, 'update'])->name('users.update');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });

    /**
     * Chuyên ngành
     */
    Route::prefix('specializeds')->group(function () {
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/', [SpecializedController::class, 'index'])->name('specializeds.index');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/create', [SpecializedController::class, 'create'])->name('specializeds.create');
            Route::post('/create', [SpecializedController::class, 'store'])->name('specializeds.store');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/{id}/edit', [SpecializedController::class, 'edit'])->name('specializeds.edit');
            Route::put('/{id}/edit', [SpecializedController::class, 'update'])->name('specializeds.update');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::delete('/{id}', [SpecializedController::class, 'destroy'])->name('specializeds.destroy');
        });
    });

    /**
     * Năm học
     */
    Route::prefix('schoolYears')->group(function () {
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/', [SchoolYearController::class, 'index'])->name('schoolYears.index');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/create', [SchoolYearController::class, 'create'])->name('schoolYears.create');
            Route::post('/create', [SchoolYearController::class, 'store'])->name('schoolYears.store');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/{id}/edit', [SchoolYearController::class, 'edit'])->name('schoolYears.edit');
            Route::put('/{id}/edit', [SchoolYearController::class, 'update'])->name('schoolYears.update');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::delete('/{id}', [SchoolYearController::class, 'destroy'])->name('schoolYears.destroy');
        });
    });

    /**
     * Lớp học
     */
    Route::prefix('classrooms')->group(function () {
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/', [ClassroomController::class, 'index'])->name('classrooms.index');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/create', [ClassroomController::class, 'create'])->name('classrooms.create');
            Route::post('/create', [ClassroomController::class, 'store'])->name('classrooms.store');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/{id}/edit', [ClassroomController::class, 'edit'])->name('classrooms.edit');
            Route::put('/{id}/edit', [ClassroomController::class, 'update'])->name('classrooms.update');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::delete('/{id}', [ClassroomController::class, 'destroy'])->name('classrooms.destroy');
        });
    });

    /**
     * Học viên
     */
    Route::prefix('students')->group(function () {
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/', [StudentController::class, 'index'])->name('students.index');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/create', [StudentController::class, 'create'])->name('students.create');
            Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::post('/create', [StudentController::class, 'store'])->name('students.store');
            Route::put('/{id}/edit', [StudentController::class, 'update'])->name('students.update');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
        });
    });

    /**
     * Giảng viên
     */
    Route::prefix('lecturers')->group(function () {
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/', [LecturerController::class, 'index'])->name('lecturers.index');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/create', [LecturerController::class, 'create'])->name('lecturers.create');
            Route::post('/create', [LecturerController::class, 'store'])->name('lecturers.store');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::get('/{id}/edit', [LecturerController::class, 'edit'])->name('lecturers.edit');
            Route::put('/{id}/edit', [LecturerController::class, 'update'])->name('lecturers.update');
        });
        Route::group(['middleware' => ['isRole:0']], function () {
            Route::delete('/{id}', [LecturerController::class, 'destroy'])->name('lecturers.destroy');
        });
    });

    /**
     * Thời khoá biểu
     */
    Route::prefix('schedules')->group(function () {
        Route::group([], function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('schedules.index');
        });
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::get('/create', [ScheduleController::class, 'create'])->name('schedules.create');
            Route::post('/create', [ScheduleController::class, 'store'])->name('schedules.store');
        });
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::get('/{id}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
            Route::put('/{id}/edit', [ScheduleController::class, 'update'])->name('schedules.update');
        });
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::delete('/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
        });
    });

    /**
     * Môn học
     */
    Route::prefix('subjects')->group(function () {
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::get('/', [SubjectController::class, 'index'])->name('subjects.index');
        });
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::get('/create', [SubjectController::class, 'create'])->name('subjects.create');
            Route::post('/create', [SubjectController::class, 'store'])->name('subjects.store');
        });
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::get('/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
            Route::put('/{id}/edit', [SubjectController::class, 'update'])->name('subjects.update');
        });
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
        });
    });

    /**
     * Buổi học
     */
    Route::prefix('lessons')->group(function () {
        Route::group(['middleware' => ['isRole:0|1|3']], function () {
            Route::get('/', [LessonController::class, 'index'])->name('lessons.index');
        });
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::get('/create', [LessonController::class, 'create'])->name('lessons.create');
            Route::post('/create', [LessonController::class, 'store'])->name('lessons.store');
        });
        Route::group(['middleware' => ['isRole:0|1|3']], function () {
            Route::get('/{id}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
            Route::put('/{id}/edit', [LessonController::class, 'update'])->name('lessons.update');
        });
        Route::group(['middleware' => ['isRole:0|3']], function () {
            Route::delete('/{id}', [LessonController::class, 'destroy'])->name('lessons.destroy');
        });
    });
    
    /**
     * Dạy thay Buổi học
     */
    Route::prefix('subLessons')->group(function () {
        Route::group(['middleware' => ['isRole:0|1|3']], function () {
            Route::get('/', [SubLessonController::class, 'index'])->name('subLessons.index');
        });
        Route::group(['middleware' => ['isRole:0|1|3']], function () {
            Route::put('/{id}/edit', [SubLessonController::class, 'update'])->name('subLessons.update');
        });
    });

    /**
     * Điểm danh
     */
    Route::prefix('attendances')->group(function () {

        Route::middleware('isRole:1|3|2')->get('/', [AttendanceController::class, 'index'])->name('attendances.index');
        Route::middleware('isRole:1|3|2')->get('/add', [AttendanceController::class, 'add'])->name('attendances.add');

        Route::group(['middleware' => ['isRole:0|1']], function () {
            Route::get('/create', [AttendanceController::class, 'create'])->name('attendances.create');
            Route::post('/create', [AttendanceController::class, 'store'])->name('attendances.store');
        });

        Route::group(['middleware' => ['isRole:0']], function () {
            Route::middleware('isRole:0')->get('/{id}/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
            Route::middleware('isRole:0')->put('/{id}/edit', [AttendanceController::class, 'update'])->name('attendances.update');
        });

        Route::group(['middleware' => ['isRole:0']], function () {
            Route::delete('/{id}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
        });
    });
});

$router->group(['prefix' => 'api'], function () use ($router) {

    /**
     * Kiểm tra API core đã hoạt đông hay chưa?
     */
    $router->get('test', function () {
        return 'completed!!!';
    });

    /**
     * Môn học
     */
    Route::prefix('subjects')->group(function () use ($router) {
        /**
         * Lấy danh sách môn học theo lớp học
         */
        $router->get('getItemsByClassroom/{classroomId}', [SubjectController::class, 'getItemsByClassroom'])->where('classroomId', '[0-9]+');;
    });

    /**
     * Giảng viên
     */
    Route::prefix('lecturers')->group(function () {
        /**
         * Lấy danh sách giảng viên theo lớp học
         */
        Route::get('getItemsByClassroom/{classroomId}', [LecturerController::class, 'getItemsByClassroom']);
    });

    /**
     * Học viên
     */
    Route::prefix('students')->group(function () {
        /**
         * Lấy danh sách học viên theo lịch học
         */
        Route::post('getItemsBySchedule/{scheduleId}', [StudentController::class, 'getItemsBySchedule']);
    });

    /**
     * Bài học
     */
    Route::prefix('lessons')->group(function () {
        /**
         * Lấy danh sách bài học theo lịch học
         */
        Route::post('getItemsBySchedule', [LessonController::class, 'getItemsBySchedule']);
        
        /**
         * Lấy danh sách bài học theo lịch học
         */
        Route::post('getReportItemsBySchedule', [LessonController::class, 'getReportItemsBySchedule']);

        /**
         * Lấy danh sách bài học theo lịch học
         */
        Route::get('getItemsByScheduleToHtml/{scheduleId}', [LessonController::class, 'getItemsByScheduleToHtml']);
    });

    /**
     * Lịch học
     */
    Route::prefix('schedules')->group(function () {
        /**
         * Lấy danh sách lịch học theo lớp học
         */
        Route::get('getItemsByClassroomToHtml/{classroomId}', [ScheduleController::class, 'getItemsByClassroomToHtml']);

        Route::get('getItemsByClassroom/{classroomId}', [ScheduleController::class, 'getItemsByClassroom']);
    });

    /**
     * Điểm danh
     */
    Route::prefix('attendances')->group(function () use ($router) {
        /**
         * Điểm danh học viên theo buổi học
         */
        Route::post('/', [AttendanceController::class, 'attendanceMulti']);

        /**
         * Lấy thống kê điểm danh
         */
        Route::post('/report', [AttendanceController::class, 'reportAttendance']);
    });
});
