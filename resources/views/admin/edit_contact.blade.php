@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Edit Contact Information</h4>
            </div>
            <!-- Main content -->
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/contact/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $contact->id }}">
                            <div class="col-sm-12">
                                <br>
                                <label>Data</label>
                                <input type="text" class="form-control" name="contact" value="{{ $contact->data }}">
                                @if($errors->has('contact'))
                                    <span style="color: red;">{{ $errors->first('contact') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('admin/contact/list') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                            <input type="submit" class="btn btn-info" value="Save Changes">
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
@endsection