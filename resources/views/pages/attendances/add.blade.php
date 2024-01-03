@extends('layouts/main-layout')

@section('content')
    <!-- Page Heading -->
    <div class="card shadow mb-4" action="#" method="#" style="">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Điểm danh</h6>
            <div class="d-flex attendance attendance-add">
                <div class="mt-2 mr-3" style="width: 30%;">
                    <div class="form-group m-0 ">
                        <select name="classroom" class="form-control" id="classroom-report" required>
                            <option value="" disabled selected>Chọn lớp học...</option>
                            @foreach ($classrooms as $key => $value)
                                <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2 mr-3" style="width: 30%;">
                    <div class="form-group m-0 ">
                        <select name="subject" class="form-control" id="subject-report" required>
                            <option value="" disabled selected>Chọn môn học...</option>
                            @foreach ($subjects as $key => $value)
                                <option value="{{ $value['id'] }}">{{$value['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-2 ml-3" style="width: 30%;">
                    <div class="form-group m-0">
                        <input type="date" id="lesson_date" name="trip-start" value="{{date("Y-m-d")}}" class="form-control"/>
                    </div>
                </div>
                <div id="times" class="ml-3 mt-2" style="display: none; gap: 20px; z-index: 100">
                    <input name="start_time" type="time" class="form-control" id="start_time"
                    placeholder="Nhập Thời gian bắt đầu" required>
                    <input name="end_time" type="time" class="form-control" id="end_time"
                    placeholder="Nhập Thời gian bắt đầu" required>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="text-center">
                <h6 class="h4" id="notification_table">Xin vui lòng chọn lịch dạy của bạn!</h6>
            </div>
            <div class="table-responsive" id="content_table" style="display: none">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center white-space-no-wrap">Mã sinh viên</th>
                            <th class="text-center white-space-no-wrap">Tên sinh viên</th>
                            <th class="text-center white-space-no-wrap" style="width: 400px;">Điểm danh</th>
                            <th class="text-center white-space-no-wrap">Ghi chú</th>
                        </tr>
                    </thead>
                    {{-- Space thead <-> tbody --}}
                    <tfoot></tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="form-btn text-right  mt-4" id="btn-save" style="display: none">
                {{-- <p style="display: inline-block;" class="mr-3">Ngày học: 12/2/2023 - Thời gian: 14:30 - 16h20</p> --}}
                <button id="submitAttendance" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Lưu</span>
                </button>
            </div>
        </div>
    </div>

    <div style="position: fixed; top: 8px; right: 0px;">
        <!-- Then put toasts within -->
        <div class="toast border-left-success shadow" style="display: none" role="alert" aria-live="assertive" aria-atomic="true"
            style="min-width: 300px" id="toast-success">
            <div class="toast-header">
                <img style="width: 20px; height: 20px;" src="/img/icon.png" class="rounded mr-2" alt="...">
                <strong class="mr-auto">Thành công</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Điểm danh thành công!
            </div>
        </div>

        <!-- Then put toasts within -->
        <div class="toast border-left-danger shadow" style="display: none" role="alert" aria-live="assertive" aria-atomic="true"
            style="min-width: 300px" id="toast-error">
            <div class="toast-header">
                <i style="color: red" class="fas fa-exclamation-triangle mr-2"></i>
                <strong class="mr-auto">Thất bại</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Điểm danh không thành công!
            </div>
        </div>
    </div>
@endsection
