@extends('landing-pages-layouts.main')
@section('container')
@include('sweetalert::alert')
<div style="overflow-x: auto;">
<table id="datatable1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Registration Member</th>
        <th>Customer Name</th>
        <th>Trainer Name</th>
        <th>Trainer Duration</th>
        <th>Check In Date</th>
    </tr>
    </thead>
    <tbody>
        @foreach($checkstatuss as $index => $check )

         <tr>
            <td>{{ $index + 1 }}</td>
            <td class="align-middle">{{$check->registration->memberPackage->name }}</td>
            <td>{{$check->registration->member->name }}</td>
            <td>{{$check->registration->trainer->name}}</td>
            <td>{{$check->registration->memberPackage->duration_trainer}}</td>
            <td>{{DateFormat ($check->registration->created_at)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection