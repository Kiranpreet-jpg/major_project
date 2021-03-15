@extends('main.dashboard')
@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Student</h1>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                                For more information about DataTables, please visit the <a target="_blank"
                                    href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Student</h6>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger
                     alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{-- <strong>Whoops!</strong> There were some problems with your
                        input.<br><br> --}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                <div class="">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Course Info</th>
                                <th>Personal Info</th>
                                <th>Contact Info</th>
                                <th>Thumbnail</th>
                                @can('teacher-student-edit')
                                <th>Edit</th>
                                @endcan
                                @can('teacher-student-delete')
                                <th>Delete</th>
                                @endcan
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($student as $students)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>Course </strong> {{ $students->course->name }}
                                        <br />
                                        <strong>Batch </strong>{{ $students->batch->name }}
                                        <br />
                                        <strong>Semester </strong>{{ $students->semester }}
                                        <br />
                                        <strong>Roll Number </strong>{{ $students->roll_number }}

                                    </td>
                                    <td>
                                        <strong>Student Name </strong>{{ $students->name }}
                                        <br>
                                        <strong>Gender </strong>{{ $students->gender }}
                                        <br>
                                        <strong>DOB </strong>{{ $students->date_of_birth }}
                                        <br>
                                        <strong>Father's Name</strong>{{ $students->father_name }}
                                        <br>
                                        <strong>Nationality</strong>{{ $students->nationality }}
                                    </td>
                                    <td>
                                        <strong>Email </strong>{{ $students->email }}<br>
                                        <strong>Contact </strong>{{ $students->contact }}<br>
                                        <strong>Address </strong>{{ $students->address }}<br>
                                    </td>
                                    <td>
                                        <?php if ($students->image == 'no-image.jpg') { ?>
                                        <img src="dist/img/no-image.jpg" class="img-responsive"
                                            style="width:100px;height:100px" />
                                        <?php } else { ?>
                                        <img src="{{ URL::to('/') }}/student_image/{{ $students->image }}"
                                            class="img-responsive" style="width:100px;height:100px" />
                                        <?php } ?>
                                        <input type="hidden" name="hidden_image" />
                                    </td>
                                    @can('teacher-student-edit')
                                    <td>
                                        <a href="{{ route('studentAsPerTeacher.edit', $students->id) }}"><button class="btn btn-success" type="submit"><i class="fa fa-edit "></i></button></a></td>
                                    @endcan
                                    @can('teacher-student-delete')
                                    <td>
                                        <form method="post" action="{{ route('studentAsPerTeacher.destroy', $students->id) }}">
                                            @csrf
                                            @method('Delete')
                                            <a href="#"><button class="btn btn-danger" type="submit"><i
                                                        class="fa fa-trash"></i></button></a>
                                        </form>
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
