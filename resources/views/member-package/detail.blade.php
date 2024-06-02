@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-5">
    <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" 
                value="{{ $memberPackage->name }}" readonly>
            </div>
    <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control" 
                value="{{ $memberPackage->description }}" readonly>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" 
                value="{{ NumberFormat($memberPackage->price) }}" readonly>
             </div>
   
            <div class="form-group">
                <label for="duration_day">Duration Day</label>
                <input type="text" id="duration_day" name="duration_day" class="form-control" 
                value="{{ $memberPackage->duration_day }}" readonly>
            </div>
    <div class="form-group">
                <label for="is_with_trainer">With Trianer</label>
                <input type="text" id="is_with_trainer" name="is_with_trainer" class="form-control" 
                value="{{ $memberPackage->is_with_trainer }}" readonly>
    </div>
    <div class="form-group">
                <label for="duration_trainer">Duration Day</label>
                <input type="text" id="duration_trainer" name="duration_trainer" class="form-control" 
                value="{{ $memberPackage->duration_trainer }}" readonly>
            </div>
    <a href="{{ URL::to('member-package/') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection