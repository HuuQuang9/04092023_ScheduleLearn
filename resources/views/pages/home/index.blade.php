 @extends('layouts/main-layout')

 @section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
     </div>

     <!-- Content Row -->
     <div class="row">

         <!-- Earnings (Monthly) Card Example -->
         @if (checkRoleMenu([3]))
         <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-primary shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                 Sinh viên</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($student) }}</div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         @endif

         <!-- Earnings (Monthly) Card Example -->
         @if (checkRoleMenu([3]))
         <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-success shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                 Giảng viên</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($lecturer) }}</div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         @endif

         <!-- Earnings (Monthly) Card Example -->
         @if (checkRoleMenu([3]))
         <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-info shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                 Môn học</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($subject) }}</div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-book fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         @endif

         @if (checkRoleMenu([1,2,3]))
         <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-warning shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                 Lịch học</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($schedule) }}</div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         @endif
     </div>

     <div class="row " style="justify-content: space-between">
        <div style="text-align: center; margin-top: 38px;" class="col-4">
            <div><canvas id="myChart" class="canvas"></canvas></div>
            <p>Tỉ lệ điểm danh</p>
        </div>
        <div class="col-6">
            <div class="d-flex" style="gap: 20px">
                <div class="form-group m-0 w-50">
                    <select name="classroom_id" class="form-control" id="classroom" required>
                        <option selected value="" disabled>Chọn lớp...</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom['id'] }}">{{ $classroom['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group m-0 report w-50">
                    <select name="subject_id" class="form-control" id="subject" required>
                        <option selected value="" disabled>Chọn môn học...</option>
                    </select>
                </div>
                <select style="display: none;" name="lecturer_id" class="form-control" id="lecturer" required>
                </select>
            </div>
            <div class="change-canvas">
                <canvas id="attendanceChart" class="canvas"></canvas>
            </div>
        </div>
     </div>

     {{-- Chart --}}
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script>
         const ctx = document.getElementById('myChart');
         const data = [];
         new Chart(ctx, {
             type: 'pie',
             data: {
                 labels: ['H', 'M', 'N', 'P'],
                 datasets: [{
                     label: 'Tỷ lệ điểm danh',
                     data: [<?php echo $H ?>, <?php echo $M ?>, <?php echo $N ?>, <?php echo $P ?>],
                     borderWidth: 1
                 }]
             },
             options: {
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 },
                 plugins: {
                        legend: {
                        position: 'top',
                    },
                        title: {
                        display: true,
                        text: 'Thống kê tỷ lệ điểm danh'
                    }
              }
             }
         });
     </script>

 @endsection
