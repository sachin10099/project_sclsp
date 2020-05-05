@extends('front.admin')
@section('content')

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Answer Key Related Files</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Region Name</th>
              <th>Official Link</th>
              <th>Document</th>
            </tr>
          </thead>
          <tbody id="file_list">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div id="addFile" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Files</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ url('form-filler/answer-key/upload-file') }}" enctype="multipart/form-data">
            @csrf
            <label>Region Name:</label><br>
            <input type="hidden" name="card_key_id" id="card_key_id">
            <input type="text" name="region_name" class="form-control" placeholder="Enter Region Name" value="{{ old('region_name') }}">
            @if($errors->has('region_name'))
                <span style="color: red;">{{ $errors->first('region_name') }}</span>
                <script type="text/javascript">
                  setTimeout(function(){ 
                    $('#addFile').modal('show');
                  }, 1000);
                </script>
            @endif
            <br><br>
            <label>Official Link (Optional):</label><br>
            <input type="text" name="link" placeholder="Official Link Here" class="form-control" value="{{ old('link') }}">
            @if($errors->has('link'))
                <span style="color: red;">{{ $errors->first('link') }}</span>
                <script type="text/javascript">
                  setTimeout(function(){ 
                    $('#addFile').modal('show');
                  }, 1000);
                </script>
            @endif
            <br><br>
            <label>Upload File:</label>
            <input type="file" name="file" placeholder="Official Link Here">
            @if($errors->has('file'))
                <span style="color: red;">{{ $errors->first('file') }}</span>
                <script type="text/javascript">
                  setTimeout(function(){ 
                    $('#addFile').modal('show');
                  }, 1000);
                </script>
            @endif
            <br><br>
            <input type="submit" class="btn btn-info" value="SAVE">
          </form>
          
        </div>
      </div>

    </div>
  </div>
    <!-- Content Header (Page header) -->
    <div class="row">
    	<div class="col-sm-4">
    		<div class="content-header">
		        <h4>Manage Answer Keys</h4>
		    </div>
    	</div>
    	<div class="col-sm-8">
        <div class="btn-group pull-right">
          <a href="{{ url('form-filler/answer-key/add') }}"><button type="button" class="btn btn-info">Add Answer Keys</button></a>
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
        ajax: '{!! url('form-filler/answer-key/data') !!}', 
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
          url   : "{{ url('form-filler/answer-key/change-status') }}",
          data  : {
              "_token": "{{ csrf_token() }}",
              'id'    : id,
          },
          success: function(data){
            if(data == 'notfound') {
              swal("", 'Have one file to publish, please add atleast one file.', "warning");
              return false;
            }
            swal("", data, "success");
            datatable.ajax.reload();
          }
      });
  }

  function deleteJob(id) {
    document.getElementById('loader').style.display ="block";
    swal({
        title: "Are you sure?",
        text: "Delete this Answer Key.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                method:'post',
                url   : "{{ url('form-filler/admit-card/delete') }}",
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

  function addFile(id) {
     $('#addFile').modal('show');
     document.getElementById('card_key_id').value = id;
  }

  function listOfFile(id) {
    $.ajax({
          method:'post',
          url   : "{{ url('form-filler/answer-key/files') }}",
          data  : {
              "_token": "{{ csrf_token() }}",
              'id'    : id,
          },
          success: function(data){
            var html;
            for (var i = 0; i < data.length; i++) {
              console.log(data[i]);
              html += '<tr><td>'+data[i]['region_name']+'</td><a href="'+data[i]['official_links']+'" target="_blank"><td>'+data[i]['official_links']+'</td></a><a href="'+data[i]['documents']+'" target="_blank"><td>'+data[i]['documents']+'</td></a></tr>';
            }
            $('#file_list').append(html);
            $('#myModal').modal('show');
          }
      });
     
  }
</script>
@endpush
@endsection