@extends('layouts.panel')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10 text-capitalize">Edit course</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">course</a></li>
                    <li class="breadcrumb-item"><a href="#!">Edit course</a></li>
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
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="text-capitalize">Edit course</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('update_course')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{__('Name')}}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter Name" name="name" value="{{ isset($course->name) ? $course->name : '' }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Fees')}}</label>
                            <input type="number" class="form-control @error('fee') is-invalid @enderror"  placeholder="Enter Fee" name="fee" value="{{ isset($course->fees) ? $course->fees : '' }}">
                            @error('fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label>{{__('Upload Image')}}</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <img src="{{ asset('/images/course/'.$course->image) }}" height="100" width="100" class="p-2 border rounded"/>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn  btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection