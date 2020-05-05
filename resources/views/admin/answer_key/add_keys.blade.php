@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
            @if(isset($data))
            <div class="content-header">
                <h4>Edit Answer Key Detail</h4>
            </div>
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('form-filler/answer-key/edit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="col-sm-12">
                                <br>
                                <label>Title:</label>
                                @if($errors->has('title'))
                                    <span style="color: red;">{{ $errors->first('title') }}</span>
                                @endif
                                <br>
                                <textarea name="title">{{ $data->title }}</textarea>
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <br>
                                <label>Official Link:</label>
                                <input type="text" class="form-control" name="link" value="{{ $data->official_link }}">
                                @if($errors->has('link'))
                                    <span style="color: red;">{{ $errors->first('link') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('form-filler/admit-card/list') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>
                    </form>
                </div>
            </section>
            @else 
             <div class="content-header">
                <h4>Add Answer key</h4>
            </div>
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('form-filler/answer-key/add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <label>Title:</label>
                                @if($errors->has('title'))
                                    <span style="color: red;">{{ $errors->first('title') }}</span>
                                @endif
                                <br>
                                <textarea name="title">{{ old('title') }}</textarea>
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <br>
                                <label>Official Link:</label>
                                <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                                @if($errors->has('link'))
                                    <span style="color: red;">{{ $errors->first('link') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('form-filler/answer-key/list') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>
                    </form>
                </div>
            </section>
            @endif
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <script type="text/javascript">
             CKEDITOR.replace('title');
        </script>
@endsection