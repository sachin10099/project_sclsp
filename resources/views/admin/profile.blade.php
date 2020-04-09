@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Manage Profile</h4>
            </div>
            @if(session()->has('success'))
                <div class="alert alert-success" id="hideAlert">
                    {{ session()->get('success') }}
                </div>
            @endif
            <!-- Main content -->
            <section class="content view-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form>
                        <div class="profile-box d-flex align-items-center justify-content-between">
                            <div class="view-profile-box">
                                <span>
                                    @if(\Auth::user()->profile_pic)
                                        <img src="{{ \Auth::user()->profile_pic }}" alt="Profile Image" />
                                    @else
                                        <img src="{{ asset('/') }}public/assets/img/default.png" alt="Profile Image" />
                                    @endif
                                </span>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('admin/profile/edit') }}" class="btn btn-default">Edit Profile</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" id="date" placeholder="John Wick" value="{{ \Auth::user()->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Mobile Number</label>
                                    <input type="text" class="form-control" id="date" value="{{ \Auth::user()->contact_number }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Email ID</label>
                                    <input type="text" class="form-control" id="date" placeholder="john_wick_012@gmail.com" value="{{ \Auth::user()->email }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" id="date" value="{{ \Auth::user()->address }}"  disabled>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="blue-link-form">
                                    <a href="{{ url('admin/change/password') }}" class="light-blue-text"><strong>Change Password?</strong></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->
@endsection