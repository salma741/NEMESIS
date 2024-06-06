@extends('layouts.main')
@section('container')

@if (isset($registration))
<form action="{{ URL::to('registration-admin/' . $registration->id)}}" method="POST" autocomplete="off">
@method('put')
@else
<form action="{{ URL::to('registration-admin')}}" method="POST" autocomplete="off">
@endif
@csrf
<div class="row">
    <div class="col-7">
    <div class="form-group">
        <label for="member_id">Name</label>
        <select class="form-control  @error('member_id')is-invalid @enderror" name="member_id" id="member_id">
            <option value="" selected>Silahkan pilih nama member</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ (old('member_id') ?? $registration->member_id ?? '') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>    
            @endforeach
        </select>

        @error('member_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror                   
    </div> 
    
        <div class="form-group">
            <label for="member_package_id">Member Package</label>
            <select onChange="selectMemberPackage({{$memberPackages}})" class="form-control  @error('member_package_id')is-invalid @enderror" name="member_package_id" id="member_package_id">
                <option value="" selected>Silahkan pilih paket</option>
                @foreach($memberPackages as $memberPackage)
                    <option value="{{ $memberPackage->id }}" {{ (old('member_package_id') ?? $registration->member_package_id ?? '') == $memberPackage->id ? 'selected' : '' }}>{{ $memberPackage->name }}</option>    
                @endforeach
            </select>

            @error('member_package_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror                   
        </div> 
        <div class="form-group">
            <label for="name">Price</label>
            <input type="text" id="price" name="price" class="form-control  @error('price')is-invalid @enderror" value="{{ old('price') ?? $registration->price ?? '' }}" readonly>

            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror                   
        </div>

        <div id="trainer_div" class="form-group" style="{{ (old('is_with_trainer') ?? $registration->is_with_trainer ?? '') == 1 ? '' : 'display:none' }}">
    <label for="trainer_id">Member Trainer</label>
    <select class="form-control @error('trainer_id')is-invalid @enderror" name="trainer_id" id="trainer_id">
        @foreach($trainers as $trainer)
            <option value="{{ $trainer->id }}" {{ (old('trainer_id') ?? $registration->trainer_id ?? '') == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>    
        @endforeach
    </select>
</div>
 
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ URL::to('registration-admin/') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    </form>

<script>
    const selectMemberPackage = (memberPackages) =>{
        const mySelect = document.getElementById('member_package_id');
        const myPrice = document.getElementById('price');      
        const trainerDiv = document.getElementById('trainer_div');                 
        const selectedIndex = mySelect.selectedIndex;
        myPrice.value =  memberPackages[selectedIndex - 1].price;

        if(memberPackages[selectedIndex - 1].is_with_trainer == 1){
            trainerDiv.style.display = "block";
        }else{
            trainerDiv.style.display = "none";
        }
    }
</script>
@endsection
