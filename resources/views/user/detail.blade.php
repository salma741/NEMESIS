@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-5">
    <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" 
                value="{{ $user->name }}" readonly>
            </div>
    <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" 
                value="{{ $user->username }}" readonly>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" 
                value="{{ $user->address }}" readonly>
            </div>
            <div class="form-group">
                <label for="contact">Phone</label>
                <input type="text" id="contact" name="contact" class="form-control" 
                value="{{ $user->contact }}" readonly>
            </div>
    <div class="form-group">
                <label for="role">Role</label>
                <input type="text" id="role" name="role" class="form-control" 
                value="{{ $user->role }}" readonly>
    </div>
    <a href="{{ URL::to('user/') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection