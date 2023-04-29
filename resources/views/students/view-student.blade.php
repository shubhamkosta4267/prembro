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
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="d-block text-center">
                    <img src="{{ asset('images/students/'.$student->image) }}" class="img-radius" width="150" height="150"/>
                </div>
            </div>
            <div class="card-body text-center">
                <h5 class="text-capitalize text-center d-block m-t-10">{{$student->name}}</h5>
                <h6 class="text-capitalize text-center d-block m-t-10">[{{$student->email}}]</h6>
                <h6 class="text-capitalize text-center d-block m-t-10">[{{$student->phone}}]</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="text-capitalize">students</h5>
                <div class="d-block">
                    <a href="{{route('edit_student', request()->id)}}" class="m-t-5 btn btn-info"><i class="feather icon-edit"></i> Student</a>
                    <button type="button" class="m-t-5 btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg" data-whatever="@mdo"><i class="feather icon-edit"></i> Update Fees</button>
                    <button type="button" class="m-t-5 btn btn-info" data-toggle="modal" data-target="#installmentModal" data-whatever="@mdo"><i class="feather icon-plus"></i> Make Installment</button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12 table-responsive p-0">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="w-50">date of birth</th>
                                <td>{{$student->date_of_birth}}</td>
                            </tr>
                            <tr>
                                <th>Father Name</th>
                                <td>{{$student->father_name}}</td>
                            </tr>
                            <tr>
                                <th>address</th>
                                <td>{{$student->address}}</td>
                            </tr>
                            <tr>
                                <th>Current submitted fees</th>
                                <td>{{$student->fees}}</td>
                            </tr>
                            <tr>
                                <th>Current total fees</th>
                                <td>{{$student->total_fees != "" ? $student->total_fees : 0 }}</td>
                            </tr>
                            <tr>
                                <th>Demo</th>
                                <td>
                                    @if ($student->demo == 1)
                                        <span class="text-capitalize badge badge-pill badge-info">Ongoing</span>
                                    @elseif ($student->demo == 0)
                                        <span class="text-capitalize badge badge-pill badge-warning">no progress</span>
                                    @elseif ($student->demo == 2)
                                        <span class="text-capitalize badge badge-pill badge-success">Completed</span>
                                    @endif    
                                </td>
                            </tr>
                            <tr>
                                <th>status</th>
                                <td>
                                    @if ($student->status == 1)
                                        <span class="text-capitalize badge badge-pill badge-success">Joined</span>
                                    @elseif ($student->status == 0)
                                        <span class="text-capitalize badge badge-pill badge-warning">no progress</span>
                                    @endif    
                                </td>
                            </tr>
                            <tr>
                                <th>Current payment status</th>
                                <td>
                                    @if ($student->payment_status == 1)
                                        <span class="text-capitalize badge badge-pill badge-success">completed</span>
                                    @elseif ($student->payment_status == 0)
                                        <span class="text-capitalize badge badge-pill badge-warning">Pending</span>
                                    @endif    
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-0">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="text-capitalize">Course Info</h5>
                <button type="button" class="m-t-5 btn btn-info" data-toggle="modal" data-target="#assignCourseModel" data-whatever="@mdo"><i class="feather icon-plus"></i> Assign Course</button>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                @if (count($courses)>0 && $courses!="")
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-capitalize">Image</th>
                                <th class="text-capitalize">course</th>
                                <th class="text-capitalize">batch</th>
                                <th class="text-capitalize">status</th>
                                <th class="text-capitalize">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td class="text-capitalize">
                                        <img src="{{ asset('images/course/'.courseInfo($course->course_id)->image) }}" class="img-radius border-secondary" width="40" />
                                    </td>
                                    <td>{{ courseInfo($course->course_id)->name }}</td>
                                    <td>{{ batchInfo($course->batch_id)->name }}</td>
                                    <td>
                                        @if ($course->status == 0)
                                            <span class="text-capitalize badge badge-pill badge-primary">in progress</span>
                                            @else
                                            <span class="text-capitalize badge badge-pill badge-success">completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <label class="switch update_course m-r-5 m-b-0">
                                            <input type="radio" {{ $course->status == 1 ? 'checked' : '' }} name="demo_class" id="demo_class" value="{{$course->id}}">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger" role="alert">
                        No record found!
                    </div>
                @endif 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-0">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="text-capitalize">Installments Info</h5>
                <button type="button" class="m-t-5 btn btn-info" data-toggle="modal" data-target="#installmentModal" data-whatever="@mdo"><i class="feather icon-plus"></i> Make Installments</button>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                @if (count($installments)>0 && $installments!="")
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-uppercase">Image</th>
                                <th class="text-uppercase">installment date</th>
                                <th class="text-capitalize">installment</th>
                                <th class="text-uppercase">status</th>
                                <th class="text-uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($installments as $installment)
                                <tr>
                                    <td>{{ $installment->id }}</td>
                                    <td class="text-capitalize">
                                        @if ($installment->screenshot != null)
                                            <img src="{{ asset('images/students/installment/'.$installment->screenshot) }}" class="img-radius border-secondary" width="40" />
                                        @else
                                        ---
                                        @endif
                                    </td>
                                    <td>{{ $installment->installment_date }}</td>
                                    <td>{{ $installment->payment }}</td>
                                    <td>
                                        @if ($installment->status == 0)
                                            <span class="text-capitalize badge badge-pill badge-warning">pending</span>
                                        @else
                                            <span class="text-capitalize badge badge-pill badge-success">completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <label class="switch update_installment m-r-5 m-b-0">
                                            <input type="checkbox" {{ $installment->status == 1 ? 'checked' : '' }} value="{{$installment->id}}">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger" role="alert">
                        No record found!
                    </div>
                @endif 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Update Student Fees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="batch_form" method="post">
                <input type="hidden" name="student_id" value="{{ request()->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6" id="fees_div">
                            <label>{{__('Fees')}}</label>
                            <input type="number" class="form-control" name="fees" value="{{ old('fees') }}" placeholder="Enter Fees">
                        </div>

                        <div class="form-group col-md-6" id="fees_div">
                            <label>{{__('Total Fees')}}</label>
                            <input type="number" class="form-control" name="total_fees" value="{{ old('total_fees') }}" placeholder="Enter Total Fees">
                        </div>

                        <div class="form-group col-md-6">
                            <label>{{__('Courses')}}</label>
                            <select class="form-control" id="all_course">
                                <option value="">Select Course Fee</option>
                                @foreach ($courses_list as $course)
                                <option value="{{$course->fees}}">{{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{__('Payment Status')}}</label>
                            <select class="form-control" name="payment_status">
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="add_fees">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="assignCourseModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Assin Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="course_form" method="post">
                <input type="hidden" name="student_id" value="{{ request()->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{ __('Select Course') }}</label>
                            <select class="form-control text-capitalize @error('course') is-invalid @enderror" name="course" id="course">
                                @if (count($courses_list)>0)
                                    <option value="">Select Course</option>
                                    @foreach ($courses_list as $course)
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="add_fees">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="installmentModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Make Installment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="installmet_form" method="post">
                <input type="hidden" name="student_id" value="{{ request()->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{__('Installments')}}</label>
                            <select class="form-control" name="select_installment" id="select_installment">
                                <option value="">Select Installments</option>
                                <option value="2">Two Installments</option>
                                <option value="1">One Installments</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="fees_div">
                            <label>{{__('Permonth Installment')}}</label>
                            <input type="number" class="form-control" name="permonth_instalment" value="{{ old('permonth_instalment') }}" placeholder="Enter Permonth Installment">
                        </div>
                        <div class="form-group col-md-6" id="installment_date">
                            <label for="title">Installment Date:</label>
                            <input type="text" name="installment_date" class="form-control datepicker" placeholder="Enter Installment Date" id="">
                        </div>
                        <div class="form-group col-md-6" id="fees_div">
                            <label>{{__('Payment Mode')}}</label>
                            <select class="form-control" name="payment_mode">
                                <option value="">Select Payment Mode</option>
                                <option value="cash">Cash</option>
                                <option value="phone pe">Phone Pe</option>
                                <option value="google pay">Google Pay</option>
                                <option value="paytm">Paytm</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Upload Referece Image (UPI Screenshots)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" value="">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>                          
                        </div>
                        <div class="form-group col-md-12">
                            <label>Installment Remark</label>
                            <textarea rows="2" name="remark" class="form-control"></textarea>                         
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="add_fees">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<link rel="stylesheet" href="{{ asset('assets/css/mdtimepicker.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}"/>

<script src="{{ asset('assets/js/mdtimepicker.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>

<script>
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
    $('#all_course').change(function(){
        $('input[name="total_fees"]').val($(this).val());
    })
    $(document).find(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

    $('#select_installment').on('change', function(){
        if(this.value == 2){
            let el = `<div class="form-group col-md-6" id="installment_date_second">
                    <label for="title">Second Installment Date:</label>
                    <input type="text" name="second_installment_date" class="form-control datepicker" placeholder="Enter Installment Date">
                </div>`;
            $('#installment_date').after(el);
            $(document).find(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
        }else{
            $(document).find('#installment_date_second').remove();
        }
    });

    $('#batch_form').on('submit', function(e){
        e.preventDefault();
        fetch('{{route("update_payment")}}', {
            method:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body:new FormData(this)
        }).then(async (res)=>{
            let data = await res.json();
            console.log(data);
            if(data.sts ==  false){
                toastr.error(data.msg);
            }else{
                $('.bd-example-modal-lg').modal('hide');
                Swal.fire({
                    title: 'Awesome?',
                    text: data.msg,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay, Great!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                })
            }
        }).catch((err)=>{
            console.log(err);
        })
    });

    $('#course_form').on('submit', function(e){
        e.preventDefault();
        fetch('{{route("assign_course")}}', {
            method:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body:new FormData(this)
        }).then(async (res)=>{
            let data = await res.json();
            if(data.sts ==  false){
                toastr.error(data.msg);
            }else{
                $('#course_form').modal('hide');
                Swal.fire({
                    title: 'Awesome?',
                    text: data.msg,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay, Great!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                })
            }
        }).catch((err)=>{
            console.log(err);
        })
    });

    $('#installmet_form').on('submit', function(e){
        e.preventDefault();
        fetch('{{route("make_installment")}}', {
            method:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body:new FormData(this)
        }).then(async (res)=>{
            let data = await res.json();
            console.log(data);
            if(data.sts ==  false){
                toastr.error(data.msg);
            }else{
                $('.bd-example-modal-lg').modal('hide');
                Swal.fire({
                    title: 'Awesome?',
                    text: data.msg,
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay, Great!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                })
            }
        }).catch((err)=>{
            console.log(err);
        })
    })

    $(document).on('click', '.update_installment', function(){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this installment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Continue...!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).find('input').trigger('change');
                let input = $(this).find('input').val();
                fetch('{{url("update-installment")}}/'+input, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                }).then(async (res)=>{
                    let data = await res.json();
                    console.log(data);
                    if(data.sts ==  false){
                        $(this).find('input').prop('checked', false);
                        toastr.error(data.msg);
                    }else{
                        $('.bd-example-modal-lg').modal('hide');
                        Swal.fire({
                            title: 'Awesome?',
                            text: data.msg,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Okay, Great!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                }).catch((err)=>{
                    console.log(err);
                })
            }else{
                $(this).find('input').prop('checked', false);
            }
        });
    })

    $(document).on('click', '.update_course', function(){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this course?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Continue...!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).find('input').trigger('change');
                let input = $(this).find('input').val();
                fetch('{{url("student-course-update")}}/'+input, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                }).then(async (res)=>{
                    let data = await res.json();
                    console.log(data);
                    if(data.sts ==  false){
                        $(this).find('input').prop('checked', false);
                        toastr.error(data.msg);
                    }else{
                        Swal.fire({
                            title: 'Awesome?',
                            text: data.msg,
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Okay, Great!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                }).catch((err)=>{
                    console.log(err);
                })
            }else{
                $(this).find('input').prop('checked', false);
            }
        });
    })
</script>
@endpush