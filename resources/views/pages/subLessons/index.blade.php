@extends('layouts/main-layout')

@section('content')
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1> --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center white-space-no-wrap">Tên</th>
                            <th class="text-center white-space-no-wrap">Thời gian</th>
                            <th class="text-center white-space-no-wrap">Ngày học</th>
                            <th class="text-center white-space-no-wrap">Lịch học</th>
                            <th class="text-center white-space-no-wrap">Giảng viên</th>
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
                                <td class="text-center align-middle">{{ $item['start_time'] }} - {{ $item['end_time'] }}</td>
                                <td class="text-center align-middle  white-space-no-wrap">{{ $item['date'] }}</td>
                                <td class="text-center align-middle  white-space-no-wrap">
                                    {{ $item['schedule'] ? $item['schedule']['location'] . ':' . $item['schedule']['start_time'] . '-' . $item['schedule']['end_time'] : '---' }}
                                </td>
                                <td class="text-center align-middle">{{ $item['lecturer']['full_name'] ?? '---' }}</td>
                                <td class="text-center white-space-no-wrap">
                                    @if($item['approved'])
                                        <button  class="btn btn-success btn-circle"><i class="fas fa-check-circle"></i></button>
                                    @else
                                        <form method="POST" style="display: none" id="form-submit-delete-{{ $item['id'] }}"
                                            action="{{ route('subLessons.update', ['id' => $item['id']]) }}">
                                            @method('PUT')
                                            {{ csrf_field() }}
                                            <input type="text" name="approved" value="1">
                                            <button type="submit" id="submit-delete-form">submit</button>
                                        </form>
                                        @if (checkRoleMenu([1]))
                                            <button type="button" class="btn btn-secondary btn-circle delete"
                                                data-target="#approvedModal" data-id="{{ $item['id'] }}" data-toggle="modal">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        @endif
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
