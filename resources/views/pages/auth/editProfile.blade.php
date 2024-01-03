@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
        </ol>
    </nav>
    <div class="form-content">
        <div class="row mb-2">
            <div class="col-sm-10">
                <h6 class="font-weight-bold text-primary">Thông tin cá nhân</h6>
            </div>
        </div>
        @if ($errors->any())
            <div id="notification-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($notification = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $notification }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @php
            $userImage = session()->get('user')['image'] ?? null;
        @endphp
        <form class="needs-validation form-main" novalidate method="POST"
            action="{{ route('profile.update', ['id' => $data['id']]) }}" enctype="multipart/form-data"
            oninput='password_r.setCustomValidity(password_r.value != password.value ? "Mật khẩu không khớp" : "")'>
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-sm-3"><!--left col-->
                    <div class="text-center">
                        @if (!empty($userImage))
                            <img style="width: 140px; height: 140px;" class="rounded-circle avatar img-circle img-thumbnail"
                                alt="avatar" src="{{ asset('/img/' . $userImage) }}">
                        @else
                            <img style="width: 140px; height: 140px;" style="object-fit: cover"
                                src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                class="rounded-circle avatar img-circle img-thumbnail" alt="avatar">
                        @endif

                        <h6 class="mt-2">{{ $data['full_name'] }}</h6>
                        <input name="image" id="file" type="file"
                            class="d-none text-center center-block file-upload">
                        <label for="file" class="btn btn-success btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text  white-space-no-wrap">Cập nhật</span>
                        </label>
                    </div>
                </div><!--/col-3-->
                <div class="col-sm-9">
                    <div class="form-group">
                        <label class="required" for="fullname">Họ và tên</label>
                        <input value="{{ $data['full_name'] }}" name="full_name" type="text" class="form-control"
                            id="fullname" placeholder="Nhập họ và tên" required>
                        <div class="ml-2 invalid-feedback">
                            Vui lòng nhập tên!
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required" for="email">Email</label>
                        <input value="{{ $data['email'] }}" name="email" type="text" class="form-control"
                            id="email" placeholder="Nhập email" required>
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
                        <input value="{{ $data['dob'] }}" name="dob" type="date" class="form-control"
                            id="phone" placeholder="Nhập số điện thoại" required>
                        <div class="ml-2 invalid-feedback">
                            Vui lòng nhập ngày sinh!
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required" for="phone">Điện thoại</label>
                        <input value="{{ $data['phone'] }}" name="phone" type="text" class="form-control"
                            id="phone" placeholder="Nhập số điện thoại" required>
                        <div class="ml-2 invalid-feedback">
                            Vui lòng nhập số điện thoại!
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required" for="address">Địa chỉ</label>
                        <input value="{{ $data['address'] }}" name="address" type="text" class="form-control"
                            id="address" placeholder="Nhập địa chỉ" required>
                        <div class="ml-2 invalid-feedback">
                            Vui lòng nhập địa chỉ!
                        </div>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('auth.editPass', ['id' => session()->get('user')['id']]) }}"
                            class="btn btn-secondary">
                            Đổi mật khẩu
                        </a>
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
                    }, 5000); // 5000 milliseconds = 5 giây

                    var readURL = function(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('.avatar').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $(".file-upload").on('change', function() {
                        readURL(this);
                    });
                }, false);
            })();
        </script>
    </div>

    </div><!--/col-9-->
    </div>
@endsection
