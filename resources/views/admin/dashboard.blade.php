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
                                    <h3 class="text-aqua">120</h3>
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
                                    <h3 class="text-red">5</h3>
                                </div>
                                <div class="icon bg-red">
                                    <i class="ion"><img src="{{ asset('/') }}public/dist/images/booking-pending-icon.svg" alt="Pending Booking Icon"></i>
                                </div>
                            </div>
                        </div>
                        @endcan
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-blue">Form Fillers Users</p>
                                    <h3 class="text-blue">15</h3>
                                </div>
                                <div class="icon bg-blue">
                                    <i class="ion"><img src="{{ asset('/') }}public/dist/images/booking-assign-icon.svg" alt="Assign Booking Icon"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-white global-shadow">
                                <div class="inner">
                                    <p class="text-green">Total Jobs</p>
                                    <h3 class="text-green">100</h3>
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
                                    <p class="text-green">Queries</p>
                                    <h3 class="text-green">{{ $data['query_count'] }}</h3>
                                </div>
                                <div class="icon bg-green">
                                    <i class="ion"><img src="{{ asset('/') }}public/dist/images/booking-complete-icon.svg" alt="Assign Booking Icon"></i>
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