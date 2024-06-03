@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-5">
    <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" 
                value="{{ $configuration->name }}" readonly>
            </div>
    <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" 
                value="{{ $configuration->address }}" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" id="phone" name="phone" class="form-control" 
                value="{{ $configuration->phone }}" readonly>
             </div>
   
            <div class="form-group">
                <label for="map_link">Map Link</label>
                <input type="text" id="map_link" name="map_link" class="form-control" 
                value="{{ $configuration->map_link }}" readonly>
            </div>
    <a href="{{ URL::to('map/') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection