@extends('layouts.panel')
@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 text-capitalize">{{ $course->name }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">courses</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ $course->name }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    @if(Session::has('success'))
        <div class="alert alert-success">
        {{Session::get('success')}}
        </div>
    @endif
    <!-- [ stiped-table ] start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="d-block">
                        <h5 class="text-capitalize">{{ $course->name }}</h5>
                        <span class="d-block m-t-5">You are able to view list of batch in [{{ $course->name }}]</span>
                    </div>
                    <div class="d-block">
                        <button type="button" class="btn  btn-info">Total Students <span class="badge badge-light">{{ countCourseStudent($course->id) }}</span></button>
                        <button  type="button" class="btn btn-primary m-r-5 modal_btn" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo"><i class="feather icon-plus"></i> Add Batch</button>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                    @if (count($course->batch)>0)
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>sr. no.</th>
                                    <th>Name</th>
                                    <th>Start</th>
                                    <th>end</th>
                                    <th>Total Students</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($course->batch as $batch)
                                <tr>
                                    <td>{{ $count++; }}</td>
                                    <td class="text-capitalize">{{$batch->name}}</td>
                                    <td><span class="badge badge-light-info">{{$batch->from}}</span></td>
                                    <td><span class="badge badge-light-success">{{$batch->to}}</span></td>
                                    <td>
                                        <button type="button" class="btn  btn-info">Students <span class="badge badge-light">{{countBatchStudent($batch->id)}}</span></button></td>
                                    <td class="d-flex">
                                        <a href="javascript:;" class="btn btn-icon btn-primary m-r-5 edit_batch" data-id="{{ $batch->id }}"><i class="feather icon-edit"></i></a>
                                        <button data-id="{{ $batch->id }}" type="button" class="btn btn-icon btn-danger m-r-5 modal_btn delete_batch"><i class="feather icon-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger" role="alert">
                            No batch found in this course!
                        </div>
                    @endif 
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Batch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="batch_form" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="course_id" value="{{ $course->id }}" id="course_id">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch name:</label>
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch start time:</label>
                                <input type="time" name="start_time" class="form-control" id="start_time">
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch end time:</label>
                                <input type="time" name="end_time" class="form-control" id="end_time">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn  btn-primary" id="add_batch_btn">Update Batch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Batch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="add_batch_form" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="course_id" value="{{ $course->id }}" id="course_id">
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch name:</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch start time:</label>
                                <input type="time" name="start_time" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch end time:</label>
                                <input type="time" name="end_time" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn  btn-primary" id="add_batch_btn">Add Batch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- [ stiped-table ] end -->
@endsection

@push('script')
<link rel="stylesheet" href="{{ asset('assets/css/mdtimepicker.css') }}"/>
<script src="{{ asset('assets/js/mdtimepicker.js') }}"></script>
<script>
    $(document).ready(function(){
        // $('#start_time').timepicker({ 'timeFormat': 'h:i A' });
        $('#start_time, #end_time').mdtimepicker({
            timeFormat: 'hh:mm:ss.000',
            format: 'hh:mm tt',
            readOnly: false,
            hourPadding: false,
            theme: 'green',
            okLabel: 'Okay',
            cancelLabel: 'Cancel',
        });
    })  
    $(document).on('click', '.delete_batch', function(){
        Swal.fire({
            title: 'Are you sure?' ,
            text: "You want to delete this batch!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('{{url("delete-batch")}}/'+ $(this).data('id')).then(async (res)=>{
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
                        window.location.reload();
                    }
                }).catch((err)=>{
                    console.log(err);
                })
            }
        })
    })

    $('.edit_batch').on('click', function(e){
        let id = $(this).data('id');
        fetch('{{url("edit-batch")}}/'+id).then(async (res)=>{
            let data = await res.json();
            console.log(data);
            if(data.sts ==  false){
                Swal.fire({
                    title: 'Oops?',
                    text: data.msg,
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Okay!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                })
            }else{
                $('#id').val(data.data.id);
                $('#course_id').val(data.data.course_id);
                $('#start_time').val(data.data.from);
                $('#end_time').val(data.data.to);
                $('#name').val(data.data.name);
                $('#exampleModal').modal('show');
            }
        }).catch((err)=>{
            console.log(err);
        })
    })

    $('#batch_form').on('submit', function(e){
        e.preventDefault();
        fetch('{{route("update_batch")}}', {
            method:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body:new FormData(this)
        }).then(async (res)=>{
            let data = await res.json();
            console.log(data);
            if(data.sts ==  false){
                $('#exampleModal').modal('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.msg,
                });
            }else{
                $('#exampleModal').modal('hide');
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

    $('#add_batch_form').on('submit', function(e){
        e.preventDefault();
        fetch('{{route("add_batch")}}', {
            method:"POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            body:new FormData(this)
        }).then(async (res)=>{
            let data = await res.json();
            console.log(data);
            if(data.sts ==  false){
                $('#exampleModal2').modal('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.msg,
                });
            }else{
                $('#exampleModal2').modal('hide');
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
</script>
@endpush