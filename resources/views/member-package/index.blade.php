@extends('layouts.main')
@section('container')
@include('sweetalert::alert')

@if(session()->has("successMessage"))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif    

@if(session()->has("errorMessage"))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif 

<a href="{{ URL::to('member-package/create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus" aria-hidden="true"></i> Add
</a>

<table id="datatable1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Duration Day</th>
            <th>With Trainer</th>
            <th>Duration Trainer</th>
            <th width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($memberPackages as $index => $memberPackage)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $memberPackage->name }}</td>
                <td>{{ $memberPackage->description }}</td>
                <td>{{ NumberFormat($memberPackage->price) }}</td>
                <td>{{ $memberPackage->duration_day }}</td>
                <td>{{ $memberPackage->is_with_trainer ? 'Yes' : 'No' }}</td>
                <td>{{ $memberPackage->duration_trainer }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ URL::to('member-package/' . $memberPackage->id) }}" class="btn btn-sm btn-info mr-2">
                            Show
                        </a>
                        <a href="{{ URL::to('member-package/' . $memberPackage->id . '/edit') }}" class="btn btn-sm btn-warning mr-2">
                            Edit
                        </a>
                        <form action="{{ URL::to('member-package/' . $memberPackage->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Anda yakin ingin menghapus data ini {{ $memberPackage->name }}?')">Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
