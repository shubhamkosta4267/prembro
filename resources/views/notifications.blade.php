@extends('layouts.panel')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10 text-capitalize">Notifications</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashobard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Notifications</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-md-12">
        @if (count($notification)>0)
            @foreach ($notification as $item)
                <div class="alert alert-danger">
                    <p class="m-0"><strong class="text-capitalize h5 fw-bold">{{$item->name}}</strong></p>
                    <div class="m-0 d-flex align-items-center justify-content-between">
                        <strong class="">Pending payment of rs.{{$item->payment}}/.</strong>
                       
                        <span class="">{{date('d F Y', strtotime($item->installment_date))}}</span>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info"><strong class="h5">No any notifications!</strong></div>
        @endif
    </div>
</div>
<!-- [ Main Content ] start -->
@if(Session::has('fail'))
    <div class="alert alert-danger">
    {{Session::get('fail')}}
    </div>
@endif
@endsection