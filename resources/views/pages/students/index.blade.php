@extends('layouts/main-layout')

@section('content')
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Sinh viên</h6>
            <a href="/students/create" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Thêm sinh viên</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">MSSV</th>
                            <th class="text-center white-space-no-wrap">Họ & Tên</th>
                            <th class="text-center white-space-no-wrap">Giới Tính</th>
                            <th class="text-center">Email</th>
                            <th class="text-center white-space-no-wrap">Điện thoại</th>
                            <th class="text-center white-space-no-wrap">Ngày sinh</th>
                            <th class="text-center white-space-no-wrap">Lớp học</th>
                            <th class="text-center white-space-no-wrap">Hành động</th>
                        </tr>
                    </thead>
                    {{-- Space thead <-> tbody --}}
                    <tfoot></tfoot>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center align-middle">{{ $key + 1 }}</td>
                                <td class="align-middle">{{ $item['code'] }}</td>
                                <td class="align-middle white-space-no-wrap">{{ $item['full_name'] }}</td>
                                <td class="align-middle">{{ $item['gender'] == 1 ? 'Nam' : 'Nữ' }}</td>
                                <td class="align-middle">{{ $item['email'] }}</td>
                                <td class="align-middle">{{ $item['phone'] }}</td>
                                <td class="align-middle">
                                    {{ $item['dob'] && $item['dob'] != '0000-00-00' ? date_format(date_create($item['dob']), 'd/m/Y') : '---' }}
                                </td>
                                <td class="align-middle">{{ $item['classroom']['name'] ?? '---' }}</td>
                                <td class="text-center white-space-no-wrap">
                                    <a href="{{ route('students.edit', ['id' => $item['id']]) }}"
                                        class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" style="display: none" id="form-submit-delete-{{ $item['id'] }}"
                                        action="{{ route('students.destroy', ['id' => $item['id']]) }}">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <button type="submit" id="submit-delete-form">submit</button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-circle delete"
                                        data-id="{{ $item['id'] }}" data-target="#deleteModal" data-toggle="modal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
