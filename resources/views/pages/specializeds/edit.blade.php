@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/specializeds">Chuyên ngành</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật chuyên ngành</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Cập nhật chuyên ngành</h6>
        <form class="needs-validation form-main" novalidate method="POST" action="{{ route('specializeds.update', $data) }}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label class="required" for="specializeds">Chuyên ngành</label>
                <input name="name" value="{{$data['name']}}" type="text" class="form-control" id="specializeds" placeholder="Nhập chuyên ngành"
                    required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập chuyên ngành!
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/specializeds" class="btn btn-secondary">Huỷ</a>
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
