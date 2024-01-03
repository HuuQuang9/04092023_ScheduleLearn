<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            Quản lý điểm danh
            <sup><i class="far fa-check-circle"></i></sup>
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <div style="overflow-y: auto; height: calc(100vh - 71px);" class="body-sidebar">

        <!-- Nav Item - Dashboard -->
        @if (checkRoleMenu())
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="fa fa-fw fa-tachometer-alt"></i>
                    <span>Thống kê</span></a>
            </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        {{-- <div class="sidebar-heading">
           Staff
        </div> --}}

        <!-- Nav Item - Pages Collapse Menu -->
        @if (checkRoleMenu())
            <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                <a class="nav-link collapsed" href="/users">

                    <i class="fa fa-fw fa-cog"></i>
                    <span>Giáo vụ</span>
                </a>
            </li>
        @endif

        <!-- Nav Item  -->
        @if (checkRoleMenu())
            <li class="nav-item {{ request()->is('students*') ? 'active' : '' }}">
                <a class="nav-link" href="/students">
                    <i class="fas fa-user-graduate"></i>
                    <span>Quản lý sinh viên</span>
                </a>
            </li>
        @endif

        <!-- Nav Item -->
        @if (checkRoleMenu())
            <li class="nav-item {{ request()->is('lecturers*') ? 'active' : '' }}">
                <a class="nav-link" href="/lecturers">
                    <i class="fas fa-user-tie"></i>
                    <span>Quản lý giảng viên</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
        @endif



        <!-- Heading -->
        {{-- <div class="sidebar-heading">
            Study
        </div> --}}

        <!-- Nav Item  -->
        @if (checkRoleMenu([3]))
            <li class="nav-item  {{ request()->is('classrooms*') ? 'active' : '' }}">
                <a class="nav-link" href="/classrooms">
                    <i class="fa fa-fw fa-table"></i>
                    <span>Lớp học</span></a>
            </li>
        @endif

        <!-- Nav Item  -->
        @if (checkRoleMenu())
            <li class="nav-item  {{ request()->is('schoolYears*') ? 'active' : '' }}">
                <a class="nav-link" href="/schoolYears">
                    <i class="far fa-clock"></i>
                    <span>Niên khoá</span></a>
            </li>
        @endif

        <!-- Nav Item  -->
        @if (checkRoleMenu([1, 2, 3]))
            <li class="nav-item {{ request()->is('schedules*') ? 'active' : '' }}">
                <a class="nav-link" href="/schedules">
                    <i class="fas fa-calendar-alt"></i>
                    @if(checkRoleMenu([1]))
                        <span>Lịch dạy</span></a>
                    @else
                        <span>Lịch học</span></a>
                    @endif
            </li>
        @endif

        <!-- Nav Item  -->
        @if (checkRoleMenu())
            <li class="nav-item {{ request()->is('specializeds*') ? 'active' : '' }}">
                <a class="nav-link" href="/specializeds">
                    <i class="fas fa-toolbox"></i>
                    <span>Chuyên ngành</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        @endif



        <!-- Nav Item  -->
        @if (checkRoleMenu([3]))
            <li class="nav-item {{ request()->is('subjects*') ? 'active' : '' }}">
                <a class="nav-link" href="/subjects">
                    <i class="fas fa-book"></i>
                    <span>Môn học</span></a>
            </li>
        @endif

        <!-- Nav Item  -->
        @if (checkRoleMenu([1, 3]))
            <li class="nav-item {{ request()->is('lessons*') ? 'active' : '' }}">
                <a class="nav-link" href="/lessons">
                    <i class="fas fa-book-open"></i>
                    <span>Buổi học</span></a>
            </li>
        @endif
        @if (checkRoleMenu([1]) && session()->get('user')['role'] == 1)
            <li class="nav-item {{ request()->is('subLessons*') ? 'active' : '' }}">
                <a class="nav-link" href="/subLessons">
                    <i class="fas fa-book-open"></i>
                    <span>Dạy thay thế</span>
                    @if($lessonCount)
                    <span style="display: inline-block; width: 25px; height: 25px; border-radius: 50%; background: red; color: #fff;text-align: center;line-height: 26px;">{{$lessonCount}}</span>
                    @endif
                </a>
            </li>
        @endif
        @if (checkRoleMenu([1, 3, 2]))
            <!-- Nav Item  -->
            <li class="nav-item {{ request()->is('attendances*') ? 'active' : '' }}">
                <a class="nav-link" href="/attendances">
                    <i class="fas fa-user-check"></i>
                    <span>Điểm danh</span></a>
            </li>
        @endif
    </div>
</ul>
