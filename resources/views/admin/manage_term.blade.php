@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Manage Term & Conditions</h4>
            </div>
            @if(session()->has('success'))
                <div class="alert alert-success" id="hideAlert">
                    {{ session()->get('success') }}
                </div>
            @endif
            <!-- Main content -->
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/manage/terms') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="id" value="{{ $terms->id }}">
                                <label>Description</label>
                                <br>
                                @if($errors->has('content'))
                                    <span style="color: red;">{{ $errors->first('content') }}</span>
                                @endif
                                <br>
                                <textarea name="content" required="">{{ $terms->content }}</textarea>
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('admin/dashboard') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
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
        </script>
@endsection