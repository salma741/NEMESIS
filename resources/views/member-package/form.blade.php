@extends('layouts.main')
@section('container')

@if (isset($memberPackage))
<form action="{{ URL::to('member-package/' . $memberPackage->id)}}" method="POST" autocomplete="off">
@method('put')
@else
<form action="{{ URL::to('member-package')}}" method="POST" autocomplete="off">
@endif
@csrf
<div class="row">
    <div class="col-7">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control
            @error('name')is-invalid @enderror" value="{{ isset($memberPackage) ? $memberPackage->name : old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control
            @error('description')is-invalid @enderror" value="{{ isset($memberPackage) ? $memberPackage->description : old('description') }}">
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" class="form-control
            @error('price')is-invalid @enderror" value="{{ isset($memberPackage) ? $memberPackage->price : old('price') }}">
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="duration_day">Duration Day</label>
            <input type="text" id="duration_day" name="duration_day" class="form-control
            @error('duration_day')is-invalid @enderror" value="{{ isset($memberPackage) ? $memberPackage->duration_day : old('duration_day') }}">
            @error('duration_day')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="is_with_trainer">With Trainer</label>
            <select name="is_with_trainer" id="is_with_trainer" class="form-control
            @error('is_with_trainer')is-invalid @enderror">
                <option value="1" {{ isset($memberPackage) && $memberPackage->is_with_trainer ? "selected" : "" }}>Yes</option>
                <option value="0" {{ isset($memberPackage) && !$memberPackage->is_with_trainer ? "selected" : "" }}>No</option>
            </select>
            @error('is_with_trainer')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="duration_trainer">Duration Trainer</label>
            <input type="text" id="duration_trainer" name="duration_trainer" class="form-control
            @error('duration_trainer')is-invalid @enderror" value="{{ isset($memberPackage) ? $memberPackage->duration_trainer : old('duration_trainer') }}">
            @error('duration_trainer')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ URL::to('member-package/') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
</form>
@endsection
