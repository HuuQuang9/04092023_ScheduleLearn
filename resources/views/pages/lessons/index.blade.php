@extends('layouts/main-layout')

@section('content')
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary align-self-center mr-3">Buổi học</h6>
                <div class="form-group m-0">
                    <select name="schedule" class="form-control" id="lesson-schedule" required>
                        <option value="" disabled selected>Chọn lịch dạy...</option>
                        @foreach ($schedules as $key => $value)
                            <option value="{{ $value['id'] }}">{{$value['location']}}: {{ $value['classroom']['name'] }} -
                                {{ $value['subject']['name'] }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Vui lòng chọn lịch dạy
                    </div>
                </div>
            </div>
            @if (checkRoleMenu([0, 3]))
                <a href="/lessons/create" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Thêm Buổi học</span>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center white-space-no-wrap">Tên</th>
                            <th class="text-center white-space-no-wrap">Trạng thái điểm danh</th>
                            <th class="text-center white-space-no-wrap">Thời gian bắt đầu</th>
                            <th class="text-center white-space-no-wrap">Thời gian kết thúc</th>
                            <th class="text-center white-space-no-wrap">Ngày học</th>
                            <th class="text-center white-space-no-wrap">Lịch học</th>
                            <th class="text-center white-space-no-wrap">Giảng viên</th>
                            <th class="text-center white-space-no-wrap">Ngày điểm danh</th>
                            <th class="text-center white-space-no-wrap">Hành động</th>
                        </tr>
                    </thead>
                    {{-- Space thead <-> tbody --}}
                    <tfoot></tfoot>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $key + 1 }}</td>
                                <td class="text-center align-middle">{{ $item['name'] }}</td>
                                <td class="text-center align-middle">
                                    <?php
                                        if ($item['is_attendance'] == 1){
                                            $name = "Đã điểm danh";
                                        }else {
                                            $name = "Chưa điểm danh";
                                        }
                                        echo $name;
                                        ?>
                                </td>
                                <td class="text-center align-middle">{{ $item['start_time'] }}</td>
                                <td class="text-center align-middle">{{ $item['end_time'] }}</td>
                                <td class="text-center align-middle  white-space-no-wrap">{{ $item['date'] }}</td>
                                <td class="text-center align-middle  white-space-no-wrap">
                                    {{ $item['schedule'] ? $item['schedule']['location'] . ':' . $item['schedule']['start_time'] . '-' . $item['schedule']['end_time'] : '---' }}
                                </td>
                                <td class="text-center align-middle">{{ $item['lecturer']['full_name'] ?? '---' }}</td>
                                <td class="text-center align-middle">
                                    {{ Carbon\Carbon::parse($item['date_attendance'], 'x')->format('d/m/Y') }}
                                </td>
                                <td class="text-center white-space-no-wrap">
                                    <a href="{{ route('lessons.edit', ['id' => $item['id']]) }}"
                                        class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" style="display: none" id="form-submit-delete-{{ $item['id'] }}"
                                        action="{{ route('lessons.destroy', ['id' => $item['id']]) }}">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <button type="submit" id="submit-delete-form">submit</button>
                                    </form>
                                    @if (checkRoleMenu([0, 3]))
                                        <button type="button" class="btn btn-danger btn-circle delete"
                                            data-target="#deleteModal" data-id="{{ $item['id'] }}" data-toggle="modal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
