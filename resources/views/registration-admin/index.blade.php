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
<form method="GET" action="{{ URL::to('registration-admin') }}">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{DateFormat($startDate, "Y-MM-DD")}}">               
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{DateFormat($endDate, "Y-MM-DD")}}">               
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="active_status">Status</label>
                <select id="active_status" name="active_status" class="form-control">
                    <option value="all" {{ $activeStatus == 'all' ? 'selected' : '' }}>All</option>
                    <option value="active" {{ $activeStatus == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $activeStatus == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-2 mt-3">
            <button type="submit" class="btn btn-primary" style="margin-top: 16px;">Filter</button>
        </div>            
    </div>
</form>

<a href="{{ URL::to('registration-admin/create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus" aria-hidden="true"></i> Add
</a>

<table id="datatable1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Name</th>
            <th>Member Package</th>
            <th>Date</th>      
            <th>Price</th>     
            <th>Admin</th> 
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
    @foreach($registrations as $index => $registration )
    <?php 
        $lastTrainingSessionCount = $registration->duration_trainer - $registration->total_check_in_trainer;
    ?>
         <tr>
            <td class="align-middle">{{ $index + 1 }}</td>
            <td class="align-middle">{{ $registration->member_name }}</td>
            <td class="align-middle">{{ $registration->member_package_name }} {{ $registration->trainer_name? "(". $registration->trainer_name. " => ". $lastTrainingSessionCount ." of ".  $registration->duration_trainer . ")" : "" }}</td>
            <td class="text-center">{{ DateFormat($registration->start_date) }} s/d <br/> {{ DateFormat($registration->end_date)}}</td>           
            <td class="align-middle">{{ NumberFormat($registration->price) }}</td>    
            <td class="align-middle">{{ $registration->admin_name? $registration->admin_name : "Self Registration" }}</td>   
            <td class="align-middle">
                <div class="d-flex flex-wrap">
                    <a href="{{ URL::to('registration-admin/' . $registration->id) }}" class="btn btn-sm btn-info btn-width mr-2 mb-2">Show</a>
                    <a href="{{ URL::to('registration-admin/' . $registration->id . '/edit') }}" class="btn btn-sm btn-warning btn-width mr-2 mb-2">Edit</a>
                    <form action="{{ URL::to('registration-admin/' . $registration->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger btn-width mr-2 mb-2"
                        onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</button>
                    </form>
                    @if($registration->can_check_in < 0 )
                    <form action="{{ URL::to('check-in') }}" method="post">
                        @csrf
                        <input type="hidden" name="registration_id" value="{{$registration->id}}">
                        <button type="submit" class="btn btn-sm btn-success btn-width mr-2 mb-2">Check In</button>
                    </form>
                    @if($lastTrainingSessionCount > 0)
                    <form action="{{ URL::to('check-in-trainer') }}" method="post">
                        @csrf
                        <input type="hidden" name="registration_id" value="{{$registration->id}}">
                        <button type="submit" class="btn btn-sm btn-outline-success btn-width mr-2 mb-2">Check In Trainer</button>
                    </form>
                    @endif
                    @endif
                </div>
            </td>                 
        </tr>
        @endforeach
    </tbody>
</table>
<style>
.btn-width {
    min-width: 100px;
    text-align: center;
}
</style>
@endsection

