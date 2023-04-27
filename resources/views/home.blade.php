@extends('layouts.panel')

@section('content')
<!-- [ breadcrumb ] start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard Analytics</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-book"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$totalcourse}}</h4>
                            <h6 class="text-capitalize">total courses</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-3">
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-users"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$totalstudents}}</h4>
                            <h6 class="text-capitalize">total students</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-3">
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-calendar"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$totalbatchs}}</h4>
                            <h6 class="text-capitalize">total batchs</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-3">
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-users"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{$totalusers-1}}</h4>
                            <h6 class="text-capitalize">total staff</h6>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Courses</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if (count($courses)>0)
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>fees</th>
                                        <th>total batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                    <tr>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <img src="{{ asset('/images/course/'.$course->image) }}" alt="user image" class="img-radius align-top border" width="40" height="40">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <div class="d-inline-block text-capitalize">
                                                    <h6>{{$course->name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <div class="d-inline-block text-capitalize">
                                                    <h6>{{$course->fees}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="badge badge-light-info">Batchs <span class="badge badge-light">{{ count($course->batch) }}</span></label>
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
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
@endsection
