@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Edit Why Choose Content</h4>
            </div>
            <!-- Main content -->
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/why-choose/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $why_choose->id }}">
                            <div class="col-sm-12">
                                <label>Heading</label>
                                <input type="text" class="form-control" name="heading" value="{{ $why_choose->heading }}">
                                @if($errors->has('heading'))
                                    <span style="color: red;">{{ $errors->first('heading') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <br>
                                <label>Tag Line</label>
                                @if($errors->has('desc'))
                                    <span style="color: red;">{{ $errors->first('desc') }}</span>
                                @endif
                                <br>
                                <textarea name="desc">{{ $why_choose->desc }}</textarea>
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('admin/why-choose/list') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
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