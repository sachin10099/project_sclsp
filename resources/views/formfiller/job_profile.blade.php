@extends('front.formfiller_dashboard')
@section('content')

<!-- Model --> 
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
<!-- End Model -->

<section class="site-section" style="margin-top: 100px;">
<center><h3>Job Details</h3></center>
<div class="container">
<div class="row">
  <div class="col-lg-8">
    <div class="mb-5">
      <figure class="mb-5">
      	@if($data->feature_image)
      		<img src="{{ $data->feature_image }}"  alt="Image" class="img-fluid rounded">
  		@else
  			<img src="{{ asset('/') }}public/asset2/images/default.png" alt="Image" class="img-fluid rounded">
  		@endif
      	
      </figure>
      <h3 class="h5 d-flex align-items-center mb-4 text-primary">Job Description</h3>
      <p>{!! $data->job_desc !!}</p>
    </div>


  </div>
  <div class="col-lg-4">
    <div class="bg-light p-3 border rounded mb-4">
      <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
      <ul class="list-unstyled pl-3 mb-0">
        <li class="mb-2"><strong class="text-black">Published on:</strong> {{ date('d-m-Y', strtotime($data->job_published)) }}</li>
        <li class="mb-2"><strong class="text-black">Vacancy:</strong> {{ $data->vacancy }}</li>
        <li class="mb-2"><strong class="text-black">Employment Status:</strong> {{ $data->job_type }}</li>
        <li class="mb-2"><strong class="text-black">State:</strong> {{ $data->getState['name'] }}</li>
        <li class="mb-2"><strong class="text-black">Job Location:</strong> {{ $data->job_location }}</li>
        <li class="mb-2"><strong class="text-black">Gender:</strong> Any</li>
        <li class="mb-2"><strong class="text-black">Application Deadline:</strong> {{ date('d-m-Y', strtotime($data->job_deadline)) }}</li>
        <li class="mb-2"><strong class="text-primary">Application Fees</strong> 
        <br><b>General: </b><strong>Rs {{ $data->price }} + {{ $fees }}, Total = Rs {{ $data->price+$fees }} /-</strong>
        <br><b>OBC: </b><strong>Rs {{ $data->obc_fees }} + {{ $fees }}, Total = Rs {{ $data->obc_fees+$fees }} /-</strong>
        <br><b>SC/ST: </b><strong>Rs {{ $data->sc_st_fees }} + {{ $fees }}, Total = Rs {{ $data->sc_st_fees+$fees }} /-</strong>
      </li>
      </ul>
    </div>
    <div class="">
        <a href="#" class="btn btn-block btn-primary btn-md" onclick="applyJob('{{ $data->id }}', '{{ $data->price }}')">Apply Now</a>
    </div>
  </div>
</div>
</div>
</section>
<script type="text/javascript">
   function applyJob(id, amount) {
    document.getElementById('loader').style.display ="block";
    swal({
        title: "Are you sure?",
        text: "Apply this job",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                method:'post',
                url   : "{{ url('form-filler/job/apply') }}",
                data  : {
                    "_token": "{{ csrf_token() }}",
                    'id'     : id,
                    'amount' : amount
                },
                success: function(data){
                  document.getElementById('loader').style.display ="none";
                  if(data == 'unpaid') {
                    window.location = '{{ url('form-filler/job/checkout') }}'+'/'+amount;
                  }
                  if(data == 'applied') {
                    swal("You Already Applied on This job", "", "warning");
                    return false
                  }
                  window.location = '{{ url('form-filler/job/checkout') }}'+'/'+id; 
                    
                }
            });
        }else {
            document.getElementById('loader').style.display ="none";
        }
    });
  }
</script>
@endsection