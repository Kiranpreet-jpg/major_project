@extends('main.dashboard')
@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">View Attendance</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View Attendance</h6>
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
                <!-- {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}} -->
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
                    <select name="course_id" id="" class="form-control">
                        <option selected disabled>Select Course</option>
                        @foreach($course as $courses)
                        <option value="{{$courses->id}}">{{$courses->name}}</option>
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
                    <label for="date">Date*</label>
                    <input type="date" name="attendance_date" id="at_date" class="form-control">
                </div>
            </div>

            <div class="" style="display:none;" id="tbl">
                <table class="table table-bordered"  width="100%" cellspacing="0" style="color:black">
                    <thead>
                        <tr>
                            <th>Roll number</th>
                            <th>Student Name</th>
                            <th>Attendance</th>
                        </tr>
                    </thead>
                    <tbody id="showAttendance">

                    </tbody>
                    </tfoot>

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
            //  alert('viewBatchAjax/'+course_id);
            if (course_id) {
                $.ajax({
                    url: 'attendance/viewBatchAjax/' + course_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        //  alert(data.batches);
                        $('select[name="batch_id"]').empty();
                        $('select[name="batch_id"]').append('<option selected disabled>Select Batch</option>');
                        $.each(data.batches, function(i, e) {
                            $('select[name="batch_id"]').append('<option value="' + e.id + '">' + e.name + '</option>');
                        });
                        $('select[name="subject_id"]').empty();
                        $('select[name="subject_id"]').append('<option selected disabled>Select Subject</option>');
                        $.each(data.subject, function(i, f) {
                            $('select[name="subject_id"]').append('<option value="' + f.id + '">' + f.name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="batch_id"]').empty();
            }
        });
    });

    //ajax as per date
    $(document).ready(function() {
        $('#at_date').change( function() {
           var date = $(this).val();
           var course_id = $("select[name='course_id']").val();
           var batch_id = $("select[name='batch_id']").val();
           var subject_id = $("select[name='subject_id']").val();

            //  alert('viewAttendanceAjax/'+course_id+'/'+batch_id+'/'+subject_id+'/'+date);
            if (course_id && batch_id && subject_id && date) {
                $.ajax({
                    url: '../viewAttendanceAjax/'+course_id+'/'+batch_id+'/'+subject_id+'/'+date,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        //  alert(data.batches);
                        $("#showAttendance").empty();
                        document.getElementById('tbl').style.display="block";
                        $.each(data, function(i, e) {
                            var cnt= i+1;
                            // console.log(e);
                            var all_data = '<tr><td>'+e.rollno+'</td><td>'+e.student_name+'</td>';
                                if(e.attendance=="absent")
                                {
                                    all_data += '<td style="background:#F98580; font-size:large; text-transform:capitalize">'+e.attendance+'</td><tr>';
                                }
                                else{
                                    all_data += '<td style="background:#3BA946; font-size:large; text-transform:capitalize">'+e.attendance+'</td><tr>';
                                }

                            document.getElementById('showAttendance').innerHTML = document.getElementById('showAttendance').innerHTML+all_data;
                        });
                    }
                });
            } else {
                $('#showAttendance').empty();
            }
        });
    });
</script>
@endsection
