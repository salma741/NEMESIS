@extends('landing-pages-layouts.main')
@section('container')
@include('sweetalert::alert')

<form id="filterForm" action="{{ URL::to('registration-member') }}" method="get">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <label for="startDate">Start Date</label>
                <input type="date" id="startDate" name="startDate" class="form-control" value="{{DateFormat($startDate, 'Y-MM-DD')}}" onchange="submitForm()">               
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label for="endDate">End Date</label>
                <input type="date" id="endDate" name="endDate" class="form-control" value="{{DateFormat($endDate, 'Y-MM-DD')}}" onchange="submitForm()">               
            </div>
        </div>
    </div>
</form>

<a href="{{ URL::to('registration-member/create') }}" class="btn btn-secondary mb-3">
    <i aria-hidden="true"></i> Add
</a>

<div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
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
            @foreach($registrations as $index => $registration)
             <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $registration->memberPackage->name }}</td>
                <td>{{ DateFormat($registration->start_date) }}</td>
                <td>{{ AddDay($registration->start_date, $registration->memberPackage->duration_day) }}</td>            
                <td>{{ isset($registration->trainer) ? $registration->trainer->name : '-' }}</td>
                <td>{{ NumberFormat($registration->price) }}</td>    
                <td>{{ isset($registration->user) ? $registration->user->name : 'Self Registration' }}</td>                               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function submitForm() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (startDate && endDate) {
            document.getElementById('filterForm').submit();
        }
    }
</script>

@endsection
