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
<a href="{{ URL::to('trainer/create') }}" class="btn btn btn-primary mb-3">
<i class="fas fa-plus" aria-hidden="true"></i> Add</a>
<table id="datatable1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Name</th>
        <th>Image</th>
        <th>Description</th>
        <th>Address</th>
        <th>Phone</th>
        <th width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($trainers as $index => $trainer )
         <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $trainer->name }}</td>
            <td><img src="{{ URL::to('storage/' . $trainer->image)  }}"
                class="rounded" style="width: 50px"></a></td></td>
            <td>{{ $trainer->description }}</td>
            <td>{{ $trainer->address }}</td>
            <td>{{ $trainer->phone }}</td>
            <td>
                <div class="d-flex">
                <a href="{{ URL::to('trainer/' . $trainer->id) }}" class="btn btn-sm btn-info mr-2">
                Show</a>
                <a href="{{ URL::to('trainer/' . $trainer->id. '/edit') }}" class="btn btn-sm btn-warning mr-2">
                Edit</a>
                <form action="{{ URL::to('trainer/' . $trainer->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Anda yakin ingin menghapus data ini {{ $trainer->name }}?')">Delete</button>
                </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection