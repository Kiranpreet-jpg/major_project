@extends('web.layouts.header')
@section('main')
<div class="container pt-lg-5">
    <div class="title-section pb-4">
        <h3 class="main-title-agile">View Assignments/Exam</h3>
        <div class="title-line">
        </div>
    </div>
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
    <div class="agileits-top-row row py-md-5">
        @foreach ($assignment as $assignments)
        <div class="col-lg-4 col-md-6">
            <div class="agileits-about-grids">
                <span class="fas fa-book-reader text-color1"></span>
                <h4>Title:{{$assignments['title']}}
                    <span></span>
                    <p>({{$assignments['type']}})</p>
                </h4>
                <p>Description: <br>
                    {{$assignments['description']}}</p>
                <div class="row">
                    <div class="col-md-6">
                        <p>Teacher:</p>
                        <p>Course:</p>
                        <p>Subject:</p>
                        <p>Semester:</p>
                        <p>Due Date:</p>
                        <p>Due Time:</p>
                        <p>Marks:</p>
                        <p>Questionnaire:</p>
                        <p>Answer:</p>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $assignments['name'] }}</p>
                        <p>{{ $assignments['course'] }}</p>
                        <p>{{ $assignments['subject'] }}</p>
                        <p>{{ $assignments['semester'] }}</p>
                        <p>
                            <?php
                                $u_date = explode('/', $assignments['due_date']);
                                $new_up_date =  $u_date[1] . "-" . $u_date[0] . "-" . $u_date[2];
                            ?>
                            {{ $new_up_date }}
                        </p>
                        <p>
                            <?php
                                echo date("h:i A", strtotime($assignments['due_time']));
                            ?>
                        </p>
                        <p>{{$assignments['marks_allocated']}}/{{$assignments['marks']}}</p>
                        <p><a href="{{ URL::to('/')}}/upload_assignments_documents/{{ $assignments['document']}}" target="_blank"> Download</a></p>
                        <p><a href="answers/{{ $assignments['answer']}}" target="_blank"> Download</a></p>

                    </div>
                </div>

                <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#exampleModal{{$loop->iteration}}">
                    Upload Answer
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Answer</h5>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('stuAssignment.store')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="assignment_id" value="{{$assignments['id']}}"/>
                                <input type="file" name="answer" class="form-control"/>
                                <button type="button" class="btn btn-secondary my-2 float-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary my-2 float-right">Submit</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>
@endsection
