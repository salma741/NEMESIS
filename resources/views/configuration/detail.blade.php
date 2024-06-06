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
            <div class="form-group">
                <label for="motivation_1">Motivation 1</label>
                <input type="text" id="motivation_1" name="motivation_1" class="form-control" 
                value="{{ $configuration->motivation_1 }}" readonly>
            </div>
            <div class="form-group">
                <label for="motivation_2">Motivation 2</label>
                <input type="text" id="motivation_2" name="motivation_2" class="form-control" 
                value="{{ $configuration->motivation_2 }}" readonly>
            </div>
            <div class="form-group">
                <label for="paragraph_program">Paragraph Program</label>
                <input type="text" id="paragraph_program" name="paragraph_program" class="form-control" 
                value="{{ $configuration->paragraph_program }}" readonly>
            </div>
            <div class="form-group">
                <label for="paragraph_supplement">Paragraph Supplement</label>
                <input type="text" id="paragraph_supplement" name="paragraph_supplement" class="form-control" 
                value="{{ $configuration->paragraph_supplement }}" readonly>
            </div>
            <div class="form-group">
                <label for="paragraph_trainer">Paragraph Trainer</label>
                <input type="text" id="paragraph_trainer" name="paragraph_trainer" class="form-control" 
                value="{{ $configuration->paragraph_trainer }}" readonly>
            </div>
    <a href="{{ URL::to('configuration/') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection