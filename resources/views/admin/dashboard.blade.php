@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Dashboard</h4>
            </div>
            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="dashboard-small-box">
                    <div class="row">
                        @can('check-admin')
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-aqua">Total Hotels</p>
                                    <h3 class="text-aqua">0</h3>
                                </div>
                                <div class="icon bg-aqua">
                                    <i class="ion"><img src="{{ asset('/') }}public/dist/images/booking-total-icon.svg" alt="Total Booking Icon"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-red">Hotel Related Users</p>
                                    <h3 class="text-red">0</h3>
                                </div>
                                <div class="icon bg-red">
                                    <i class="ion"><img src="{{ asset('/') }}public/dist/images/booking-pending-icon.svg" alt="Pending Booking Icon"></i>
                                </div>
                            </div>
                        </div>
                         <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-black">Total Operator</p>
                                    <h3 class="text-black">{{ $data['operator_user_count'] }}</h3>
                                </div>
                                <div class="icon bg-black">
                                    <i class="ion"><img src="{{ asset('/') }}public/dist/images/booking-assign-icon.svg" alt="Assign Booking Icon"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        @endcan
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-black">Total Users</p>
                                    <h3 class="text-black">{{ $data['form_filler_user_count'] }}</h3>
                                </div>
                                <div class="icon bg-black">
                                    <i class="ion"><img src="{{ asset('/') }}public/dist/images/booking-assign-icon.svg" alt="Assign Booking Icon"></i>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-blue">Total Jobs</p>
                                    <h3 class="text-blue">{{ $data['job_count'] }}</h3>
                                </div>
                                <div class="icon bg-blue">
                                    <i class="ion"><i class="fa fa-briefcase" aria-hidden="true"></i></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-orange">Total Pendings Jobs</p>
                                    <h3 class="text-orange">{{ $data['pending_jobs_count'] }}</h3>
                                </div>
                                <div class="icon bg-orange">
                                    <i class="ion"><i class="fa fa-clock-o" aria-hidden="true"></i></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-purple">Total Ongoings Jobs</p>
                                    <h3 class="text-purple">{{ $data['ongoing_jobs_count'] }}</h3>
                                </div>
                                <div class="icon bg-purple">
                                    <i class="ion"><i class="fa fa-tasks" aria-hidden="true"></i></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-green">Total Completed Jobs</p>
                                    <h3 class="text-green">{{ $data['completed_jobs_count'] }}</h3>
                                </div>
                                <div class="icon bg-green">
                                    <i class="ion"><img src="{{ asset('/') }}public/dist/images/booking-complete-icon.svg" alt="Assign Booking Icon"></i>
                                </div>
                            </div>
                        </div>

                        <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-red">Total Rejected Jobs</p>
                                    <h3 class="text-red">{{ $data['rejected_jobs_count'] }}</h3>
                                </div>
                                <div class="icon bg-red">
                                    <i class="ion"><i class="fa fa-ban" aria-hidden="true"></i></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-skyblue">Total Queries</p>
                                    <h3 class="text-skyblue">{{ $data['query_count'] }}</h3>
                                </div>
                                <div class="icon bg-yellow">
                                    <i class="ion"><i class="fa fa-question-circle" aria-hidden="true"></i></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@endsection