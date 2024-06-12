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

<table id="datatable1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Registration Id</th>
        <th>Nama Customer</th>
        <th>Nama Trainer</th>
        <th>Jumlah pertemuan Trainer</th>
        <th>Masa Trainer</th>
        <th>Tanggal check-in</th>
        <th width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($checkstatuss as $index => $check )

         <tr>
            <td>{{ $index + 1 }}</td>
            <td class="align-middle">{{$check->registration_id }}</td>
            <td>{{$check->registration->member->name }}</td>
            <td>{{$check->registration->trainer->name}}</td>
            <td>{{$check->registration->memberPackage->duration_trainer}}</td>
            <td>{{$total}}</td>
            <td>{{$check->registration->created_at}}</td>
            <td>
                <div class="d-flex">
                <form action="{{ URL::to('check-status/' . $check->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Anda yakin ingin menghapus data ini {{ $check->name }}?')">Delete</button>
                </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection