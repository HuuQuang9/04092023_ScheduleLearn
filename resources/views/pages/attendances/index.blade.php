@extends('layouts/main-layout')

@section('content')
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thống kê điểm danh</h6>
            <div class="d-flex w-100 report" style="justify-content: space-between;">
                @if(session()->get('user')['role'] != 2)
                <div class="mt-2 mr-3" style="width: 30%;">
                    <div class="form-group m-0">
                        <select name="classroom" class="form-control" id="classroom-report" required>
                            <option value="" disabled selected>Chọn lớp học...</option>
                            @foreach ($classrooms as $key => $value)
                                <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="mt-2" style="width: 30%;">
                    <div class="form-group m-0">
                        <select name="subject" class="form-control" id="subject-report" required>
                            <option value="" disabled selected>Chọn môn học...</option>
                            @foreach ($subjects as $key => $value)
                                <option value="{{ $value['id'] }}">{{$value['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="times" class="ml-3 mt-2" style="width: 40%; z-index: 100; text-align: right">
                    <a href="/attendances/add">Điểm danh</a>
                </div>
            </div>
            <div class="note-report">
                <div>Ghi chú: </div>
                <div class="green"><span></span>Thi lại lần 1</div>
                <div class="yellow"><span></span>Thi lại lần 2</div>
                <div class="dark"><span></span>Học lại</div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="content_table">
                <table class="table table-bordered" id="dataTableReport" width="100%" cellspacing="0"></table>
            </div>
        </div>
    </div>
@endsection
