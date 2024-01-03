@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/users">Giáo vụ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật giáo vụ</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Cập nhật giáo vụ</h6>
        @if ($errors->any())
            <div id="notification-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form class="needs-validation form-main" novalidate method="POST"
            action="{{ route('users.update', ['id' => $data['id']]) }}" enctype="multipart/form-data"
            oninput='password_r.setCustomValidity(password_r.value != password.value ? "Mật khẩu không khớp" : "")'>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="required" for="fullname">Họ và tên</label>
                <input type="text" value="{{ $data['full_name'] }}" name="full_name" class="form-control" id="fullname"
                    placeholder="Nhập họ và tên" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập tên!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="email">Email</label>
                <input type="text" value="{{ $data['email'] }}" name="email" class="form-control" id="email"
                    placeholder="Nhập email" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập email!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="sex">Giới tính</label>
                <select class="form-control" name="gender" id="sex" required>
                    <option value="">Chọn giới tính</option>
                    <option value="1" {{ $data['gender'] == 1 ? 'selected' : '' }}>Nam</option>
                    <option value="2" {{ $data['gender'] == 2 ? 'selected' : '' }}>Nữ</option>
                </select>
                <div class="ml-2 invalid-feedback">
                    Vui lòng chọn giới tính!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="phone">Ngày sinh</label>
                <input type="date" value="{{ $data['dob'] }}" name="dob" class="form-control" id="phone"
                    placeholder="Ngày sinh" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập ngày sinh!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="phone">Điện thoại</label>
                <input type="text" value="{{ $data['phone'] }}" name="phone" class="form-control" id="phone"
                    placeholder="Nhập số điện thoại" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập số điện thoại!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="address">Địa chỉ</label>
                <input type="text" value="{{ $data['address'] }}" name="address" class="form-control" id="address"
                    placeholder="Nhập địa chỉ" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập địa chỉ!
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/users" class="btn btn-secondary">Huỷ</a>
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

                        setTimeout(function() {
                            $('.close').click();
                        }, 10000); // 10000 milliseconds = 10 giây
                    });
                }, false);
            })();
        </script>
    </div>
@endsection
