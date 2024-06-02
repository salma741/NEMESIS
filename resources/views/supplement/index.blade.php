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
<a href="{{ URL::to('supplement/create') }}" class="btn btn btn-primary mb-3">
<i class="fas fa-plus" aria-hidden="true"></i> Add</a>
<table id="datatable1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Title</th>
        <th>Image</th>
        <th>Description</th>
        <th>User</th>
        <th width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($supplements as $index => $supplement )
         <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $supplement->title }}</td>
            <td><img src="{{ URL::to('storage/' . $supplement->image)  }}"
                class="rounded" style="width: 50px"></a></td></td>
            <td>{{ $supplement->description }}</td>
            <td>{{ $supplement->user->name }}</td>
            <td>
                <div class="d-flex">
                <a href="{{ URL::to('supplement/' . $supplement->id) }}" class="btn btn-sm btn-info mr-2">
                Show</a>
                <a href="{{ URL::to('supplement/' . $supplement->id. '/edit') }}" class="btn btn-sm btn-warning mr-2">
                Edit</a>
                <form action="{{ URL::to('supplement/' . $supplement->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Anda yakin ingin menghapus data ini {{ $supplement->name }}?')">Delete</button>
                </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection