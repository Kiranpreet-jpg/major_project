@extends('main.dashboard')
@section('main')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Assignments</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Upload Assignment</h6>
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
            <form method="post" action="{{ route('assignments.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">Title*</label>
                        <input required type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="assignments_description">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course-name">Course Name*</label>
                        <select required name="course_id" id="" class="form-control">
                            @foreach($course as $courses)
                            <option value="{{$courses->id}}">{{$courses->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="semester">Semester*</label>
                        <select required name="semester" class="form-control" id="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6" style="display:none;">
                        <label for="teacher-name">Teacher Name*</label>
                        <select required name="teacher_user_id" id="" class="form-control">
                            @foreach($user as $users)
                            <option value="{{$users->id}}" {{ Auth::user()->id == $users->id ? 'selected' : 'disabled'}}>{{$users->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="assignments-document-file">Document*</label>
                            <input required type="file" name="document" class="form-control-file">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subject-name">Subject Name*</label>
                        <select required name="subject_id" id="" class="form-control">
                            @foreach($subject as $subjects)
                            <option value="{{$subjects->id}}">{{$subjects->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="assignments-upload-date">Due Date*</label>
                        <input required type="text" name="due_date" class="form-control datepicker" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="assignments-upload-time">Due Time*</label>
                        <input required type="time" name="due_time" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="type">Type*</label>
                        <select required name="type" class="form-control">
                            <option value="exam">Exam</option>
                            <option value="assignment">Assignment</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="marks">Marks</label>
                        <input type="number" name="marks" class="form-control">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
$('.datepicker').datepicker({
    startDate: new Date()
});
</script>
@endsection
