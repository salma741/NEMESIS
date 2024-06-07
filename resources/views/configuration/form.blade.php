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
        <div class="form-group">
            <label for="motivation_1">Motivation 1</label>
            <input type="text" id="motivation_1" name="motivation_1" class="form-control
            @error('motivation_1')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->motivation_1 : old('motivation_1') }}">
            @error('motivation_1')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="motivation_2">Motivation 2</label>
            <input type="text" id="motivation_2" name="motivation_2" class="form-control
            @error('motivation_2')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->motivation_2 : old('motivation_2') }}">
            @error('motivation_2')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="paragraph_program">Paragraph Program</label>
            <input type="text" id="paragraph_program" name="paragraph_program" class="form-control
            @error('paragraph_program')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->paragraph_program : old('paragraph_program') }}">
            @error('paragraph_program')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="paragraph_supplement">Paragraph Supplement</label>
            <input type="text" id="paragraph_supplement" name="paragraph_supplement" class="form-control
            @error('paragraph_supplement')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->paragraph_supplement : old('paragraph_supplement') }}">
            @error('paragraph_supplement')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="paragraph_trainer">Paragraph Trainer</label>
            <input type="text" id="paragraph_trainer" name="paragraph_trainer" class="form-control
            @error('paragraph_trainer')is-invalid @enderror" value="{{ isset($configuration) ? $configuration->paragraph_trainer : old('paragraph_trainer') }}">
            @error('paragraph_trainer')
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
