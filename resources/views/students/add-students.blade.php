@extends('layouts.panel')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10 text-capitalize">students list</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">students</a></li>
                    <li class="breadcrumb-item"><a href="#!">students list</a></li>
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
                <h5 class="text-capitalize">add students</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('store_students')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{__('Name')}}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter Name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Father Name')}}</label>
                            <input type="text" class="form-control @error('father_name') is-invalid @enderror"  placeholder="Enter Father Name" name="father_name" value="{{ old('father_name') }}">
                            @error('father_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Email address')}}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Phone Number')}}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"  placeholder="Enter phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Select Course') }}</label>
                            <select class="form-control text-capitalize @error('course') is-invalid @enderror" name="course" id="course">
                                @if (count($courses)>0)
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endforeach
                                @else
                                <option value="" selected>You Need to add curses!</option>
                                @endif
                            </select>
                            @error('course')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Select Batch') }}</label>
                            <select class="form-control @error('batch') is-invalid @enderror" name="batch" id="batch">
                                <option value="">Select Batch</option>
                            </select>
                            @error('batch')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Address') }}</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" type="text" rows="1" name="address"></textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Date of Birth')}}</label>
                            <input type="text" class="form-control datepicker @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6" id="image_div">
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
                        <div class="form-group col-md-6">
                            <label class="d-block">{{__('Demo ')}}</label>
                            <div class="d-flex m-b-5 align-items-center">
                                <label class="switch m-r-5 m-b-0">
                                    <input type="radio" checked name="demo_class" value="0">
                                    <span class="slider round"></span>
                                </label>
                                <div>No Demo</div>
                            </div>
                            <div class="d-flex m-b-5 align-items-center">
                                <label class="switch m-r-5 m-b-0">
                                    <input type="radio" name="demo_class" value="1">
                                    <span class="slider round"></span>
                                </label>
                                <div>Demo Ongoing</div>
                            </div>
                            <div class="d-flex m-b-5 align-items-center">
                                <label class="switch m-r-5 m-b-0">
                                    <input type="radio" name="demo_class" value="2">
                                    <span class="slider round"></span>
                                </label>
                                <div>Demo Completed</div>
                            </div>
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
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}"/>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script>
    $(document).find(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
    $(document).on('change', '#course', function(){
        fetch('{{url("course-batch-list")}}/'+ $(this).val()).then(async (res)=>{
            let data = await res.json();
            console.log(data);
            if(data.sts ==  false){
                Swal.fire({
                    title: 'Oops?',
                    text: data.msg,
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay!'
                })
            }else{
                $('#batch').html();
                let options = `<option value="">Select Batchs</option>`;
                for(let x in data.batch){
                    options += `<option value="${data.batch[x].id}">${data.batch[x].name} [${data.batch[x].from} -- ${data.batch[x].to}]</option>`
                }
                $('#batch').html(options);
            }
        }).catch((err)=>{
            console.log(err);
        })
    })
</script>
@endpush