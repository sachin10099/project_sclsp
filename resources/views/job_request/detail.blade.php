@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="row">
    	<div class="col-sm-4">
    		<div class="content-header">
		        <h4>Manage Job Request</h4>
		    </div>
    	</div>
    </div>
    <br>
    @if(session()->has('success'))
        <div class="alert alert-success" id="hideAlert">
            {{ session()->get('success') }}
        </div>
    @endif
  
    <div class="loading" id="loader">Loading&#8230;</div>

    <!--  End loader Content -->
    <section class="content manage-company-user-section">
        <div class="tab-section">
          <div class="tab-content" style="background-color: white;">
             <div class="table-section container-fluid">
              <br>
              <center><h4>Job Details</h4></center>
              <br>
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
                <hr>
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
                <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <strong>Job Description:</strong><br>
                      {!! $data->getJobDetail['job_desc'] !!}
                    </div>
                </div>
                  </div>
             </div>
            
          </div>
    </section>
    <!-- /.content -->
      <section class="content manage-company-user-section" style="margin-top: 20px;">
        <div class="tab-section">
          <div class="tab-content" style="background-color: white;">
             <div class="table-section container-fluid">
              <br>
              <center><h4>Applicant User Detail</h4></center>
              <br>
                <b style="border-bottom:ridge;">Personal Information:</b>
                <div class="row">
                  <div class="col-sm-8">
                    <div class="col-md-3 col-sm-2 col-xs-6"><strong>Name: </strong><br><p>{{ $data->jobReleatedUser['name'] }}</p></div>
                    <div class="col-md-3 col-sm-2 col-xs-6"><strong>Email: </strong><br><p>{{ $data->jobReleatedUser['email'] }}</p></div>
                    <div class="col-md-3 col-sm-2 col-xs-6"><strong>Contact Numner: </strong><br><p>{{ $data->jobReleatedUser['contact_number'] }}</p></div>
                    <div class="col-md-3 col-sm-2 col-xs-6"><strong>Address: </strong><br><p>{{ $data->jobReleatedUser['address'] }}</p></div>
                  </div>
                  <div class="col-sm-4">
                    <strong>Profile Photo: </strong><br><img src="{{ $data->jobReleatedUser['profile_pic'] }}" alt="Profile Photo" style="width: 100:height:auto;">
                  </div>
                </div>
                </div>
              </div>
             </div>
            
          </div>
    </section>
</div>
<!-- /.content-wrapper -->
</div>
@push('scripts')
<script type="text/javascript">
  document.getElementById('loader').style.display = "none";
</script>
@endpush
@endsection