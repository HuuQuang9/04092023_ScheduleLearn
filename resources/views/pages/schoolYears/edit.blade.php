@extends('layouts/main-layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/schoolYears">Niên khoá</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cập nhật niên khoá</li>
        </ol>
    </nav>
    <div class="form-content shadow">
        <h6 class="font-weight-bold text-primary">Cập nhật niên khoá</h6>
        <?php $item = $data; ?>
        <form class="needs-validation form-main" novalidate method="POST" action="{{ route('schoolYears.update', $item) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="required" for="fullname">Niên khoá</label>
                <input type="text" name="name" value="{{ $data['name'] }}" class="form-control" id="fullname"
                    placeholder="Nhập Niên khoá" required>
                <div class="ml-2 invalid-feedback">
                    Vui lòng nhập niên khoá!
                </div>
            </div>
            <div class="form-submit text-right">
                <a href="/schoolYears" class="btn btn-secondary">Huỷ</a>
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
