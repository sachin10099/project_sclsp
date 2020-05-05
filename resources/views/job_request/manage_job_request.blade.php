@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="row">
    	<div class="col-sm-4">
    		<div class="content-header">
		        <h4>Manage Jobs</h4>
		    </div>
    	</div>
    	<div class="col-sm-8">
    		<a href="{{ url('admin/jobs/post') }}"><button class="btn btn-info pull-right">Post New Job</button></a>
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
                                        <th width="1%">Job Id</th>
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
        ajax: '{!! url('admin/manage/job/list') !!}', 
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
            { data: 'job_id', name: 'job_id' },
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

  function showMore(id) {
    $.ajax({
          method:'post',
          url   : "{{ url('admin/jobs/list') }}",
          data  : {
              "_token": "{{ csrf_token() }}",
              'id'    : id
          },
          success: function(data){
            document.getElementById('vacancy').innerHTML = data.vacancy;
            document.getElementById('image').innerHTML = data.feature_image;
            document.getElementById('desc').innerHTML = data.job_desc;
            $('#myModal').modal('show');
          }
      });
  }

  function changeStatus(id) {
    var price = $('#price'+id).val();
    var obc = $('#obc'+id).val();
    var sc = $('#sc'+id).val();
    if(price == '') {
        swal("", "Price field must be required.", "warning");
        return false;
    }
    if(obc == '') {
        swal("", "OBC Fees field must be required.", "warning");
        return false;
    }
    if(sc == '') {
        swal("", "SC/ST Fees field must be required.", "warning");
        return false;
    }
    var remainder = (price % 1);
    if(remainder != 0) {
        swal("", "Price field must be integer.", "warning");
        return false;
    }
    var remainder1 = (obc % 1);
    if(remainder1 != 0) {
        swal("", "OBC Fees field must be integer.", "warning");
        return false;
    }
    var remainder2 = (sc % 1);
    if(remainder2 != 0) {
        swal("", "SC Fees field must be integer.", "warning");
        return false;
    }
    $.ajax({
          method:'post',
          url   : "{{ url('admin/jobs/change-status') }}",
          data  : {
              "_token": "{{ csrf_token() }}",
              'id'    : id,
              'price' : price,
              'obc'   : obc,
              'sc'    : sc
          },
          success: function(data){
            swal("", data, "success");
            datatable.ajax.reload();
          }
      });
  }

  function unPublish(id) {
    $.ajax({
          method:'post',
          url   : "{{ url('admin/jobs/unpublish-job') }}",
          data  : {
              "_token": "{{ csrf_token() }}",
              'id'    : id
          },
          success: function(data){
            swal("", data, "success");
            datatable.ajax.reload();
          }
      });
  }

  function deleteJob(id) {
    document.getElementById('loader').style.display ="block";
    swal({
        title: "Are you sure?",
        text: "Delete this Job.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                method:'post',
                url   : "{{ url('admin/jobs/delete') }}",
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
@endpush
@endsection