@extends('layouts.main')
@section('container')

@if (isset($configuration))
<form action="{{ URL::to('configuration/' . $configuration->id)}}" method="POST" autocomplete="off">
@method('put')
@else
<form action="{{ URL::to('configuration')}}" method="POST" autocomplete="off">
@endif
@csrf
<div class="row">
    <div class="col-7">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control
            @error('name')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->name : old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control
            @error('address')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->address : old('address') }}">
            @error('address')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control
            @error('phone')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->phone : old('phone') }}">
            @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="map_link">Map Link</label>
            <input type="text" id="map_link" name="map_link" class="form-control
            @error('map_link')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->map_link : old('map_link') }}">
            @error('map_link')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ URL::to('configuration/') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
</form>
@endsection
