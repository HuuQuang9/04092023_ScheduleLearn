@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/schedules">Lịch học</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thêm lịch học</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Thêm lịch học</h6>
        <form class="needs-validation form-main" novalidate method="POST" action="{{ route('schedules.create') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="required" for="location">Phòng học</label>
                <input name="location" type="text" class="form-control" id="location" placeholder="Nhập phòng học"
                    required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập phòng học!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="weekdays">Ngày trong tuần</label>
                <select name="weekdays[]" class="form-control select-multiple selectpicker" id="weekdays" required multiple>
                    <option style="display: none" value="" disabled></option> {{-- Validate --}}
                    <option value="Monday">Thứ hai</option>
                    <option value="Tuesday">Thứ ba</option>
                    <option value="Wednesday">Thứ tư</option>
                    <option value="Thursday">Thứ năm</option>
                    <option value="Friday">Thứ sáu</option>
                    <option value="Saturday">Thứ bảy</option>
                    <option value="Sunday">Chủ nhật</option>
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập ngày trong tuần!
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
                <label class="required" for="start_day">Ngày bắt đầu</label>
                <input name="start_day" type="date" class="form-control" id="start_day" placeholder="Nhập ngày bắt đầu"
                    required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập ngày bắt đầu!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="classroom">Lớp học</label>
                <select name="classroom_id" class="form-control" id="classroom" required>
                    <option selected value="" disabled>Chọn lớp...</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom['id'] }}">{{ $classroom['name'] }}</option>
                    @endforeach
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn lớp học!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="subject">Môn học</label>
                <select name="subject_id" class="form-control" id="subject" required>
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn môn học!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="lecturer">Giảng viên</label>
                <select name="lecturer_id" class="form-control" id="lecturer" required>
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn giảng viên!
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/schedules" class="btn btn-secondary">Huỷ</a>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
            {{ csrf_field() }}
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
