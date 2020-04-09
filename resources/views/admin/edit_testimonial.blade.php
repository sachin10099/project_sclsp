@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Edit Testimonial</h4>
            </div>
            <!-- Main content -->
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/testimonial/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-box d-flex align-items-center justify-content-between">
                            <div class="edit-profile-box">
                                <div class="browse-image-box">
                                    <input type="hidden" name="id" value="{{ $testimonial->id }}">
                                    <label class=newbtn>
                                        @if($testimonial->image)
                                            <img src="{{ $testimonial->image }}" class="blah" alt="Profile Image" />
                                        @else
                                            <img src="{{ asset('/') }}public/dist/images/imgdefault.png" class="blah" alt="Profile Image" />
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
                            <div class="col-sm-12">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $testimonial->name }}">
                                @if($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" value="{{ $testimonial->designation }}">
                                @if($errors->has('designation'))
                                    <span style="color: red;">{{ $errors->first('designation') }}</span>
                                @endif
                               
                               
                            </div>
                            <div class="col-sm-12">
                                <label>Description</label>
                                @if($errors->has('desc'))
                                    <span style="color: red;">{{ $errors->first('desc') }}</span>
                                @endif
                                <br>
                                <textarea name="desc">{{ $testimonial->desc }}</textarea>
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('admin/testimonial/list') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
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
                        $('.blah')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            CKEDITOR.replace( 'desc' );
        </script>
@endsection