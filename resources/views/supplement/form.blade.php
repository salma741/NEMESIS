@extends('layouts.main')
@section('container')

@if (isset($supplement))
<form action="{{ URL::to('supplement/' . $supplement->id)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
@method('put')
@else
<form action="{{ URL::to('supplement')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
@endif
@csrf
<div class="row">
    <div class="col-7">
    <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control
                @error('title')is-invalid @enderror" value="{{ isset($supplement)? $supplement->title : old('title') }}">
                 @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control
                @error('description')is-invalid @enderror" value="{{ isset($supplement)? $supplement->description : old('description')}}">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" class="form-control @error('image')is-invalid @enderror" 
                    value="{{ isset($supplement)? $supplement->image : old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    @if ( isset($supplement))
                    <img src="{{ URL::to('storage/' . $supplement->image)}}" 
                    alt="image" width="20%">
                    
                    @endif
                </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ URL::to('supplement/') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
</form>
@endsection