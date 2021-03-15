@extends('main.dashboard')
@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Subject</h1>

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
            <h6 class="m-0 font-weight-bold text-primary">Edit Subject</h6>
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
                {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}}
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
            @endif
            <form method="post" action="{{ route('subjects.update',$subject->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="course-name">Course Name*</label>
                    <select class="form-control" name="course_id" required>
                        @foreach ($course as $courses)
                        <option {{ $subject->course_id == $courses->id ? 'selected' : '' }} value="{{$courses->id}}">{{$courses->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject-name">Subject Name*</label>
                    <input type="text" class="form-control" value="{{ $subject->name }}" name="name" id="subject_name" aria-describedby="subjectName" required>
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" name="description" class="form-control" value="{{ $subject->description }}" id="subject_description">
                </div>
                <div class="form-group">
                    <label for="Semester">Semester*</label>
                    <input type="text" name="semester" class="form-control" value="{{ $subject->semester }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection