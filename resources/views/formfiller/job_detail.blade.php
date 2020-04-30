@extends('front.formfiller_dashboard')
@section('content')
	<div class="content">
	<div class="container-fluid">
	<div class="row">
	<div class="col-md-12">
	  <div class="card">
	    <div class="card-header card-header-primary">
	      <h4 class="card-title ">Job Details</h4>
	    </div>
	    <div class="card-body">
	      <div class="row">
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Job ID:</strong><br><p>{{ $data->getJobDetail['id'] }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Job Title:</strong><br><p>{{ $data->getJobDetail['job_title'] }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Job Type:</strong><br><p>{{ $data->getJobDetail['job_type'] }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>State:</strong><br><p>{{ $data->getJobDetail['getState']['name'] }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Job Location:</strong><br><p>{{ $data->getJobDetail['job_location'] }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Job Status:</strong><br>
      		@if($data->status == 'on_going')
	      		<b><span style="color: blue;">On Processing</span></b> 
      		@elseif($data->status == 'completed') 
      			Completed 
  			@elseif($data->status == 'cancled')
  				Canceled
			@elseif($data->status == 'reject')
				Rejected
			@endif
			</div>
	      </div>
	      <div class="row">
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Published Date:</strong><br><p>{{ $data->getJobDetail['job_published'] }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>End Date:</strong><br><p>{{ $data->getJobDetail['job_deadline'] }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Vacancy:</strong><br><p>{{ $data->getJobDetail['vacancy'] }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Payment Status:</strong><br><p style="color: brown;"><b>{{ ucfirst($data->amount_status) }}</b></p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Amount:</strong><br><p>{{ $data->amount }}</p></div>
	      	<div class="col-md-2 col-sm-2 col-xs-6"><strong>Payment Id:</strong><br>
      		{{ $data->transaction_id }}
			</div>
	      </div>
	      <div class="row">
	      	<div class="col-md-12">
	      		<strong>Job Description:</strong><br>
		      	{!! $data->getJobDetail['job_desc'] !!}
	      	</div>
		  </div>
	      </div>
	    </div>
	  </div>

	  	<div class="col-md-12">
	  <div class="card">
	    <div class="card-header card-header-primary">
	      <h4 class="card-title ">Job Related Documents</h4>
	    </div>
	    <div class="card-body">
	      <div class="row">
	      	@if(!$data->documents)
	      		<div class="col-sm-5">&nbsp;</div>
	      		<div class="col-sm-4"><p>No Document(s) Found.</p></div>
	      		<div class="col-sm-3">&nbsp;</div>
	      		
	      		<br>
	      		<span><b>Note: You will receive the documents, your form will be filled up and your job status will be completed.
				If you still do not show the document, then contact the administrator user.</b></span>
	      	@else
	      		<p>Found</p>
	      	@endif
	      </div>
	      </div>
	    </div>
	  </div>
	</div>
	</div>
	</div>
	</div>
@endsection