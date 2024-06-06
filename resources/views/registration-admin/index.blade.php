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

<a href="{{ URL::to('registration-admin/create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus" aria-hidden="true"></i> Add
</a>

<table id="datatable1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Name</th>
            <th>Member Package</th>
            <th>Start Date</th>
            <th>End Date</th>        
            <th>Trainer</th>
            <th>Price</th>     
            <th>Admin</th> 
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
    @foreach($registrations as $index => $registration )
         <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $registration->member_name }}</td>
            <td>{{ $registration->memberPackage->name }}</td>
            <td>{{ $registration->start_date_formatted }}</td>
            <td>{{ Carbon\Carbon::parse($registration->start_date)->addDays($registration->memberPackage->duration_day)->format('d-m-Y H:i:s') }}</td>           
            <td>{{ isset($registration->trainer)? $registration->trainer->name : "-" }}</td>
            <td>{{ $registration->price }}</td>    
            <td>{{ isset($registration->user)? $registration->user->name : "Self Registration" }}</td>   
            <td>
                <div class="d-flex">
                    <a href="{{ URL::to('registration-admin/' . $registration->id) }}" class="btn btn-sm btn-info mr-2">Show</a>
                    <a href="{{ URL::to('registration-admin/' . $registration->id . '/edit') }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                        
                    </div>
            </td>                            
        </tr>
        @endforeach
       
    </tbody>
</table>
@endsection
