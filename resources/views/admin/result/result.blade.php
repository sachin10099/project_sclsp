@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-sm-4">
            <div class="content-header">
                <h4>Manage Results</h4>
            </div>
        </div>
        <div class="col-sm-8">
        <div class="btn-group pull-right">
          <a href="{{ url('form-filler/results/add') }}"><button type="button" class="btn btn-info">Add Result</button></a>
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
                                      <th width="1%">S.No.</th>
                                      <th>Title</th>
                                      <th>Official Link</th> 
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
        ajax: '{!! url('form-filler/results/list-data') !!}', 
        "aoColumnDefs": [ {
               "aTargets": [ 1 ],
               "mRender": function ( data, type, full ) {
                return $("<div/>").html(data).text(); 
                }
            } ],
        order:[
          [0,"DESC"]
        ],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'official_link', name: 'official_link'},
            { data: 'action', name: 'action', orderable: false, searchable: false}
           
        ]
    });
  });

  function changeStatus(id) {
    $.ajax({
          method:'post',
          url   : "{{ url('form-filler/results/change-status') }}",
          data  : {
              "_token": "{{ csrf_token() }}",
              'id'    : id,
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
        text: "Delete this Result.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                method:'post',
                url   : "{{ url('form-filler/results/status/delete') }}",
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