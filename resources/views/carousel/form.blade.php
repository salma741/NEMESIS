@extends('layouts.main')
@section('container')

@if (isset($carousel))
<form action="{{ URL::to('carousel/' . $carousel->id)}}" method="POST" autocomplete="off" enctype="multipart/form-data">
@method('put')
@else
<form action="{{ URL::to('carousel')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
@endif
@csrf
<div class="row">
    <div class="col-7">
    <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control
                @error('title')is-invalid @enderror" value="{{ isset($carousel)? $carousel->title : old('title') }}">
                 @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control
                @error('description')is-invalid @enderror" value="{{ isset($carousel)? $carousel->description : old('description')}}">
                @error('description')
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
            @if(isset($carousel))
                <img src="{{ URL::to('storage/' .$carousel->image) }}"  width="20%" alt="">
            @endif
        </div>   

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ URL::to('carousel/') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
</form>
@endsection