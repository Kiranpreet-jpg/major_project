@extends('web.layouts.header')
@section('main')
<div class="container pt-lg-5">
    <div class="title-section pb-4">
        <h3 class="main-title-agile">Choose Subject To View Attendance</h3>
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
        @foreach ($subject as $subjects)
        <div class="col-4 pl-0">
            <a href="{{route('web.showAttendanceAsPerSubject', $subjects->id)}}">
                <div class="agileits-service-grids">
                    <div class="services-top">
                        <img src="{{asset('web/images/s1.png')}}" alt="" class="img-fluid">
                        <h4>{{$subjects->name }}</h4>
                    </div>
                </div>
            </a>
        </div>

        @endforeach
        <!-- <div class="col-lg-4 col-md-6 mx-auto">
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
