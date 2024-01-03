@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/schedules">Lịch học</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật lịch học</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Cập nhật lịch học</h6>
        <form class="needs-validation form-main" novalidate method="POST"
            action="{{ route('schedules.update', ['id' => $data['id']]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label class="required" for="location">Phòng học</label>
                <input value="{{ $data['location'] }}" name="location" type="text" class="form-control" id="location"
                    placeholder="Nhập phòng học" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập phòng học!
                </div>
            </div>
            {{-- <div class="form-group">
                <label class="required" for="weekday">Ngày trong tuần</label>
                <select name="weekdays[]" class="form-control select-multiple selectpicker" id="weekdays" required multiple>
                    <option style="display: none" value="" disabled></option> 
                    <?php //$weekdays = explode(",",$data['weekday']); ?>
                    <option value="monday" {{ in_array('monday', $weekdays) ? 'selected' : '' }}>Thứ hai</option>
                    <option value="tuesday" {{ in_array('tuesday', $weekdays) ? 'selected' : '' }}>Thứ ba</option>
                    <option value="wednesday" {{ in_array('wednesday', $weekdays) ? 'selected' : '' }}>Thứ tư</option>
                    <option value="thursday" {{ in_array('thursday', $weekdays) ? 'selected' : '' }}>Thứ năm</option>
                    <option value="friday" {{ in_array('friday', $weekdays) ? 'selected' : '' }}>Thứ sáu</option>
                    <option value="saturday" {{ in_array('saturday', $weekdays) ? 'selected' : '' }}>Thứ bảy</option>
                    <option value="sunday" {{ in_array('sunday', $weekdays) ? 'selected' : '' }}>Chủ nhật</option>
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập ngày trong tuần!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">Thời gian bắt đầu</label>
                <input value="{{ $data['start_time'] }}" name="start_time" type="time" class="form-control"
                    id="start_time" placeholder="Nhập Thời gian bắt đầu" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập thời gian bắt đầu!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">Thời gian kết thúc</label>
                <input value="{{ $data['end_time'] }}" name="end_time" type="time" class="form-control" id="end_time"
                    placeholder="Nhập thời gian kết thúc" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập thời gian kết thúc!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="start_day">Ngày học</label>
                <input value="{{ $data['start_day'] }}" name="start_day" type="date" class="form-control" id="start_day"
                    placeholder="Nhập ngày học" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập ngày học!
                </div>
            </div> --}}
            <div class="form-group">
                <label class="required" for="classroom">Lớp học</label>
                <select name="classroom_id" class="form-control" id="classroom" required>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom['id'] }}"
                            {{ $classroom['id'] == $data['classroom_id'] ? 'selected' : '' }}>
                            {{ $classroom['name'] }}
                        </option>
                    @endforeach
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn lớp học!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="subject">Môn học</label>
                <select data-id="{{ $data['lecturer_id'] }}" name="subject_id" class="form-control" id="subject"
                    required>
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn môn học!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="lecturer">Giảng viên</label>
                <select data-id="{{ $data['lecturer_id'] }}" name="lecturer_id" class="form-control" id="lecturer"
                    required>
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn giảng viên!
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/schedules" class="btn btn-secondary">Huỷ</a>
                <button type="submit" class="btn btn-primary">Lưu</button>
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
