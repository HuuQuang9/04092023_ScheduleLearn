@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('profile.edit', ['id' => session()->get('user')['id']]) }}">
                    Thông tin cá nhân
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Đổi mật khẩu</h6>
        @if ($notification = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $notification }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div id="notification-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form class="needs-validation form-main" novalidate method="POST"
            action="{{ route('auth.updatePass', ['id' => session()->get('user')['id']]) }}" enctype="multipart/form-data"
            oninput='password_r.setCustomValidity(password_r.value != password.value ? "Mật khẩu không khớp" : "")'>
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label class="required" for="password">Mật khẩu cũ</label>
                <input name="password_old" type="password" class="form-control" placeholder="Nhập mật khẩu cũ" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập mật khẩu!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="password">Mật khẩu mới</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Nhập mật khẩu mới"
                    required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập mật khẩu!
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="password_r">Nhập lại mật khẩu</label>
                <input name="password_r" type="password" class="form-control" id="password_r"
                    placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="form-submit text-right">
                <a href="{{ route('profile.edit', ['id' => session()->get('user')['id']]) }}"
                    class="btn btn-secondary">Huỷ</a>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        <script>
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
                    }, 5000); // 5000 milliseconds = 5 giây
                }, false);
            })();
        </script>
    </div>
@endsection
