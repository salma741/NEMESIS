@extends('landing-pages-layouts.main')
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

<div class="row">
    <div class="col-7">
        <div class="form-group">
            <label for="member_id">Nama</label>
            <select class="form-control @error('member_id')is-invalid @enderror" name="member_id" id="member_id" disabled>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $registration->member_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>    
                @endforeach
            </select>
            @error('member_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror                   
        </div> 
        
        <div class="form-group">
            <label for="member_package_id">Member Package</label>
            <select class="form-control @error('member_package_id')is-invalid @enderror" name="member_package_id" id="member_package_id" disabled>
                @foreach($memberPackages as $memberPackage)
                    <option value="{{ $memberPackage->id }}" {{ $registration->member_package_id == $memberPackage->id ? 'selected' : '' }}>{{ $memberPackage->name }}</option>    
                @endforeach
            </select>
            @error('member_package_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror                   
        </div> 

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" class="form-control @error('price')is-invalid @enderror" value="{{NumberFormat($registration->price)}}" readonly>
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror                   
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="text" id="start_date" name="start_date" class="form-control @error('start_date')is-invalid @enderror" value="{{ DateFormat($registration->start_date)}}" readonly>
            @error('start_date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror                   
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="text" id="end_date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ AddDay($registration->start_date, $registration->memberPackage->duration_day) }}" readonly>
            @error('end_date')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
    </div>
            @if($registration->trainer_id)
        <div class="form-group">
            <label for="trainer_id">Trainer</label>
            <select class="form-control @error('trainer_id') is-invalid @enderror" name="trainer_id" id="trainer_id" disabled>
                @foreach($trainers as $trainer)
                    <option value="{{ $trainer->id }}" {{ $registration->trainer_id == $trainer->id ? 'selected' : '' }}>
                        {{ $trainer->name }}
                    </option>
                @endforeach
            </select>
            @error('trainer_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        @endif


        <div class="form-group">
            <label for="user_id">Admin</label>
            <input type="text" id="user_id" name="user_id" class="form-control @error('user_id')is-invalid @enderror" value="{{ isset($registration->user) ? $registration->user->name : 'Self Registration' }}" readonly>
            @error('user_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror                   
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" id="status" name="status" class="form-control @error('status')is-invalid @enderror" value="{{$registration->status}}" readonly>
            @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror                   
        </div>
        <a href="{{ URL::to('registration-member') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

@endsection
