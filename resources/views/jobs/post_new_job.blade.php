@extends('front.admin')
@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h4>Post Job</h4>
    </div>
     @if(session()->has('error'))
        <div class="alert alert-danger" id="hideAlert">
            {{ session()->get('error') }}
        </div>
    @endif
    <!-- Main content -->
    <section class="content edit-profile-section">
        <div class="form-listing-box bg-white global-shadow">
            <form method="post" action="{{ url('admin/jobs/post') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                	<label>Feature Image (Optional)</label>
                	<div class="profile-box d-flex align-items-center justify-content-between">
                        <div class="edit-profile-box">
                            <div class="browse-image-box">
                                <label class=newbtn>
                                    <img src="{{ asset('/') }}public/dist/images/imgdefault.png" class="blah" alt="Profile Image" />
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
                    <div class="row" style="margin-bottom: 10px;">
                    	<div class="col-sm-6">
	                        <label>Job Title</label>
	                        <input type="text" class="form-control" name="job_tile" value="{{ old('job_tile') }}">
	                        @if($errors->has('job_tile'))
	                            <span style="color: red;">{{ $errors->first('job_tile') }}</span>
	                        @endif
	                    </div>
	                    <div class="col-sm-6">
	                        <label>Job Type</label>
	                        <select class="form-control" name="job_type" required="">
					            <option></option>
					            @if( old('job_type') == 'Full Time')
					            	<option value="Full Time" selected="">Full Time</option>
				            	@elseif(old('job_type') == 'Part Time')
					            	<option value="Part Time" selected="">Part Time</option>
				            	@else
				            		<option value="Full Time">Full Time</option>
				            		<option value="Part Time">Part Time</option>
			            		@endif
				            </select>	
	                        @if($errors->has('job_type'))
	                            <span style="color: red;">{{ $errors->first('job_type') }}</span>
	                        @endif
	                    </div>
                    </div>
                	<div class="row" style="margin-bottom: 10px;">
                		  <div class="col-sm-6">
	                        <label>State</label>
				            <select class="form-control" name="state" required="">
					            <option></option>
					            @foreach($data['states'] as $state)
					                <option value="{{ $state->id }}">{{ $state->name }}</option>
					            @endforeach
				            </select>	
	                        @if($errors->has('state'))
	                            <span style="color: red;">{{ $errors->first('state') }}</span>
	                        @endif
	                    </div>
	                    <div class="col-sm-6">
	                        <label>Job Location</label>
				            <input type="text" class="form-control" name="job_location" value="{{ old('job_location') }}">
	                        @if($errors->has('job_location'))
	                            <span style="color: red;">{{ $errors->first('job_location') }}</span>
	                        @endif
	                    </div>
                	</div>
                	<br>
          			<strong style="color: red;">Note:</strong>  Please Select Job End Date After Then Job Publish Date.
          			<br>
                  	<div class="row" style="margin-bottom: 10px;">
                  		<div class="col-sm-6">
	                        <label>Job Published Date</label>
				            <input type="date" class="form-control" name="published" value="{{ old('published') }}" required="">
	                        @if($errors->has('published'))
	                            <span style="color: red;">{{ $errors->first('published') }}</span>
	                        @endif
	                    </div>
	                    <div class="col-sm-6">
	                        <label>Job End Date</label>
				            <input type="date"  class="form-control" name="endjob" value="{{ old('endjob') }}" required="">
	                        @if($errors->has('endjob'))
	                            <span style="color: red;">{{ $errors->first('endjob') }}</span>
	                        @endif
	                    </div>
                  	</div>
                  	<div class="row" style="margin-bottom: 10px;">
                  		<div class="col-sm-6">
	                        <label>Vacancy (Optional)</label>
				            <input type="number" class="form-control" name="vacancy" value="{{ old('vacancy') }}">
	                        @if($errors->has('vacancy'))
	                            <span style="color: red;">{{ $errors->first('vacancy') }}</span>
	                        @endif
	                    </div>
	                    <div class="col-sm-12">
	                        <br>
	                        <label>Description</label>
	                        @if($errors->has('desc'))
	                            <span style="color: red;">{{ $errors->first('desc') }}</span>
	                        @endif
	                        <br>
	                        <textarea name="desc_new">{{ old('desc_new') }}</textarea>
	                    </div>
	                </div>
          
                </div>
                <div class="form-button">
                    <a href="{{ url('admin/jobs/list-view') }}"><b-button type="submit" class="btn btn-warning">Cancel</b-button></a>
                    <input type="submit" class="btn btn-info" value="Save">
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
    CKEDITOR.replace( 'tagline' );
</script>
@endsection