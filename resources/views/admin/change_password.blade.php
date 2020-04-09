@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Change Password</h4>
                
            </div>
            @if(session()->has('error'))
                <div class="alert alert-danger" id="hideAlert">
                    {{ session()->get('error') }}
                </div>
            @endif
            <!-- Main content -->
            <section class="content view-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/change/password') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Old Password</label>
                                    <input type="password" class="form-control" name="old_password">
                                    @if($errors->has('old_password'))
                                        <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="password" class="form-control" name="new_password">
                                    @if($errors->has('new_password'))
                                        <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password">
                                    @if($errors->has('confirm_password'))
                                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-button">
                                        <a href="{{ url('admin/profile') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                                        <input type="submit" class="btn btn-info" value="SAVE CHANGES">
                                    </div>
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
@endsection