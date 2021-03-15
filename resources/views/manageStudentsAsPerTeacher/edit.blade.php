@extends('main.dashboard')
@section('main')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Student</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Student</h6>
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
                        {{-- <strong>Whoops!</strong> There were some problems with your input
                        required.<br><br> --}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                <form method="post" action="{{ route('studentAsPerTeacher.update', $student->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="student-name">Name*</label>
                            <input required type="text" name="name" value="{{ $student->name }}" class="form-control"
                                id="student_name" aria-describedby="studentName">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email*</label>
                            <input required type="text" name="email" value="{{ $student->email }}" class="form-control"
                                id="student_email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" value="{{ $student->nationality }}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact">Contact</label>
                            <input type="text" name="contact" value="{{ $student->contact }}" class="form-control"
                                id="student_description">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="student-address">Address</label>
                            <input type="text" name="address" value="{{ $student->address }}" class="form-control"
                                id="student_address" aria-describedby="studentaddress">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="father-name">Father Name</label>
                            <input type="text" name="father_name" value="{{ $student->father_name }}" class="form-control">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="student-dob">DOB</label>
                            <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}"
                                class="form-control" id="student_dob" aria-describedby="studentdob">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="roll-number">Roll Number*</label>
                            <input required type="text" name="roll_number" value="{{ $student->roll_number }}"
                                class="form-control">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="course-name">Course Name*</label>
                            <select required name="course_id" id="" class="form-control">
                                <option selected disabled>Select Course</option>
                                @foreach ($course as $courses)
                                    <option {{ $student->course_id == $courses->id ? 'selected' : '' }}
                                        value="{{ $courses->id }}">{{ $courses->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="course-name">Batch*</label>
                            <select name="batch_id" id="" class="form-control" required>
                                <option selected disabled>Select Batch</option>
                                @foreach ($batch as $batchs)
                                    <option {{ $student->batch_id == $batchs->id ? 'selected' : '' }} value="{{ $batchs->id }}">{{ $batchs->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="semester">Semester*</label>
                            <select required name="semester" class="form-control" id="">
                                <option {{ $student->semester == 1 ? 'selected' : '' }} value="{{ $student->semester }}">1
                                </option>
                                <option {{ $student->semester == 2 ? 'selected' : '' }} value="{{ $student->semester }}">2
                                </option>
                                <option {{ $student->semester == 3 ? 'selected' : '' }} value="{{ $student->semester }}">3
                                </option>
                                <option {{ $student->semester == 4 ? 'selected' : '' }} value="{{ $student->semester }}">4
                                </option>
                                <option {{ $student->semester == 5 ? 'selected' : '' }} value="{{ $student->semester }}">5
                                </option>
                                <option {{ $student->semester == 6 ? 'selected' : '' }} value="{{ $student->semester }}">6
                                </option>
                                <option {{ $student->semester == 7 ? 'selected' : '' }} value="{{ $student->semester }}">7
                                </option>
                                <option {{ $student->semester == 8 ? 'selected' : '' }} value="{{ $student->semester }}">8
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Description">Gender*</label>
                            <div class="form-row">
                                <span class="form-check">
                                    <input required class="form-check-input required" type="radio" name="gender"
                                        value="male" {{ $student->gender == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </span>
                                <span class="form-check">
                                    <input required class="form-check-input required" type="radio" name="gender"
                                        value="female" {{ $student->gender == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="student-image-file">Image</label>
                                <input type="file" name="image" class="form-control-file" id="student-image-file"><img
                                    src="{{ URL::to('/') }}/student_image/{{ $student->image }}" class="img-responsive"
                                    style="width:100px;height:100px; margin-top:15px" />
                                <input type="hidden" name="hidden_image" value="{{ $student->image }}" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        //ajax as per course
        $(document).ready(function() {
            $('select[name="course_id"]').on('change', function() {
                var course_id = $(this).val();
                // alert('student/studentBatchAjax/' + course_id);
                if (course_id) {
                    $.ajax({
                        url: '../studentTeacherBatchAjax/' + course_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="batch_id"]').empty();
                            $('select[name="batch_id"]').append(
                                '<option selected disabled>Select Batch</option>');
                            $.each(data, function(i, e) {
                                $('select[name="batch_id"]').append('<option value="' +
                                    e.id + '">' + e.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="batch_id"]').empty();
                }
            });
        });

    </script>
@endsection
