@extends('main.dashboard')
@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Batch</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Batch</h6>
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
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Course</th>
                        @can('batch-edit')
                        <th>Edit</th>
                        @endcan
                        @can('batch-delete')
                        <th>Delete</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($batch as $batches)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $batches->name }}</td>
                        <td>{{ $batches->description }}</td>
                        <td>{{ $batches->course->name }}</td>
                        @can('batch-edit')
                        <td><a href="{{ route('schoolbatch.edit', $batches->id)}}"><button class="btn btn-success" type="submit"><i class="fa fa-edit "></i></button></a></td>
                        @endcan
                        @can('batch-delete')
                        <td>
                            <form method="post" action="{{ route('schoolbatch.destroy', $batches->id ) }}">
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
@endsection
