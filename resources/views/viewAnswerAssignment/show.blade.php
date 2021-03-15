@extends('main.dashboard')
@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">View Answer</h1>
        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                            For more information about DataTables, please visit the <a target="_blank"
                                href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <strong>Subject :</strong> {{ $final_data['subject'] }}
                        </td>
                        <td>
                            <strong>Assignment Title :</strong> {{ $final_data['assignment_title'] }}
                        </td>
                        <td>
                            <strong>Student Name :</strong> {{ $final_data['student_name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Course :</strong> {{ $final_data['course'] }}
                        </td>
                        <td>
                            <strong>Semester :</strong> {{ $final_data['semester'] }}
                        </td>
                        <td>
                            <strong>Batch :</strong> {{ $final_data['batch'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Due Date :</strong> {{ $final_data['due_date'] }}
                        </td>
                        <td>
                            <strong>Due Time :</strong> {{ $final_data['due_time'] }}
                        </td>
                        <td>
                            <strong>Marks :</strong>
                            {{ $final_data['marks_allocated'] == null ? '-' : $final_data['marks_allocated'] }}/{{ $final_data['marks'] }}
                        </td>
                    </tr>
                </table>
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

                <div class="row">
                    <div class="col-sm-6">
                        <h3>Question Paper</h3>
                        <a href="../upload_assignments_documents/{{ $final_data['question_paper'] }}" target="_blank">View
                            Full Question Paper</a>
                        <div class="embed-responsive embed-responsive-21by9">
                            <iframe class="embed-responsive-item"
                                src="../upload_assignments_documents/{{ $final_data['question_paper'] }}"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h3>Answer Sheet</h3>
                        <a href="../answers/{{ $final_data['answer_sheet'] }}" target="_blank">View Full Answer Sheet</a>
                        <div class="embed-responsive embed-responsive-21by9">
                            <iframe class="embed-responsive-item" src="../answers/{{ $final_data['answer_sheet'] }}"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer py-3">
                <form class="form-inline" method="post" action="{{ route('viewAnswerAssignment.update',$final_data['id']) }}">
                    @csrf
                    @method('Patch')
                    <div class="form-group mx-sm-3 mb-2">Enter Marks</div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="number" class="form-control" id="inputPassword2" placeholder="Enter marks" value="{{ $final_data['marks_allocated'] == null ? '0' : $final_data['marks_allocated']}}" name="marks_allocated">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Submit </button>
                </form>
            </div>
        </div>

    </div>
@endsection
