@extends('web.layouts.header')
@section('main')
<div class="container pt-lg-5">
    <div class="title-section pb-4">
        <h3 class="main-title-agile">View notes</h3>
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
        @foreach ($note as $notes)
        <div class="col-lg-4 col-md-6">
            <div class="agileits-about-grids">
                <span class="fas fa-book-reader text-color1"></span>
                <h4>{{$notes->title}}
                </h4>
                <p>Description:  <br>
                    {{$notes->description}}</p>
                <div class="row">
                    <div class="col-md-6">
                        <p>Teacher:</p>
                        <p>Course:</p>
                        <p>Subject:</p>
                        <p>Semester:</p>
                        <p>Due Date:</p>
                        <p>Due Time:</p>
                        <p>Document:</p>

                    </div>
                    <div class="col-md-6">
                        <p>{{ $notes->user->name }}</p>
                        <p>{{ $notes->course->name }}</p>
                        <p>{{ $notes->subject->name }}</p>
                        <p>{{ $notes->semester }}</p>
                        <p><?php
                            $u_date = explode('-', $notes->uploaded_date);
                            $new_up_date =  $u_date[2] . "-" . $u_date[1] . "-" . $u_date[0];
                            ?>
                            {{ $new_up_date }}</p>
                        <p><?php
                            echo date("h:i A", strtotime($notes->uploaded_time));

                            ?></p>
                        <p><a href="{{ URL::to('/')}}/upload_notes_documents/{{ $notes->document}}" target="_blank"> Download</a></p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- <div class="col-lg-4 col-md-6  mb-lg-0 mb-4">
                <div class="agileits-about-grids">
                    <span class="fas fa-graduation-cap text-color2"></span>
                    <h4>graduation
                        <span></span>
                    </h4>
                    <p>Itaque earum rerum hic tenetur asap iente delectus rulla accumsan ac elit in coeiciendis
                        maiores alias.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mx-auto">
                <div class="agileits-about-grids">
                    <span class="fas fa-bezier-curve text-color3"></span>
                    <h4>social
                        <span></span>
                    </h4>
                    <p>Itaque earum rerum hic tenetur asap iente delectus rulla accumsan ac elit in coeiciendis
                        maiores alias.</p>
                </div>
            </div> -->
    </div>
</div>
</section>
@endsection