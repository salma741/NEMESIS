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
        @foreach($maps as $index => $map)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $map->name }}</td>
                <td>{{ $map->address }}</td>
                <td>{{ $map->phone }}</td>
                <td>{{ $map->map_link }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ URL::to('map/' . $map->id) }}" class="btn btn-sm btn-info mr-2">
                            Show
                        </a>
                        <a href="{{ URL::to('map/' . $map->id . '/edit') }}" class="btn btn-sm btn-warning mr-2">
                            Edit
                        </a>
                        <form action="{{ URL::to('map/' . $map->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Anda yakin ingin menghapus data ini {{ $map->name }}?')">Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
