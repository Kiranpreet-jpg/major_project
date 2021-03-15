@extends('main.dashboard')
@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Notes</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View Notes</h6>
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
                <table class="table table-responsive table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Course</th>
                            <th>semester</th>
                            <th>Teacher</th>
                            <th>subject</th>
                            <th>Document</th>
                            <th>Uploaded Date</th>
                            <th>Uploaded time</th>
                            @can('notes-edit')
                            <th>Edit</th>
                            @endcan
                            @can('notes-delete')
                            <th>Delete</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($note as $notes)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $notes->title }}</td>
                            <td>{{ $notes->description }}</td>
                            <td>{{ $notes->course->name }}</td>
                            <td>{{ $notes->semester}}</td>
                            <td>{{ $notes->user->name}}</td>
                            <td>{{ $notes->subject->name}}</td>
                            <td><a href="{{ URL::to('/')}}/upload_notes_documents/{{ $notes->document}}" target="_blank"> Download Notes</a></td>
                            <td>
                                <?php
                                $u_date = explode('-', $notes->uploaded_date);
                                $new_up_date =  $u_date[2] . "-" . $u_date[1] . "-" . $u_date[0];
                                ?>
                                {{ $new_up_date }}
                            </td>
                            <td>
                                <?php
                                echo date("h:i A", strtotime($notes->uploaded_time));

                                ?>
                            </td>
                            @can('notes-edit')
                            <td><a href="{{ route('notes.edit', $notes->id)}}"><button class="btn btn-success" type="submit"><i class="fa fa-edit "></i></button></a></td>
                            @endcan
                            @can('notes-delete')
                            <td>
                                <form method="post" action="{{ route('notes.destroy', $notes->id ) }}">
                                    @csrf
                                    @method('Delete')
                                    <a href="#"><button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button></a>
                                </form>
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
