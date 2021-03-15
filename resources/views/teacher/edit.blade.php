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
            <h6 class="m-0 font-weight-bold text-primary">Edit teacher</h6>
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
            <form method="post" action="{{ route('teacher.update',$teacher->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="teacher-name">Name*</label>
                        <input required type="text" class="form-control" name="name" value="{{ $teacher->name }}" id="teacher_name" aria-describedby="teacherName">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email*</label>
                        <input required type="text" class="form-control" name="email" value="{{ $teacher->email }}" id="teacher_email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Description">Contact*</label>
                        <input required type="text" class="form-control" name="contact" value="{{ $teacher->contact }}" id="teacher_description">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="teacher-dob">DOB</label>
                        <input type="date" class="form-control" name="date_of_birth" value="{{ $teacher->date_of_birth }}" id="teacher_dob" aria-describedby="teacherdob">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="teacher-address">Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $teacher->address }}" id="teacher_address" aria-describedby="teacheraddress">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Description">Gender*</label>
                        <div class="form-row">
                            <span class="form-check">
                                <input required class="form-check-input required" type="radio" name="gender" {{ $teacher->gender == "male" ? 'checked' : ''}} value="male">
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </span>
                            <span class="form-check">
                                <input required class="form-check-input required" type="radio" name="gender" value="female" {{ $teacher->gender == "female" ? 'checked' : ''}}>
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="teacher-qualification">Qualification*</label>
                        <input required type="text" class="form-control" name="qualification" value="{{ $teacher->qualification }}" id="teacher_qualification" aria-describedby="teacherqualification">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dateOfJoining">Date of Joining</label>
                        <input type="date" class="form-control" name="date_of_joining" value="{{ $teacher->date_of_joining }}" id="teacher_dateOfJoining">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="teacher-image-file">Image</label>
                            <input type="file" class="form-control" name="image"> <img src="{{ URL::to('/')}}/teacher_image/{{ $teacher->image}}" class="img-responsive" style="width:100px;height:100px; margin-top:15px" />
                            <input type="hidden" name="hidden_image" value="{{ $teacher->image}}" />
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection