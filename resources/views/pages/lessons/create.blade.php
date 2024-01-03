@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/lessons">Buổi học</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm buổi học</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Thêm buổi học</h6>
        <form class="needs-validation form-main" novalidate novalidate method="POST" action="{{ route('lessons.create') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="required" for="name">Tên</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nhập Tên" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập Tên!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">Thời gian bắt đầu</label>
                <input name="start_time" type="time" class="form-control" id="start_time"
                    placeholder="Nhập Thời gian bắt đầu" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập thời gian bắt đầu!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">Thời gian kết thúc</label>
                <input name="end_time" type="time" class="form-control" id="end_time"
                    placeholder="Nhập thời gian kết thúc" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập thời gian kết thúc!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="date">Ngày học</label>
                <input name="date" type="date" class="form-control" id="date" placeholder="Nhập ngày bắt đầu"
                    required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập ngày bắt đầu!
                </div>
            </div>
            <div class="form-group">
                <label for="substitute_instructor">Người hướng dẫn thay thế</label>
                <select name="substitute_instructor" class="form-control" id="lecturer">
                    <option value="">Chọn người hướng dẫn thay thế...</option>
                    @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer['id'] }}">
                            {{ $lecturer['full_name'] }}
                        </option>
                    @endforeach
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập người hướng dẫn thay thế!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="schedule">Thời khoá biểu</label>
                <select name="schedule_id" class="form-control" id="schedule" required>
                    <option value="">Chọn Thời khoá biểu...</option>
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule['id'] }}">
                            {{ $schedule['location'] . ' :' . $schedule['start_time'] . ' - ' . $schedule['end_time'] }}
                        </option>
                    @endforeach
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn Thời khoá biểu!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="lecturer">Giảng viên</label>
                <select name="lecturer_id" class="form-control" id="lecturer" required>
                    <option value="">Chọn giảng viên...</option>
                    @foreach ($lecturers as $lecturer)
                        <option value="{{ $lecturer['id'] }}">
                            {{ $lecturer['full_name'] }}
                        </option>
                    @endforeach
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn giảng viên!
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/lessons" class="btn btn-secondary">Huỷ</a>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>
    </div>
@endsection
