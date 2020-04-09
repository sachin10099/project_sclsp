@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Edit Social Link</h4>
            </div>
            <br>
            @if(session()->has('error'))
                <div class="alert alert-danger" id="hideAlert">
                    {{ session()->get('error') }}
                </div>
            @endif
            <!-- Main content -->
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/social/link-update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $link->id }}">
                            <div class="col-sm-12">
                                <label>Link</label>
                                <input type="text" class="form-control" name="link" value="{{ $link->link }}">
                                @if($errors->has('link'))
                                    <span style="color: red;">{{ $errors->first('link') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('admin/social/link') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                            <input type="submit" class="btn btn-info" value="Save Changes">
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection