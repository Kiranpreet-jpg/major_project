<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Campus Management System</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dist/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dist/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                </div>
                <div class="sidebar-brand-text mx-3">Campus Management System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @can('role-list')
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->

            <!-- Nav Item - Pages Collapse Menu -->
            @canany(['role-list', 'role-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseroles" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-users"></i>
                    <span>Roles</span>
                </a>
                <div id="collapseroles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('role-list')
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        <!-- <a class="collapse-item" href="{{ route('roles.create') }}">Add Roles</a> -->
                        @endcan
                        @can('role-create')
                        <a class="collapse-item" href="{{ route('roles.index') }}">Manage Roles</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['teacher-list', 'teacher-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseusers" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-user-secret"></i>
                    <span>Teacher</span>
                </a>
                <div id="collapseusers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('teacher-create')
                            <a class="collapse-item" href="{{ route('users.create') }}"> Add Teacher </a>
                        @endcan
                        @can('teacher-list')
                            <a class="collapse-item" href="{{ route('users.index') }}"> Manage Teacher </a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['course-list', 'course-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourse" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-book-open"></i>
                    <span>Course</span>
                </a>
                <div id="collapseCourse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        @can('course-create')
                        <a class="collapse-item" href="{{ route('course.create') }}">Add Course</a>
                        @endcan
                        @can('course-list')
                        <a class="collapse-item" href="{{ route('course.index') }}">Manage Course</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['batch-list', 'batch-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBatch" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-id-badge"></i>
                    <span>Batch</span>
                </a>
                <div id="collapseBatch" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        @can('batch-create')
                        <a class="collapse-item" href="{{ route('schoolbatch.create') }}">Add Batch</a>
                        @endcan
                        @can('batch-list')
                        <a class="collapse-item" href="{{ route('schoolbatch.index') }}">Manage Batch</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['subject-list', 'subject-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubject" aria-expanded="true" aria-controls="collapseSubject">
                <i class="fa fa-book" aria-hidden="true"></i>
                    <span>Subject</span>
                </a>
                <div id="collapseSubject" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        @can('subject-create')
                        <a class="collapse-item" href="{{ route('subjects.create') }}">Add Subject</a>
                        @endcan
                        @can('subject-list')
                        <a class="collapse-item" href="{{ route('subjects.index') }}">Manage Subject</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['student-list', 'student-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudent" aria-expanded="true" aria-controls="collapseStudent">
                <i class="fa fa-graduation-cap fa-cog"></i>
                    <span>Student</span>
                </a>
                <div id="collapseStudent" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('student-create')
                        <a class="collapse-item" href="{{ route('student.create') }}">Add Student</a>
                        @endcan
                        @can('student-list')
                        <a class="collapse-item" href="{{ route('student.index') }}">Manage Student</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['assign-teacher-list', 'assign-teacher-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAssignTeacher" aria-expanded="true" aria-controls="collapseAssignTeacher">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <span>Assign Teacher</span>
                </a>
                <div id="collapseAssignTeacher" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        @can('assign-teacher-create')
                            <a class="collapse-item" href="{{ route('teacherAssign.create') }}">Assign Teachers</a>
                        @endcan
                        @can('assign-teacher-list')
                            <a class="collapse-item" href="{{ route('teacherAssign.index') }}">Manage Assigned Teacher</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany

            @canany(['mark-attendance', 'view-attendance'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAttendance" aria-expanded="true" aria-controls="collapseAttendance">
                <i class="fa fa-list" aria-hidden="true"></i>
                    <span>Attendance</span>
                </a>
                <div id="collapseAttendance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        @can('mark-attendance')
                        <a class="collapse-item" href="{{ route('attendance.create') }}">Mark Attendance</a>
                        @endcan
                        @can('view-attendance')
                        <a class="collapse-item" href="{{ route('attendance.index') }}">View Attendance</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany

            @canany(['notes-list', 'notes-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUploadNotes" aria-expanded="true" aria-controls="collapseUploadNotes">
                <i class="fa fa-sliders-h" aria-hidden="true"></i>
                    <span>Notes</span>
                </a>
                <div id="collapseUploadNotes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('notes-create')
                        <a class="collapse-item" href="{{ route('notes.create') }}">Upload Notes</a>
                        @endcan
                        @can('notes-create')
                        <a class="collapse-item" href="{{ route('notes.index') }}">View Notes</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['assignment-list', 'assignment-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAssignment" aria-expanded="true" aria-controls="collapseAssignment">
                <i class="fa fa-cubes" aria-hidden="true"></i>
                    <span>Assignments</span>
                </a>
                <div id="collapseAssignment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('assignment-create')
                        <a class="collapse-item" href="{{ route('assignments.create') }}">Upload Assignments</a>
                        @endcan
                        @can('assignment-list')
                        <a class="collapse-item" href="{{ route('assignments.index') }}">View Assignments</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['view-answer-assignment'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnswerAssignment" aria-expanded="true" aria-controls="collapseAnswerAssignment">
                <i class="fa fa-crosshairs" aria-hidden="true"></i>
                    <span>Answer Assignment/Exam</span>
                </a>
                <div id="collapseAnswerAssignment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        @can('view-assignment-answer-detail')
                        <a class="collapse-item" href="{{ route('viewAnswerAssignment.index') }}">View Answers</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['teacher-student-list','teacher-student-create'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManageStudentsAsPerTeacher" aria-expanded="true" aria-controls="collapseManageStudentsAsPerTeacher">
                <i class="fa fa-sticky-note" aria-hidden="true"></i>
                    <span>Student</span>
                </a>
                <div id="collapseManageStudentsAsPerTeacher" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        @can('teacher-student-create')
                        <a class="collapse-item" href="{{ route('studentAsPerTeacher.create') }}">Add Student</a>
                        @endcan
                        @can('teacher-student-list')
                        <a class="collapse-item" href="{{ route('studentAsPerTeacher.index') }}">manage Student</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            @canany(['view-feedback'])
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseViewFeedback" aria-expanded="true" aria-controls="collapseViewFeedback">
                <i class="fa fa-comments" aria-hidden="true"></i>
                    <span>View Feedback</span>
                </a>
                <div id="collapseViewFeedback" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Teacher:</h6> -->
                        @can('view-feedback')
                            <a class="collapse-item" href="{{ route('feedback.index') }}">View Feedback</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcanany
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{asset('dist/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('main')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('dist/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('dist/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('dist/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{asset('dist/vendor/chart.js/Chart.min.js')}}"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="{{asset('dist/js/demo/chart-area-demo.js')}}"></script> -->
    <!-- <script src="{{asset('dist/js/demo/chart-pie-demo.js')}}"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</body>

</html>
