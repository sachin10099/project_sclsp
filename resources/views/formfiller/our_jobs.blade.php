@extends('front.formfiller_dashboard')
@section('content')
<!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <center><h3 class="modal-title">More Details</h3></center>
          </div>
          <div class="modal-body">
            <br>
            <strong>Vacancy</strong>
            <p id="vacancy"></p>
            <br>
            <strong>Feature Image URl:</strong>
            <p id="image"></p>
            <br>
            <strong>Job Description:</strong>
            <p id="desc"></p>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
<div class="content">
<div class="container-fluid">
  <div class="btn-group">
    <button type="button" class="btn btn-info" onclick="changeStatus('ongoing')">Under Process</button>
    <button type="button" class="btn btn-info" onclick="changeStatus('completed')">Completed</button>
    <button type="button" class="btn btn-info" onclick="changeStatus('rejected')">Rejected</button>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">Manage Jobs</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="users-table">
				<thead class=" text-primary">
					<th>S.No.</th>
					<th>Job Title</th>
					<th>State</th>
					<th>Job Location</th>
					<th>Job Type</th>
					<th>Published date</th>
					<th>End date</th>
          <th>Image</th>
					<th>Action</th>
				</thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  var status = 'ongoing';
	var datatable;
  $(document).ready(function() {
      datatable = $('#users-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: { url: '{!! url('form-filler/user/jobs') !!}',
           data: function (d) {
           return $.extend( {}, d, {
                 "status": status
              });         
          }
      },
      order:[
        [0,"DESC"]
      ],
      columns: [
          { data: 'id', name: 'id' },
          { data: 'title', name: 'title' },
          { data: 'state_name', name: 'state_name' },
          { data: 'job_location', name: 'job_location' },
          { data: 'job_type', name: 'job_type' },
          { data: 'publish', name: 'publish' },
          { data: 'end', name: 'end' },
          { data: 'image', name: 'image' },
          { data: 'action', name: 'action', orderable: false, searchable: false}
           
        ]
    });
  });

  function changeStatus(type) {
      status = type;
      datatable.ajax.reload();
  }

</script>
@endsection