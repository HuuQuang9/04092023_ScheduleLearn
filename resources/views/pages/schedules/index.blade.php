@extends('layouts/main-layout')

@section('content')
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary align-self-center mr-3">Lịch học</h6>
                @if(checkRoleMenu([0,1,3]))
                <div class="form-group m-0">
                    <select name="classroom" class="form-control" id="schedule-classroom" required style="width: 200px;">
                        <option value="" disabled selected>Chọn lớp học...</option>
                        @foreach ($classrooms as $key => $value)
                            <option value="{{ $value['id'] }}">{{$value['name']}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Vui lòng chọn lớp học
                    </div>
                </div>
                @endif
            </div>
            @if (checkRoleMenu([0, 3]))
                <a href="/schedules/create" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Thêm Lịch học</span>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center white-space-no-wrap">Phòng học</th>
                            <th class="text-center white-space-no-wrap">Ngày trong tuần</th>
                            <th class="text-center white-space-no-wrap">Thời gian</th>
                            <th class="text-center white-space-no-wrap">Ngày bắt đầu</th>
                            <th class="text-center white-space-no-wrap">Lớp học</th>
                            <th class="text-center white-space-no-wrap">Môn học</th>
                            <th class="text-center white-space-no-wrap">Giảng viên</th>
                            @if(checkRoleMenu([0,3]))
                            <th class="text-center white-space-no-wrap">Hành động</th>
                            @endif
                        </tr>
                    </thead>
                    {{-- Space thead <-> tbody --}}
                    <tfoot></tfoot>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $key + 1 }}</td>
                                <td class="text-center align-middle">{{ $item['location'] }}</td>
                                <td class="text-center align-middle">
                                    <?php
                                    $weekdays = explode(",",$item['weekday']);
                                    $name = null;
                                    foreach($weekdays as $weekday) {
                                        if ($weekday == 'Sunday') {
                                            $name .= ($name ? ' - ' : '') . 'Chủ nhật';
                                        } else if ($weekday == 'Monday') {
                                            $name .= ($name ? ' - ' : '') . 'Thứ hai';
                                        } else if ($weekday == 'Tuesday') {
                                            $name .= ($name ? ' - ' : '') . 'Thứ ba';
                                        } else if ($weekday == 'Wednesday') {
                                            $name .= ($name ? ' - ' : '') . 'Thứ tư';
                                        } else if ($weekday == 'Thursday') {
                                            $name .= ($name ? ' - ' : '') . 'Thứ năm';
                                        } else if ($weekday == 'Friday') {
                                            $name .= ($name ? ' - ' : '') . 'Thứ sáu';
                                        } else if ($weekday == 'Saturday') {
                                            $name .= ($name ? ' - ' : '') . 'Thứ bảy';
                                        }
                                    }
                                    echo $name;
                                    ?>
                                </td>
                                <td class="text-center align-middle white-space-no-wrap">
                                    {{ $item['start_time'] . '-' . $item['end_time'] }}
                                </td>
                                <td class="text-center align-middle white-space-no-wrap">{{ $item['start_day'] }}</td>
                                <td class="text-center align-middle">{{ $item['classroom']['name'] ?? '---' }}</td>
                                <td class="text-center align-middle white-space-no-wrap">
                                    {{ $item['subject']['name'] ?? '---' }}</td>
                                <td class="text-center align-middle">{{ $item['lecturer']['full_name'] ?? '---' }}</td>
                                @if (checkRoleMenu([0, 3]))
                                <td class="text-center white-space-no-wrap">

                                        <a href="{{ route('schedules.edit', ['id' => $item['id']]) }}"
                                            class="btn btn-warning btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" style="display: none"
                                            id="form-submit-delete-{{ $item['id'] }}"
                                            action="{{ route('schedules.destroy', ['id' => $item['id']]) }}">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <button type="submit" id="submit-delete-form">submit</button>
                                        </form>
                                        <button type="button" class="btn btn-danger btn-circle delete"
                                            data-id="{{ $item['id'] }}" data-target="#deleteModal" data-toggle="modal">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
