@extends('layouts.main')
@section('container')

@if (isset($trainer))
<form action="{{ URL::to('trainer/' . $trainer->id)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
@method('put')
@else
<form action="{{ URL::to('trainer')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
@endif
@csrf
<div class="row">
    <div class="col-7">
    <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control
                @error('name')is-invalid @enderror" value="{{ isset($trainer)? $trainer->name : old('name') }}">
                 @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control
                @error('description')is-invalid @enderror" value="{{ isset($trainer)? $trainer->description : old('description')}}">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control
                @error('address')is-invalid @enderror" value="{{ isset($trainer)? $trainer->address : old('address') }}">
                 @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="phone" id="contact" name="phone" class="form-control
                @error('phone')is-invalid @enderror" value="{{ isset($trainer)? $trainer->phone : old('phone') }}">
                 @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid                        
            @enderror" placeholder="Image">
            @error('image') 
                <div class="invalid-feedback">
                {{ $message }}    
                </div>                   
            @enderror        
            
            @if(isset($trainer))
                <img src="{{ URL::to('storage/' .$trainer->image) }}"  width="20%" alt="">
            @endif
        </div>   

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ URL::to('trainer/') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
</form>
@endsection