@extends('layouts.panel')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10 text-capitalize">Admin Details</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#!">admin details</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
@if(Session::has('fail'))
    <div class="alert alert-danger">
    {{Session::get('fail')}}
    </div>
@endif


<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="d-block text-center">
                    @if (isset($user->image))
                    <img src="{{ asset('images/students/'.$student->image) }}" class="img-radius" width="150" height="150"/>
                    @else
                        <img src="{{ asset('images/students/avtar.png') }}" class="img-radius" width="150" height="150"/>
                    @endif
                </div>
            </div>
            <div class="card-body text-center">
                <h5 class="text-capitalize text-center d-block m-t-10">{{$user->name}}</h5>
                <h6 class="text-capitalize text-center d-block m-t-10">[{{$user->email}}]</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="text-capitalize">Admin</h5>
                <div class="d-block">
                    <a href="" class="m-t-5 btn btn-info"><i class="feather icon-edit"></i> Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection