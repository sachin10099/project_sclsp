@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Edit Service</h4>
            </div>
            <!-- Main content -->
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/service/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $service->id }}">
                            <div class="col-sm-12">
                                <label>Heading</label>
                                <input type="text" class="form-control" name="heading" value="{{ $service->heading }}">
                                @if($errors->has('heading'))
                                    <span style="color: red;">{{ $errors->first('heading') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <br>
                                <label>Service Content</label>
                                @if($errors->has('content'))
                                    <span style="color: red;">{{ $errors->first('content') }}</span>
                                @endif
                                <br>
                                <input type="hidden" name="content_id" value="{{ $service_content->id }}">
                                <textarea name="content">{{ $service_content->desc }}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <label>Description</label>
                                @if($errors->has('desc'))
                                    <span style="color: red;">{{ $errors->first('desc') }}</span>
                                @endif
                                <br>
                                <textarea name="desc">{{ $service->desc }}</textarea>
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('admin/service/list') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                            <input type="submit" class="btn btn-info" value="Save Changes">
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <script type="text/javascript">
            CKEDITOR.replace( 'content' );
            CKEDITOR.replace( 'desc' );
        </script>
@endsection