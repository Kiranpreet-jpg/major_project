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
                <table class="table table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Image</th>
                            <th>Qualification</th>
                            <th>Date of Joining</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teacher as $teachers)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $teachers->name }}</td>
                            <td>{{ $teachers->email }}</td>
                            <td>{{ $teachers->contact }}</td>
                            <td>{{ $teachers->address }}</td>
                            <td>{{ $teachers->gender }}</td>
                            <td>{{ $teachers->date_of_birth }}</td>
                            <td>  <?php
                            if($teachers->image == "no-image.jpg")
                            {
                            ?>
                                <img src="dist/img/no-image.jpg" class="img-responsive" style="width:100px;height:100px" />
                            <?php
                            }
                            else{
                            ?>
                                <img src="{{ URL::to('/')}}/teacher_image/{{ $teachers->image}}" class="img-responsive" style="width:100px;height:100px" />
                            <?php
                            }
                            ?>
                            <input type="hidden" name="hidden_image" /></td>
                            <td>{{ $teachers->qualification }}</td>
                            <td>{{ $teachers->date_of_joining }}</td>
                            <td><a href="{{route('teacher.edit',$teachers->id)}}"><button class="btn btn-success" type="submit"><i class="fa fa-edit "></i></button></a></td>
                            <td>
                                <form method="post" action="{{ route('teacher.destroy', $teachers->id ) }}">
                                    @csrf
                                    @method('Delete')
                                    <a href="#"><button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
