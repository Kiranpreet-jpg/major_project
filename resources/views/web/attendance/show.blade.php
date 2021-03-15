@extends('web.layouts.header')
@section('main')
    <div class="container pt-lg-5">
        <div class="title-section pb-4">
            <h3 class="main-title-agile">View Attendance</h3>
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
                {{-- <strong>Whoops!</strong> There were some problems with your
                input.<br><br> --}}
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="agileits-top-row row py-md-5">
            <div class="col-12 pl-0">

                <div class="agileits-service-grids">
                    <div class="" id="tbl">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-sm-4"><strong>Subject:</strong> {{ $final_attend1['subject'] }}</div>
                                <div class="col-sm-4"><strong>Lectures:</strong> {{ $final_attend1['total_lecture'] }}</div>
                                <div class="col-sm-4"><strong>Attended Lectures:</strong> {{ $final_attend1['attended_lecture'] }}</div>

                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Date</th>
                                        <th>Attendance</th>
                                    </tr>
                                    @foreach ($final_attend['attendance_array'] as $fa)
                                        <tr>
                                            <td>{{ $fa['attendance_date'] }}</td>
                                            @if($fa['day_attendance']=="present")
                                            <td style="text-transform:capitalize; color:rgba(78, 212, 44, 0.849)">{{ $fa['day_attendance'] }}</td>
                                            @else
                                            <td style="text-transform:capitalize; color:rgba(212, 29, 29, 0.849)">{{ $fa['day_attendance'] }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

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
