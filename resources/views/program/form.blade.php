@extends('layouts.main')
@section('container')

@if (isset($program))
<form action="{{ URL::to('program/' . $program->id)}}" method="POST" autocomplete="off">
@method('put')
@else
<form action="{{ URL::to('program')}}" method="POST" autocomplete="off">
@endif
@csrf
<div class="row">
    <div class="col-7">
    <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control
                @error('title')is-invalid @enderror" value="{{ isset($program)? $program->title : old('title') }}">
                 @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control
                @error('description')is-invalid @enderror" value="{{ isset($program)? $program->description : old('description')}}">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ URL::to('program/') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
</form>
@endsection