@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-5">
    <div class="form-group">
                <label for="title">Name</label>
                <input type="text" id="title" name="title" class="form-control" 
                value="{{ $carousel->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <div>
                <img src="{{ URL::to('storage/' . $carousel->image) }}" alt="image" class="custom-image-size">
                </div>
            </div>
    <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" 
                value="{{ $carousel->description }}" readonly>
            </div>
    <a href="{{ URL::to('carousel/') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection