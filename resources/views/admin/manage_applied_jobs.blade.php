@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="row">
    	<div class="col-sm-4">
    		<div class="content-header">
		        <h4>Manage Applied Jobs</h4>
		    </div>
    	</div>
    </div>
    <br>
    @if(session()->has('success'))
        <div class="alert alert-success" id="hideAlert">
            {{ session()->get('success') }}
        </div>
    @endif
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
    <div class="loading" id="loader">Loading&#8230;</div>

     <!--  End loader Content -->
    <section class="content manage-company-user-section">
        <div class="tab-section">
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="table-section">
                        <div class="table-responsive">
                            <table id="users-table">
                                <thead>
                                    <tr>
                                        <th width="1%">Order Id</th>
                                        <th>Job Title</th>
                                        <th>Job Published date</th>
                                        <th>Applicant Name</th>
                                        <th>Applicant Email</th>
                                        <th>Applicant Contact</th>
                                        <th>Job Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
@push('scripts')
<script type="text/javascript">
  var datatable;
  $(document).ready(function() {
      document.getElementById('loader').style.display = "none";
        datatable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('admin/manage/applied/job/list') !!}', 
        "aoColumnDefs": [ {
               "aTargets": [ 2 ],
               "mRender": function ( data, type, full ) {
                return $("<div/>").html(data).text(); 
                }
            } ],
        order:[
          [0,"DESC"]
        ],
        columns: [
            { data: 'order_id', name: 'order_id' },
            { data: 'job_title', name: 'job_title' },
            { data: 'publish', name: 'publish'},
            { data: 'applicant_name', name: 'applicant_name' },
            { data: 'applicant_email', name: 'applicant_email' },
            { data: 'applicant_contact', name: 'applicant_contact' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
           
        ]
    });
  });

  
  function acceptRequest(id) {
    $.ajax({
          method:'post',
          url   : "{{ url('admin/manage/job/accept-request') }}",
          data  : {
              "_token": "{{ csrf_token() }}",
              'id'    : id
          },
          success: function(data){
            if(data == 'already_accepted') {
              swal("", 'Already Accepted By Other Operator', "error");
              datatable.ajax.reload();
              return false;
            }
            swal("", data, "success");
            datatable.ajax.reload();
          }
      });
  }
</script>
@endpush
@endsection