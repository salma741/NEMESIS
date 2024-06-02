@extends('layouts.app')

@section('content')
<section class="section" id="schedule">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading dark-bg">
                    <h2>Member <em>Packages</em></h2>
                    <img src="assets/images/line-dec.png" alt="line decoration">
                    <p>Choose your member packages, now!</p>
                </div>
            </div>
        </div>
        <div class="row d-flex flex-wrap">
            @foreach ($memberPackages as $index => $memberPackage)
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $memberPackage->name }}</strong></h5>
                            <p class="card-text">{{ $memberPackage->description }}</p>
                            <p class="card-text">Rp {{ number_format($memberPackage->price) }}</p>
                            <p class="card-text">{{ $memberPackage->duration_day }} day</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
