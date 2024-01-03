@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/lecturers">Giảng viên</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật giảng viên</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Cập nhật giảng viên</h6>
        @if ($errors->any())
            <div id="notification-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form class="needs-validation form-main" novalidate method="POST"
            action="{{ route('lecturers.update', ['id' => $data['id']]) }}" enctype="multipart/form-data"
            oninput='password_r.setCustomValidity(password_r.value != password.value ? "Mật khẩu không khớp" : "")'>
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label class="required" for="fullname">Họ và tên</label>
                <input value="{{ $data['full_name'] }}" name="full_name" type="text" class="form-control" id="fullname"
                    placeholder="Nhập họ và tên" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập tên!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="email">Email</label>
                <input value="{{ $data['email'] }}" name="email" type="text" class="form-control" id="email"
                    placeholder="Nhập email" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập email!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="sex">Giới tính</label>
                <select name="gender" class="form-control" id="sex" required>
                    <option value="">Giới tính...</option>
                    <option value="1" {{ $data['gender'] == 1 ? 'selected' : '' }}>Nam</option>
                    <option value="2" {{ $data['gender'] == 2 ? 'selected' : '' }}>Nữ</option>
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn giới tính!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="phone">Ngày sinh</label>
                <input value="{{ $data['dob'] }}" name="dob" type="date" class="form-control" id="phone"
                    placeholder="Nhập số điện thoại" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập ngày sinh!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="phone">Điện thoại</label>
                <input value="{{ $data['phone'] }}" name="phone" type="text" class="form-control" id="phone"
                    placeholder="Nhập số điện thoại" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập số điện thoại!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="address">Địa chỉ</label>
                <input value="{{ $data['address'] }}" name="address" type="text" class="form-control" id="address"
                    placeholder="Nhập địa chỉ" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập địa chỉ!
                </div>
            </div>

            {{-- <div class="form-group">
                <label class="required" for="password">Mật khẩu</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập mật khẩu!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="password_r">Nhập lại mật khẩu</label>
                <input name="password_r" type="password" class="form-control" id="password_r" placeholder="Password"
                    required>
            </div> --}}
            <div class="form-group">
                <label class="required" for="class">Chuyên ngành</label>
                <select name="specialized_id" class="form-control" id="class" required>
                    <option value="">Chọn chuyên ngành...</option>
                    @foreach ($specializeds as $specialized)
                        <option value="{{ $specialized['id'] }}"
                            {{ $specialized['id'] == $data['specialized_id'] ? 'selected' : '' }}>
                            {{ $specialized['name'] }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Vui lòng chọn chuyên ngành
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/lecturers" class="btn btn-secondary">Huỷ</a>
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

                    setTimeout(function() {
                        $('.close').click();
                    }, 10000); // 10000 milliseconds = 10 giây
                }, false);
            })();
        </script>
    </div>
@endsection
