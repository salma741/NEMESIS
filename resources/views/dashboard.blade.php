@extends('layouts.main')
@section('container')

<h4>Selamat Datang, {{ auth()->user()->name }} di New Member Informatic System (NEMESIS)!</h4>
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $memberPackageCount}}</h3>

                <p>Member Packages</p>
              </div>
              <div class="icon">
                <i class="ion ion-card"></i>
              </div>
              @if (auth()->user()->role == 'super admin')
              <a href="{{ URL::to('member-package/') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endif
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3>{{ $trainerCount }}</h3>

                <p>Trainers</p>
                </div>
                <div class="icon">
                <i class="ion ion-person"></i>
                </div>
                @if (auth()->user()->role == 'super admin')
                <a href="{{ URL::to('trainer/') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @endif
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $userCount}}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              @if (auth()->user()->role == 'super admin')
              <a href="{{ URL::to('user/') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endif
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $registrationCount}}</h3>

                <p>Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              @if (auth()->user()->role == 'super admin')
              <a href="{{ URL::to('registration/') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endif
            </div>
          </div>
          <!-- ./col -->
        </div>
@endsection