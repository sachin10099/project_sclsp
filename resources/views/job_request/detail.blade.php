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
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Please Upload Document Before Complete Request</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ url('admin/manage/job/upload-file') }}" enctype="multipart/form-data">
              @csrf
              <label>Document Name:</label>
              <input type="text"  name="name" class="form-control" required="">
              @if($errors->has('name'))
                  <span class="text-danger" style="color: red;">{{ $errors->first('name') }}</span>
                  <script type="text/javascript">
                    setTimeout(function(){ 
                      $('#myModal').modal('show');
                    }, 1000);
                  </script>
              @endif
              <br>
              <label>Choose File:</label>
              <input type="hidden" name="id" class="form-control" value="{{ $data->id }}">
              <input type="hidden" name="user_id" class="form-control" value="{{ $data->user_id }}">
              <br>
              <input type="file" name="image" required="">
              @if($errors->has('image'))
                  <span class="text-danger" style="color: red;">{{ $errors->first('image') }}</span>
                  <script type="text/javascript">
                    setTimeout(function(){ 
                      $('#rejectModel').modal('show');
                    }, 1000);
                  </script>
              @endif<br>
              <input type="submit" class="btn btn-info" style="margin-top: 20px;">
            </form>
          </div>
        </div>

      </div>
    </div>
    <br>
        <!-- Modal -->
    <div id="rejectModel" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Enter Here Your Rejection Statement</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ url('admin/manage/job/reject-request') }}" enctype="multipart/form-data">
              @csrf
              <label>Enter Region:</label>
              <input type="hidden" name="id" class="form-control" value="{{ $data->id }}">
              <textarea name="region" required=""></textarea>
              @if($errors->has('region'))
                  <span class="text-danger" style="color: red;">{{ $errors->first('region') }}</span>
                  <script type="text/javascript">
                    setTimeout(function(){ 
                      $('#myModal').modal('show');
                    }, 1000);
                  </script>
              @endif
              <input type="submit" class="btn btn-info" style="margin-top: 20px;">
            </form>
          </div>
        </div>

      </div>
    </div>
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
              @if($data->status == 'reject')
                <span>Rejection comment: {!! $data->rejection_region !!}</span>
              @endif
              <br>
              <h4>ORDER ID: <span style="color: orange;">{{ $data->order_id }}</span></h4><center><h4>Job Details</h4></center>
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
                <b><span style="color: green;">Completed</span></b>  
                @elseif($data->status == 'cancled')
                <b><span style="color: red;">Completed</span></b> 
                @elseif($data->status == 'reject')
                <b><span style="color: red;">Rejected</span></b> 
                @endif
                </div>
                </div>
                <hr>
                <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-6"><strong>Published Date:</strong><br><p>{{ $data->getJobDetail['job_published'] }}</p></div>
                <div class="col-md-2 col-sm-2 col-xs-6"><strong>End Date:</strong><br><p>{{ $data->getJobDetail['job_deadline'] }}</p></div>
                <div class="col-md-2 col-sm-2 col-xs-6"><strong>Vacancy:</strong><br><p>{{ $data->getJobDetail['vacancy'] }}</p></div>
                <div class="col-md-2 col-sm-2 col-xs-6"><strong>Payment Status:</strong><br><p style="color: MediumSeaGreen;"><b>{{ ucfirst($data->amount_status) }}</b></p></div>
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
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-6"><strong>Name: </strong><br><p>{{ $data->jobReleatedUser['name'] }}</p></div>
                      <div class="col-md-4 col-sm-4 col-xs-6"><strong>Email: </strong><br><p>{{ $data->jobReleatedUser['email'] }}</p></div>
                      <div class="col-md-4 col-sm-4 col-xs-6"><strong>Contact Numner: </strong><br><p>{{ $data->jobReleatedUser['contact_number'] }}</p></div>
                    </div><hr>

                    <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-6"><strong>Gender: </strong><br><p>{{ $data->jobReleatedUser['userInfo']['gender'] }}</p></div>
                      <div class="col-md-6 col-sm-6 col-xs-6"><strong>Date of Birth: </strong><br><p>{{ $data->jobReleatedUser['userInfo']['dob'] }}</p></div>
                    </div><hr>

                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-6"><strong>Pin Code: </strong><br><p>{{ $data->jobReleatedUser['postal_code'] }}</p></div>
                      <div class="col-md-4 col-sm-4 col-xs-6"><strong>State: </strong><br><p>{{ $data->jobReleatedUser['stateName']['name'] }}</p></div>
                      <div class="col-md-4 col-sm-4 col-xs-6"><strong>City: </strong><br><p>{{ $data->jobReleatedUser['city']['name'] }}</p></div> 
                    </div><hr>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12"><strong>Address: </strong><br><p>{{ $data->jobReleatedUser['address'] }}</p></div>
                    </div><hr>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12"><strong>Father's Name: </strong><br><p>{{ $data->jobReleatedUser['userInfo']['father_name'] }}</p></div>
                      <div class="col-md-4 col-sm-4 col-xs-12"><strong>Mother's Name: </strong><br><p>{{ $data->jobReleatedUser['userInfo']['mother_name'] }}</p></div>
                      <div class="col-md-4 col-sm-4 col-xs-12"><strong>Category: </strong><br><p>{{ $data->jobReleatedUser['userInfo']['getCaterory']['name'] }}</p></div>
                    </div><hr>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12"><strong>Aadhaar Number: </strong><br><p>{{ $data->jobReleatedUser['userInfo']['aadhaar_number'] }}</p></div>
                      <div class="col-md-4 col-sm-4 col-xs-6"><strong>Aadhaar Pic Front: </strong><br>
                        <a href="{{ $data->jobReleatedUser['userInfo']['aadhaar_img_front'] }}" target="_blank" style="font-size: 20px;margin-right:5px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="{{ $data->jobReleatedUser['userInfo']['aadhaar_img_front'] }}" download><button class="btn btn-info">Download</button></a></div>
                      <div class="col-md-4 col-sm-4 col-xs-6"><strong>Aadhaar Pic Back: </strong><br>
                        <a href="{{ $data->jobReleatedUser['userInfo']['aadhaar_img_back'] }}" target="_blank" style="font-size: 20px;margin-right:5px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="{{ $data->jobReleatedUser['userInfo']['aadhaar_img_back'] }}" download><button class="btn btn-info">Download</button></a></div>
                    </div><hr>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12"><strong>Licence/Voter Id Number: </strong><br><p>{{ $data->jobReleatedUser['userInfo']['licence_or_voter_id_number'] }}</p></div>
                    </div><br>
                    
                  </div>
                  <div class="col-sm-4">
                    <strong>Profile Photo: </strong><br><img src="{{ $data->jobReleatedUser['profile_pic'] }}" alt="Profile Photo" style="width: 100:height:auto;"><br>
                    <center><a href="{{ $data->jobReleatedUser['profile_pic'] }}" download><button class="btn btn-info" style="margin-top: 50px;">Download</button></a></center>
                  </div>
                </div>
                <div class="container-fluid">
                      <div class="row">
                      <b style="border-bottom:ridge;">Documents:</b><br>
                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6"><strong>10th Marksheet: </strong><br>
                          <a href="{{ $data->jobReleatedUser['userQualification']['tenth_doc_image'] }}" target="_blank" style="font-size: 20px;margin-right:20px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ $data->jobReleatedUser['userQualification']['tenth_doc_image'] }}" download><button class="btn btn-info">Download</button></a></div>
                        <div class="col-md-4 col-sm-4 col-xs-6"><strong>12th Marksheet: </strong><br>
                          <a href="{{ $data->jobReleatedUser['userQualification']['tweleth_doc_image'] }}" target="_blank" style="font-size: 20px;margin-right:20px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ $data->jobReleatedUser['userQualification']['tweleth_doc_image'] }}" download><button class="btn btn-info">Download</button></a></div>
                        <div class="col-md-4 col-sm-4 col-xs-6"><strong>Diploma Certificate: </strong><br>
                          <a href="{{ $data->jobReleatedUser['userQualification']['diploma_doc_image'] }}" target="_blank" style="font-size: 20px;margin-right:20px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ $data->jobReleatedUser['userQualification']['diploma_doc_image'] }}" download><button class="btn btn-info">Download</button></a></div>
                      </div><hr>
                      <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6"><strong>Caste Certificate: </strong><br>
                          <a href="{{ $data->jobReleatedUser['userQualification']['caste_certificate'] }}" target="_blank" style="font-size: 20px;margin-right:20px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ $data->jobReleatedUser['userQualification']['caste_certificate'] }}" download><button class="btn btn-info">Download</button></a></div>
                        <div class="col-md-4 col-sm-4 col-xs-6"><strong>Graguation: </strong><br>
                          <a href="{{ $data->jobReleatedUser['userQualification']['graguation'] }}" target="_blank" style="font-size: 20px;margin-right:20px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ $data->jobReleatedUser['userQualification']['graguation'] }}" download><button class="btn btn-info">Download</button></a></div>
                        <div class="col-md-4 col-sm-4 col-xs-6"><strong>Post Graguation: </strong><br>
                          <a href="{{ $data->jobReleatedUser['userQualification']['post_graguation'] }}" target="_blank" style="font-size: 20px;margin-right:20px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ $data->jobReleatedUser['userQualification']['post_graguation'] }}" download><button class="btn btn-info">Download</button></a></div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12"><strong>Other Document: </strong><br>
                          <a href="{{ $data->jobReleatedUser['userQualification']['others'] }}" target="_blank" style="font-size: 20px;margin-right:20px;" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          <a href="{{ $data->jobReleatedUser['userQualification']['others'] }}" download><button class="btn btn-info">Download</button></a></div>
                      </div>

                      <div class="row" style="margin-top: 50px;margin-bottom: 50px;">
                        <center>
                        @if($data->amount_status == 'paid')
                          @if($data->status != 'completed' && $data->status != 'reject')
                          <button class="btn btn-info" onclick="markAsPay('{{ $data->id }}')" disabled="">Mark As Paid</button>
                          <button class="btn btn-primary" style="background-color: green;color: white;" onclick="uploadDoc()">Mark As Complete</button>
                          @endif
                        @else
                          <button class="btn btn-info" onclick="markAsPay('{{ $data->id }}')">Mark As Paid</button>
                          <button class="btn btn-primary" style="background-color: green;color: white;" disabled="">Mark As Complete</button>
                        @endif
                        @if($data->status != 'completed' && $data->status != 'reject')
                        `<button class="btn btn-danger" onclick="rejectRequest()">Reject</button>
                        @endif
                        </center>
                      </div>
                      @if($data->status == 'completed')
                        <div class="row" style="margin-bottom: 30px;">
                          <center><strong>Wait For User Satisfaction: 
                            @if($data->verified_by_user == 'No')
                              <span style="color: red;">{{ $data->verified_by_user }}</span>
                            @else
                              <span style="color: blue;">{{ $data->verified_by_user }}</span>
                            @endif
                          </strong>
                          </center>
                        </div>
                      @endif
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
  function markAsPay(id) {
    document.getElementById('loader').style.display ="block";
    swal({
        title: "Are you sure?",
        text: "Has collected payment for this request.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                method:'post',
                url   : "{{ url('admin/manage/job/mark-as-pay') }}",
                data  : {
                    "_token": "{{ csrf_token() }}",
                    'id'    : id
                },
                success: function(data){
                    document.getElementById('loader').style.display ="none";
                    swal("", data, "success");
                    location.reload();
                }
            });
        }else {
            document.getElementById('loader').style.display ="none";
        }
    });
    
  }

  function uploadDoc() {
    $('#myModal').modal('toggle');
  }

  function rejectRequest() {
    $('#rejectModel').modal('toggle');
  }
  CKEDITOR.replace( 'region' );
</script>
@endpush
@endsection