@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Edit Profile</h4>
            </div>
            <!-- Main content -->
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/profile/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-box d-flex align-items-center justify-content-between">
                            <div class="edit-profile-box">
                                <div class="browse-image-box">
                                    <label class=newbtn>
                                        @if(\Auth::user()->profile_pic)
                                            <img id="blah" src="{{ \Auth::user()->profile_pic }}" alt="Profile Image" />
                                        @else
                                            <img id="blah" src="{{ asset('/') }}public/assets/img/default.png" alt="Profile Image" />
                                        @endif
                                        <span>
                                            <input id="pic" name="image" class='pis' onchange="readURL(this);" type="file">
                                        </span>
                                    </label>
                                </div>
                                @if($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ \Auth::user()->name }}" autocomplete="off">
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Mobile Number</label>
                                    <input type="text" class="form-control" name="contact" value="{{ \Auth::user()->contact_number }}" autocomplete="off">
                                    @if($errors->has('contact'))
                                        <span class="text-danger">{{ $errors->first('contact') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Email ID</label>
                                    <input type="text" class="form-control" name="email" value="{{ \Auth::user()->email }}" autocomplete="off">
                                    @if($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ \Auth::user()->address }}" autocomplete="off">
                                    @if($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('admin/profile') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                            <input type="submit" class="btn btn-info" value="Save Changes">
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
@endsection