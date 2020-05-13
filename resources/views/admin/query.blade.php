@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h4>Manage Queries</h4>
    </div>
    <br>
    @if(session()->has('success'))
        <div class="alert alert-success" id="hideAlert">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Main content -->
   <!-- Loader content -->
   <!-- Modal -->
    <div id="response" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Response By Admin:</h4>
          </div>
          <div class="modal-body">
            <p id="reply"></p>
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
                                        <th>S.No.</th>
                                        <th width="10%">Name</th>
                                        <th width="15%">Email</th>
                                        <th width="40%">Message</th>
                                        <th width="30%">Reply</th>
                                        <th width="5%">Action</th>
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
        order: [[1, 'desc']],
        ajax: '{!! url('admin/query/data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'query', name: 'query' },
            { data: 'reply', name: 'reply',searchable: false},
            { data: 'action', name: 'action', orderable: false, searchable: false}
           
        ]
    });
  });

  function reply(id) {
    var message = $('#comment'+id).val();
    if(message == '') {
      swal("", 'Comment filed must be required.', 'warning');
      return false;
    }
    document.getElementById('loader').style.display = "block";
    $.ajax({
          method:'post',
          url   : "{{ url('admin/reply') }}",
          data  : {
              "_token": "{{ csrf_token() }}",
              'id'    : id,
              'message' : message
          },
          success: function(data){
              document.getElementById('loader').style.display = 'none';
              swal("", data, "success");
              datatable.ajax.reload();
          }
      });
  }
</script>
@endpush
@endsection