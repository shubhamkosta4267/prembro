@extends('layouts.panel')
@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 text-capitalize">courses list</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">courses</a></li>
                        <li class="breadcrumb-item"><a href="#!">courses list</a></li>
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
                <div class="card-header">
                    <h5 class="text-capitalize">courses List</h5>
                    <span class="d-block m-t-5">You are able to view list of curses</span>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                    @if (count($courses)>0)
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-capitalize">Image</th>
                                    <th class="text-capitalize">Name</th>
                                    <th class="text-capitalize">Fees</th>
                                    <th class="text-capitalize">Total Batch</th>
                                    <th class="text-capitalize">Total Students</th>
                                    <th class="text-capitalize">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>
                                        <img src="{{ asset('/images/course/'.$course->image) }}" height="50" width="50" class="border p-2 rounded"/>
                                    </td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->fees }}</td>
                                    <td>
                                        <span class="badge badge-light-{{ count($course->batch)>0 ? 'info' : 'danger' }}">Batchs {{ count($course->batch) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-{{ countCourseStudent($course->id) > 0 ? 'info' : 'danger'}}">Students {{ countCourseStudent($course->id) }}</span>
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('courses_view', $course->id) }}" class="btn btn-icon btn-success m-r-5"><i class="feather icon-eye"></i></a>
                                        <a href="{{ route('edit_course', $course->id) }}" class="btn btn-icon btn-primary m-r-5"><i class="feather icon-edit"></i></a>
                                        <button data-value="{{ $course->id }}" type="button" class="btn btn-icon btn-info m-r-5 modal_btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" data-id="{{$course->id}}"><i class="feather icon-plus"></i></button>
                                        <button type="button" data-id="{{ $course->id }}" class="btn btn-icon btn-danger delete_course"><i class="feather icon-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $courses->links() !!}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            No record found!
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
                        <h5 class="modal-title" id="exampleModalLabel">Add Batch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="batch_form" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="course_id" id="course_id">
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch name:</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch start time:</label>
                                <input type="text" name="start_time" class="form-control" id="start_time">
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-form-label">Batch end time:</label>
                                <input type="text" name="end_time" class="form-control" id="end_time">
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
        $('#delete_form').on('submit', function(e){
            e.preventDefault();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    return true;
                }
            })
        });

        $(document).on('click', '.delete_course', function(){
            Swal.fire({
                title: 'Are you sure?' ,
                text: "You want to delete this course!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{url("delete-course")}}/'+ $(this).data('id')).then(async (res)=>{
                        let data = await res.json();
                        console.log(data);
                        if(data.sts ==  false){
                            toastr.error(data.msg);
                        }else{
                            window.location.reload();
                        }
                    }).catch((err)=>{
                        console.log(err);
                    })
                }
            })
        })

        $(document).on('click', '.modal_btn', function(){
            $('#course_id').val($(this).data('id'));
        })

        $('#batch_form').on('submit', function(e){
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
                    $('#exampleModal').modal('hide');
                    toastr.error(data.msg);
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
    </script>
@endpush