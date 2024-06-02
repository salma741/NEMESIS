@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-5">
    <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" 
                value="{{ $trainer->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <div>
                <img src="{{ URL::to('storage/' . $trainer->image) }}" alt="image" class="custom-image-size">
                </div>
            </div>
    <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" 
                value="{{ $trainer->description }}" readonly>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" 
                value="{{ $trainer->address }}" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" 
                value="{{ $trainer->phone }}" readonly>
            </div>
    <a href="{{ URL::to('trainer/') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection