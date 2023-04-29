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
                    <h5 class="text-capitalize">students List</h5>
                    <span class="d-block m-t-5">You are able to view list of students</span>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                    @if (count($students)>0)
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-capitalize">Image</th>
                                    <th class="text-capitalize">Name</th>
                                    <th class="text-capitalize">course</th>
                                    <th class="text-capitalize">batch</th>
                                    <th class="text-capitalize">fees</th>
                                    <th class="text-capitalize">total fees</th>
                                    <th class="text-capitalize">Demo</th>
                                    <th class="text-capitalize">status</th>
                                    <th class="text-capitalize">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>
                                        @if (isset($student->image) && $student->image!="")
                                        <img src="{{ asset('images/students/'.$student->image) }}" class="img-radius" width="40" height="40"/>
                                        @else
                                        <img src="{{ asset('images/students/avtar.png') }}" class="img-radius" width="40" height="40"/>
                                        @endif
                                    </td>
                                    <td class="text-capitalize">{{ $student->name }}</td>
                                    <td class="text-capitalize">{{ $student->course_name }}</td>
                                    <td>
                                        <span class="text-capitalize badge badge-light-info">{{ $student->batch_name }}</span>
                                    </td>
                                    <td class="text-capitalize">{{ $student->fees }}</td>
                                    <td class="text-capitalize">{{$student->total_fees}}</td>
                                    <td class="text-capitalize">
                                        @if ($student->demo == 1)
                                            <span class="text-capitalize badge  badge-light-info">Ongoing</span>
                                        @elseif ($student->demo == 0)
                                            <span class="text-capitalize badge  badge-light-warning">no progress</span>
                                        @elseif ($student->demo == 2)
                                            <span class="text-capitalize badge  badge-light-success">Completed</span>
                                        @endif
                                    </td>
                                    <td class="text-capitalize">
                                        @if ($student->status == 0)
                                            <span class="text-capitalize badge badge badge-light-warning">not joined</span>
                                        @elseif ($student->status == 1)
                                            <span class="text-capitalize badge badge-light-success">Joined</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('view_student', $student->id)}}" class="btn  btn-icon btn-success"><i class="feather icon-eye"></i></a>
                                        <a href="{{ route('edit_student', $student->id) }}" class="btn btn-icon btn-primary m-r-5"><i class="feather icon-edit"></i></a>
                                        <button type="button" class="btn  btn-icon btn-danger"><i class="feather icon-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {!! $students->links() !!}
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
    </div>
    <!-- [ stiped-table ] end -->
@endsection