@extends('layouts.panel')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10 text-capitalize">Edit student</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">students</a></li>
                    <li class="breadcrumb-item"><a href="#!">edit student</a></li>
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
                <h5 class="text-capitalize">edit students</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('update_students')}}" enctype="multipart/form-data">
                    @csrf
                    @if (isset(request()->id))
                        <input type="hidden" name="id" value="{{request()->id}}"/>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{__('Name')}}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter Name" name="name" value="{{ $student->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Father Name')}}</label>
                            <input type="text" class="form-control @error('father_name') is-invalid @enderror"  placeholder="Enter Father Name" name="father_name" value="{{ $student->father_name }}">
                            @error('father_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Email address')}}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter email" name="email" value="{{ $student->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Phone Number')}}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"  placeholder="Enter phone" name="phone" value="{{ $student->phone }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Address') }}</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" type="text" rows="1" name="address">{{ $student->address }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Date of Birth')}}</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $student->date_of_birth }}">
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Upload Image')}}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile01" name="image" value="{{ old('image') }}">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                        <div class="form-group col-md-12">
                            <label class="d-block">{{__('Demo ')}}</label>
                            @if ($student->demo == 2)
                                <label class="d-block text-success">{{__('Demo Completed')}}</label>
                            @else
                                <div class="d-flex align-items-center m-b-5">
                                    <label class="switch m-r-5 m-b-0">
                                        <input type="radio" {{ $student->demo == 1 ? 'checked' : ''  }} name="demo_class" id="demo_class" value="{{$student->demo}}">
                                        <span class="slider round"></span>
                                    </label>
                                    <div>Demo Ongoing</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label class="switch m-r-5 m-b-0">
                                        <input type="radio" {{ $student->demo == 2 ? 'checked' : ''  }} name="demo_class" id="demo_class" value="2">
                                        <span class="slider round"></span>
                                    </label>
                                    <div>Demo Completed</div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn  btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    
</script>
@endpush