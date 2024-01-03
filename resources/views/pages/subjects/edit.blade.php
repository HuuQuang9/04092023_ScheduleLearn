@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/subjects">Môn học</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật môn học</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Cập nhật môn học</h6>
        <form class="needs-validation form-main" novalidate method="POST" action="{{ route('subjects.update', $data) }}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label class="required" for="code">Mã môn học</label>
                <input name="code" type="text" value="{{$data['code']}}" class="form-control" id="code" placeholder="Nhập mã môn học"
                    required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập mã môn học!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="name">Tên môn học</label>
                <input name="name" value="{{$data['name']}}" type="text" class="form-control" id="name" placeholder="Nhập tên môn học"
                    required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập tên môn học!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="hour">Thời gian học</label>
                <input name="hour" value="{{$data['hour']}}" type="text" class="form-control" id="hour" placeholder="Nhập thời gian học"
                    required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập thời gian học!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="specialized">Chuyên ngành</label>
                <select name="specialized_id" class="form-control" id="specialized" required>
                    <option value="">Chọn chuyên ngành...</option>
                    @foreach($specializeds as $specialized)
                        <option value="{{$specialized['id']}}" {{$data['specialized_id'] == $specialized['id'] ? 'selected' : ''}}>{{$specialized['name']}}</option>
                    @endforeach
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn Chuyên ngành!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="school_year">Niên khoá</label>
                <select class="form-control" name="school_year_id" id="school_year" required>
                    <option value="">Chọn niên khoá...</option>
                    @foreach($schoolYears as $schoolYear)
                        <option value="{{$schoolYear['id']}}" {{$data['school_year_id'] == $schoolYear['id'] ? 'selected' : ''}}>{{$schoolYear['name']}}</option>
                    @endforeach
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn niên khoá!
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/subjects" class="btn btn-secondary">Huỷ</a>
                <button type="submit" class="btn btn-primary">Lưu</button>
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
