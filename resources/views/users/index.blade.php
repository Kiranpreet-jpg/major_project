@extends('main.dashboard')
@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Teacher</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Teacher</h6>
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
            <div class="">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact Info</th>
                            <th>Other Info</th>
                            <th>Image</th>
                            @can('teacher-edit')
                            <th>Edit</th>
                            @endcan
                            @can('teacher-delete')
                            <th>Delete</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->teacher->contact }}<br/>{{ $user->teacher->address }}</td>
                                <td>
                                    {{ $user->teacher->date_of_birth !='' ? 'Date of Birth:- '.$user->teacher->date_of_birth : ''}}
                                    <br>
                                    {{ $user->teacher->date_of_joining !='' ? 'Date of Joining:- '.$user->teacher->date_of_joining : ''}}
                                    <br>
                                    {{ $user->teacher->gender !='' ? 'Gender:- '.$user->teacher->gender : ''}}
                                    <br>
                                    {{ $user->teacher->qualification !='' ? 'Qualification:- '.$user->teacher->qualification : ''}}
                                </td>
                                <td>  <?php
                                    if($user->teacher->image == "no-image.jpg")
                                    {
                                    ?>
                                        <img src="dist/img/no-image.jpg" class="img-responsive" style="width:100px;height:100px" />
                                    <?php
                                    }
                                    else{
                                    ?>
                                        <img src="{{ URL::to('/')}}/teacher_image/{{ $user->teacher->image}}" class="img-responsive" style="width:100px;height:100px" />
                                    <?php
                                    }
                                    ?>
                                </td>
                                <!-- <td>
                                <a class="btn btn-info" href="{{ route('users.show',$user->id) }}"><i class="fa fa-eye text-dark"></i></a>
                                </td> -->
                                @can('teacher-edit')
                                <td>
                                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
                                </td>
                                @endcan
                                @can('teacher-delete')
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    {!! Form::close() !!}
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
