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
<a href="{{ URL::to('program/create') }}" class="btn btn btn-primary mb-3">
<i class="fas fa-plus" aria-hidden="true"></i> Add</a>
<table id="datatable1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Tittle</th>
        <th>Description</th>
        <th>User</th>
        <th width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($programs as $index => $program )
         <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $program->title }}</td>
            <td>{{ $program->description }}</td>
            <td>{{ $program->user->name }}</td>
            <td>
                <div class="d-flex">
                <a href="{{ URL::to('program/' . $program->id) }}" class="btn btn-sm btn-info mr-2">
                Show</a>
                <a href="{{ URL::to('program/' . $program->id. '/edit') }}" class="btn btn-sm btn-warning mr-2">
                Edit</a>
                <form action="{{ URL::to('program/' . $program->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Anda yakin ingin menghapus data ini {{ $program->name }}?')">Delete</button>
                </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection