@extends('landing-pages-layouts.main')
@section('container')
<div class="main-button mb-3">
@if($hasRegistrations)
<a href="{{ URL::to('/registration-member') }}" class="btn btn-secondary">Your Registration</a>
@endif
</div>
<div class="row mt-10">
    <div class="col-5">
        <div class="form-group">
            <label for="image">Photo</label>
            <div>
                @if (Auth::check() && Auth::user()->image)
                    <img src="{{ URL::to('storage/' . Auth::user()->image) }}" alt="image" class="custom-image-size">
                @else
                    <p>No image available</p>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ Auth::user()->username }}" readonly>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ Auth::user()->address }}" readonly>
        </div>
        <div class="form-group">
            <label for="contact">Phone</label>
            <input type="text" id="contact" name="contact" class="form-control" value="{{ Auth::user()->contact }}" readonly>
        </div>
        <a href="{{ route('member-profile.edit') }}" class="btn btn-sm btn-warning mr-2">Edit</a>
        <a href="{{ URL::to('home') }}" class="btn btn-secondary btn-sm mr-2">Back</a>
    </div>
</div>
@endsection



