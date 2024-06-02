@extends('layouts.main')
@section('container')

@if (isset($user))
<form action="{{ URL::to('user/' . $user->id)}}" method="POST" autocomplete="off">
@method('put')
@else
<form action="{{ URL::to('user')}}" method="POST" autocomplete="off">
@endif
@csrf
<div class="row">
    <div class="col-7">
    <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control
                @error('name')is-invalid @enderror" value="{{ isset($user)? $user->name : old('name') }}">
                 @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control
                @error('username')is-invalid @enderror" value="{{ isset($user)? $user->username : old('username')}}">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control
                @error('password')is-invalid @enderror" >

                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
    </div>
    <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control
                @error('address')is-invalid @enderror" value="{{ isset($user)? $user->address : old('address') }}">
                 @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="contact">Phone</label>
                <input type="contact" id="contact" name="contact" class="form-control
                @error('contact')is-invalid @enderror" value="{{ isset($user)? $user->contact : old('contact') }}">
                 @error('contact')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control
                @error('role')is-invalid @enderror">
                    <option value="member" {{ isset($user)? ($user->role === 'member'? " selected" : "") : ""}}>Member</option>
                    <option value="super admin" {{ isset($user)? ($user->role === 'super admin'? " selected" : "") : ""}}>Super Admin</option>
                    <option value="admin" {{ isset($user)? ($user->role === 'admin'? "selected" : "") : ""}}>Admin</option>
                </select>
                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ URL::to('user/') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
</form>
@endsection