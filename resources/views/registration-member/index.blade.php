@extends('landing-pages-layouts.main')
@section('container')
@include('sweetalert::alert')
<div class="main-button mb-3">
    <a href="{{ route('member-profile') }}" class="btn btn-secondary">Back</a>
    <a href="{{ URL::to('registration-member/create') }}" class="btn btn-secondary">Add</a>
</div>

<table class="table" width="100%">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th>Member Package</th>
        <th>Start Date</th>
        <th>End Date</th>        
        <th>Trainer</th>
        <th>Price</th>     
        <th>Admin</th>           
    </tr>
    </thead>
    <tbody>
        @foreach($registrations as $index => $registration )
         <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $registration->memberPackage->name }}</td>
            <td>{{DateFormat ($registration->start_date)}}</td>
            <td>{{AddDay($registration->start_date, $registration->memberPackage->duration_day)}}
            </td>            
            <td>{{ isset($registration->trainer)? $registration->trainer->name : "-" }}</td>
            <td>{{ NumberFormat($registration->price) }}</td>    
            <td>{{ isset($registration->user)? $registration->user->name : "Self Registration" }}</td>                               
        </tr>
        @endforeach
    </tbody>
</table>


@endsection