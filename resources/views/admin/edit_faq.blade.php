@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Edit Faq Content</h4>
            </div>
            <!-- Main content -->
            <section class="content edit-profile-section">
                <div class="form-listing-box bg-white global-shadow">
                    <form method="post" action="{{ url('admin/faq/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $faq->id }}">
                            <div class="col-sm-12">
                                <br>
                                <label>Description</label>
                                @if($errors->has('desc'))
                                    <span style="color: red;">{{ $errors->first('desc') }}</span>
                                @endif
                                <br>
                                <textarea name="desc_new">{{ $desc->desc }}</textarea>
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <br>
                                <label>Question</label>
                                <input type="text" class="form-control" name="question" value="{{ $faq->question }}">
                                @if($errors->has('question'))
                                    <span style="color: red;">{{ $errors->first('question') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <label>Answer</label>
                                @if($errors->has('answer'))
                                    <span style="color: red;">{{ $errors->first('answer') }}</span>
                                @endif
                                <br>
                                <textarea name="desc">{{ $faq->answer }}</textarea>
                            </div>
                        </div>
                        <div class="form-button">
                            <a href="{{ url('admin/faq/list') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                            <input type="submit" class="btn btn-info" value="Save Changes">
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <script type="text/javascript">
             CKEDITOR.replace('desc_new');
             CKEDITOR.replace('desc');
        </script>
@endsection