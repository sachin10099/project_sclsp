@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="row">
    	<div class="col-sm-4">
    		<div class="content-header">
		        <h4>Manage Documents</h4>
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
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="table-section">
                        <div class="table-responsive">
                          @if(count($datas) != 0)
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Region Name</th>
                                  <th>Official Link</th>
                                  <th>Document</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($datas as $data)
                                <tr>
                                  <td>{{ $data->region_name }}</td>
                                  <td><a href="{{ $data->official_links }}" target="_blank">{{ $data->official_links }}</a></td>
                                  <td><a href="{{ $data->documents }}" target="_blank">{{ $data->documents }}</a></td>
                                  <td><span onclick="deleteFile('{{$data->id}}')"><i class="fa fa-trash" aria-hidden="true" style="font-size: 20px;color: red;cursor: pointer;" data-toggle="tooltip" title="Delete"></i></span></td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          @else
                          <center><p>No Record(s) Found.</p></center>
                          @endif
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
  document.getElementById('loader').style.display ="none";
  function deleteFile(id) {
    document.getElementById('loader').style.display ="block";
    swal({
        title: "Are you sure?",
        text: "Delete this File",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                method:'post',
                url   : "{{ url('form-filler/answer-key/delete/file') }}",
                data  : {
                    "_token": "{{ csrf_token() }}",
                    'id'    : id
                },
                success: function(data){
                    document.getElementById('loader').style.display ="none";
                    swal("", data, "success");
                    setTimeout(function(){ 
                      location.reload();
                    }, 2000);
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