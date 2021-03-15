@extends('main.dashboard')
@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Teacher</h1>

    <!-- DataTales Example -->
    <!-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

            </div>
        </div>
    </div> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Teacher</h6>
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
                {{-- <strong>Whoops!</strong> There were some problems with your input required.<br><br> --}}
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
            @endif

            <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf
                <div style="display:none">
                    <select name="roles[]" >
                        @foreach ($roles as $role)
                            <option {{ $role=="Teacher" ? 'selected' : 'disabled' }}>{{$role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="teacher-name">Name*</label>
                        <input required type="text" name="name" class="form-control" id="teacher_name" aria-describedby="teacherName">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email*</label>
                        <input required type="text" name="email" class="form-control" id="teacher_email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="teacher-password">Password*</label>
                        <input required type="password" name="password" class="form-control" id="teacher_password" aria-describedby="teacherpassword">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="contact">Contact*</label>
                        <input required type="text" name="contact" class="form-control" id="teacher_Contact">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="teacher-address">Address</label>
                        <input type="text" name="address" class="form-control" id="teacher_address" aria-describedby="teacheraddress">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Description">Gender*</label>
                        <div class="form-row">
                            <span class="form-check">
                                <input required class="form-check-input required" type="radio" name="gender" id="male" value="male" checked>
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </span>
                            <span class="form-check">
                                <input required class="form-check-input required" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="teacher-dob">DOB</label>
                        <input type="date" name="date_of_birth" class="form-control" id="teacher_dob" aria-describedby="teacherdob">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="teacher-image-file">Image</label>
                            <input type="file" name="image" class="form-control-file" id="teacher-image-file">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="teacher-qualification">Qualification*</label>
                        <input required type="text" name="qualification" class="form-control" id="teacher_qualification" aria-describedby="teacherqualification">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dateOfJoining">Date of Joining</label>
                        <input type="date" name="date_of_joining" class="form-control" id="teacher_dateOfJoining">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
