@extends('front.formfiller_dashboard')
@section('content')
<!-- Modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	<div class="content">
	<div class="container-fluid">
	<div class="row">
	<div class="col-md-12">
	  
	  	@if($data->status == 'reject')
	  	<strong>Note: 
	  		Your payment will be returned within 24 hours. If you do not get a refund after 24 hours, you can call the administrator user free mind.
  		</strong>
	  	@endif
	  <div class="card">
	    <div class="card-header card-header-primary">
	      <h4 class="card-title ">Job Details</h4>
	      <h4>ORDER ID: {{ $data->order_id }}</h4>
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
                <b><span style="color: green;">Completed</span></b>  
                @elseif($data->status == 'cancled')
                <b><span style="color: red;">Completed</span></b> 
                @elseif($data->status == 'reject')
                <b><span style="color: red;">Rejected</span><br><span style="color: blue;font-size: 25px;cursor: pointer;"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" title="View Region" onclick="rejectRegion('{{ $data->rejection_region }}')"></i></span></b> 
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
	      	@if(count($data->documents) == 0 )
	      		<div class="col-sm-5">&nbsp;</div>
	      		<div class="col-sm-4"><p>No Document(s) Found.</p></div>
	      		<div class="col-sm-3">&nbsp;</div>
	      		
	      		<br>
	      		<span><b>Note: You will receive the documents, your form will be filled up and your job status will be completed.
				If you still do not show the document, then contact the administrator user.</b></span>
	      	@else
	      	<div class="container-fluid">
	      	<div class="row">
	      		@foreach($data->documents as $document)
	      		<div class="col-sm-4">
	      			<b  style="color: black;">Name: {{ $document->document_name }}</b>
	      			<a href="{{ $document->document_file }}" download><img src="{{ asset('public/assets3/img/pdf_default.png') }}" style="width: 100%;height: auto;"></a>
	      			<br>
	      			<center><a href="{{ $document->document_file }}" target="_blank"><i class="fa fa-eye" aria-hidden="true" style="font-size: 20px;color:blue;"></i></a></center>
      			</div>
	      		@endforeach
	      		
      		</div>
      		<strong><span style="color:red;">Note:</span> Please check your document, if everything is correct, then send your confirmation, otherwise send the problem.</strong><br>
      		<center>
      			<!-- Modal -->
				<div id="sendIssue" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				      </div>
				      <div class="modal-body">
				      	<form method="post" action="">
				      		<div class="form-group">
							  <label for="comment">Enter Your Problem:</label>
							  <textarea class="form-control" name="issue" rows="5"></textarea>
							</div>
							<br>
							<input type="submit" class="btn btn-info">
				      	</form>
				      </div>
				    </div>

				  </div>
				</div>
      			<button class="btn btn-info" onclick="sendConfirmation('{{ $data->id }}')">Send Confirmation</button>
      			<button class=" btn btn-danger" data-toggle="modal" data-target="#sendIssue">Send Issue / Problem</button>
      		</center>
      		<br>
      		<h4>Job Filled By:</h4>
      		<label style="color: blue;">* If you have any query feel to free for call your operator.</label><br>
      		<strong style="color: black;">Operator Name: {{ $data->jobAcceptedBy['name'] }}</strong><br>
      		<strong style="color: black;">Contact Number: {{ $data->jobAcceptedBy['contact_number'] }}</strong>
      		</div>
	      	@endif
	      </div>
	      </div>
	    </div>
	  </div>
	</div>
	</div>
	</div>
	</div>
	<script type="text/javascript">
		function rejectRegion(data) {
			alert(data);
		}

		function sendConfirmation(id) {
		    document.getElementById('loader').style.display ="block";
		    swal({
		        title: "Are you sure?",
		        text: "Everything is right.",
		        icon: "warning",
		        buttons: true,
		        dangerMode: true,
		    })
		    .then((willDelete) => {
		        if (willDelete) {
		            $.ajax({
		                method:'post',
		                url   : "{{ url('form-filler/user/send-confirmation') }}",
		                data  : {
		                    "_token": "{{ csrf_token() }}",
		                    'id'    : id
		                },
		                success: function(data){
		                    document.getElementById('loader').style.display ="none";
		                    swal("", data, "success");
		                    datatable.ajax.reload();
		                }
		            });
		        }else {
		            document.getElementById('loader').style.display ="none";
		        }
		    });
		    
		}
	</script>
@endsection