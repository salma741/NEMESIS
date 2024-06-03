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

<a href="{{ URL::to('map/create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus" aria-hidden="true"></i> Add
</a>

<table id="datatable1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Map Link</th>
            <th width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($configurations as $index => $configuration)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $configuration->name }}</td>
                <td>{{ $configuration->address }}</td>
                <td>{{ $configuration->phone }}</td>
                <td>{{ $configuration->map_link }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ URL::to('map/' . $configuration->id) }}" class="btn btn-sm btn-info mr-2">
                            Show
                        </a>
                        <a href="{{ URL::to('map/' . $configuration->id . '/edit') }}" class="btn btn-sm btn-warning mr-2">
                            Edit
                        </a>
                        <form action="{{ URL::to('map/' . $configuration->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Anda yakin ingin menghapus data ini {{ $configuration->name }}?')">Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
