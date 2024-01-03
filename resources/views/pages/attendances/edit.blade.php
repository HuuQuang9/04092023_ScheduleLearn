@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/attendances">Niên khoá</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật điểm danh</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Cập nhật điểm danh</h6>
        <form class="needs-validation form-main" novalidate method="POST"
            action="{{ route('attendances.update', ['id' => $data['id']]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label class="required" for="fullname">Có mặt</label>
                <input value="{{ $data['attendance'] }}" name="attendance" type="text" class="form-control"
                    id="fullname" placeholder="ví dụ: D, N, M, P" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập có mặt!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="student_id">Sinh viên</label>
                <select name="student_id" class="form-control" id="student_id" required>
                    <option value="">Chọn sinh viên...</option>
                    @foreach ($students as $student)
                        <option value="{{ $student['id'] }}" {{ $student['id'] == $data['student_id'] ? 'selected' : '' }}>
                            {{ $student['full_name'] }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Vui lòng chọn sinh viên
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_id">Buổi học</label>
                <select name="lesson_id" class="form-control" id="lesson_id" required>
                    <option value="">Chọn buổi học...</option>
                    @foreach ($lessons as $lesson)
                        <option value="{{ $lesson['id'] }}" {{ $lesson['id'] == $data['lesson_id'] ? 'selected' : '' }}>
                            {{ $lesson['name'] }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Vui lòng chọn buổi học
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/attendances" class="btn btn-secondary">Huỷ</a>
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
