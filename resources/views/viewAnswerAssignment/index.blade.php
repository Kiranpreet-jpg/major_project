@extends('main.dashboard')
@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Answer Assignment</h1>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                                For more information about DataTables, please visit the <a target="_blank"
                                    href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">View Answer Assignment</h6>
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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course-name">Course Name*</label>
                        <select required name="course_id" id="" class="form-control">
                            <option selected disabled>Select Course</option>
                            @foreach ($course as $courses)
                                <option value="{{ $courses->id }}">{{ $courses->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="batch-name">Batch Name*</label>
                        <select required name="batch_id" id="" class="form-control">
                            <option value="">Batch</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="subject-name">subject Name*</label>
                        <select required name="subject_id" id="" class="form-control">
                            <option value="">subject</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Assignment-name">Assignment Name*</label>
                        <select required name="assignment_id" id="" class="form-control">
                            <option value="">Assignment</option>
                        </select>
                    </div>
                </div>

                <div class="">
                    <table class="table table-bordered" id="showAssignement" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Student Name</th>
                                <th>Assignment</th>
                                <th>Document</th>
                                <th>Remarks</th>
                                <th>Marks Allocated</th>

                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        //ajax as per course
        $(document).ready(function() {
            $('select[name="course_id"]').on('change', function() {
                var course_id = $(this).val();
                // alert('assignment/batchAjax/'+course_id);
                if (course_id) {
                    $.ajax({
                        url: 'assignment/batchAjax/' + course_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // alert(data.batches);
                            $('select[name="batch_id"]').empty();
                            $('select[name="batch_id"]').append(
                                '<option selected disabled>Select Batch</option>');
                            $.each(data.batches, function(i, e) {
                                $('select[name="batch_id"]').append('<option value="' +
                                    e.id + '">' + e.name + '</option>');
                            });
                            $('select[name="subject_id"]').empty();
                            $('select[name="subject_id"]').append(
                                '<option selected disabled>Select Subject</option>');
                            $.each(data.subject, function(i, f) {
                                $('select[name="subject_id"]').append(
                                    '<option value="' + f.id + '">' + f.name +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="batch_id"]').empty();
                }
            });
        });

        //ajax as per subject
        $(document).ready(function() {
            $('select[name="subject_id"]').on('change', function() {
                var course_id = $('select[name="course_id"]').val();
                var subject_id = $(this).val();
                // alert('assignment/assignmentAjax/'+course_id+"/"+subject_id);
                if (course_id) {
                    $.ajax({
                        url: 'assignment/assignmentAjax/' + course_id + "/" + subject_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // alert(data.batches);
                            $('select[name="assignment_id"]').empty();
                            $('select[name="assignment_id"]').append(
                                '<option selected disabled>Select Assignment</option>');
                            $.each(data, function(i, e) {
                                $('select[name="assignment_id"]').append(
                                    '<option value="' + e.id + '">' + e.title +
                                    '-' + e.type + '</option>');
                            });

                        }
                    });
                } else {
                    $('select[name="batch_id"]').empty();
                }
            });
        });

        //ajax as per assignment id
        $(document).ready(function() {
            $('select[name="assignment_id"]').on('change', function() {
                var assignment_id = $(this).val();
                // alert('assignment/assignmentAnsAjax/'+ assignment_id);
                if (assignment_id) {
                    $.ajax({
                        url: 'assignment/assignmentAnsAjax/' + assignment_id,
                        type: "GET",
                        dataType: "json",
                        success: function(answerAssignments) {
                            console.log(answerAssignments);
                            $("#showAssignement > tbody").empty();

                            $.each(answerAssignments, function(i, e) {
                                var cnt = i + 1;
                                var url = window.location.href+"/"+e.id;
                                var output = '<tr><td>' + cnt + '</td><td>' + e.student
                                    .name + '</td><td>' + e
                                    .assignment.title + '</td><td><a href="answers/' + e
                                    .document +
                                    '" target="_blank">Download Answer</a></td>';
                                if (e.marks_allocated == null) {
                                    output += '><td>-/' + e.assignment.marks +'</td><td><a href="'+url+'"><button class="btn btn-primary btn-sm" >View Detail</button></a></td></tr>';
                                } else {

                                    output += '<td>' + e
                                        .marks_allocated + '/' + e.assignment.marks +
                                        '</td><td><a href="'+url+'"><button class="btn btn-primary btn-sm" >View Detail</button></a></td><tr>';
                                }


                                $("#showAssignement > tbody").append(output);

                            });

                        }
                    });
                } else {
                    $('#showAssignement > tbody').empty();
                }
            });
        });

    </script>


@endsection
