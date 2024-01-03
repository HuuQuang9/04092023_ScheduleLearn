@extends('layouts/login-layout')
@section('content')
    <div class="container" style="height: 100vh">
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="height: 100%">
            <div class="col-xl-8 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">
                                            Quản lý điểm danh
                                            <sup><i class="far fa-check-circle"></i></sup>
                                        </h1>
                                        <h1 class="h6 text-gray-500 mb-4">
                                            Chào mừng bạn quay lại!
                                        </h1>
                                    </div>
                                    @if ($errors->any())
                                        <div id="notification-alert" class="alert alert-danger alert-dismissible fade show"
                                            role="alert">
                                            {{ $errors->first('error') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form id="login-form" method="POST" class="user needs-validation" novalidate
                                        action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Tài khoản"
                                                required>
                                            <div class="ml-2 invalid-feedback">
                                                Vui lòng nhập email!
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Mật khẩu" required>
                                            <div class="ml-2 invalid-feedback">
                                                Vui lòng nhập mật khẩu!
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role"
                                                    {{ $errors->first('error') }} id="inlineRadio1" value="0" required
                                                    {{ $errors->first('role') == 0 || $errors->first('role') == 4 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio1">Quản trị viên - Giáo vụ</label>

                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role"
                                                    id="inlineRadio2" value="1" required
                                                    {{ $errors->first('role') == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio2">Giảng viên</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role"
                                                    id="inlineRadio3" value="2" required
                                                    {{ $errors->first('role') == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inlineRadio3">Sinh viên</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
