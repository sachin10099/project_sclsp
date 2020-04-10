@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h4>Manage Faq's</h4>
    </div>
    <button class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Add Faq's</button><br>
    <br>
    @if(session()->has('success'))
        <div class="alert alert-success" id="hideAlert">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Modal -->
    <div id="myModal" class="modal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Faq's</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ url('admin/faq/add') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <label>Question</label>
                        <input type="text" class="form-control" name="question">
                        @if($errors->has('question'))
                            <span style="color: red;">{{ $errors->first('question') }}</span>
                        @endif
                    </div>
                    <div class="col-sm-12">
                        <br>
                        <label>Answer</label>
                        @if($errors->has('answer'))
                            <span style="color: red;">{{ $errors->first('answer') }}</span>
                        @endif
                        <br>
                        <textarea name="desc"></textarea>
                    </div>
                </div>
                </div>
            <input type="submit" class="btn btn-info" style="margin-top: 50px;">
        </form>
        </div>

      </div>
    </div>

    <!-- Main content -->
    <section class="content manage-company-user-section">
        <div class="tab-section">
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="table-section">
                        <div class="table-responsive">
                            <!-- Loader content -->
                                <div class="loading" id="loader">Loading&#8230;</div>
                            <!--  End loader Content -->
                            <table>
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($queries as $query)
                                    <tr>
                                        <td width="20%">{{ $query->question }}</td>
                                        <td>{!! $query->answer !!}</td>
                                        <td >
                                        <center>
                                            <a href="{{ url('admin/faq').'/'.$query->id }}"><img src="{{ asset('/') }}public/dist/images/edit-blue-icon.svg" alt="Edit Icon" /></a>

                                            <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/delete-blue-icon.svg" onclick="deleteTestimonial('{{ $query->id }}')" alt="Delete Icon" /></a>
                                        </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
<script type="text/javascript">
    document.getElementById('loader').style.display ="none";
    function deleteTestimonial(id) {
        document.getElementById('loader').style.display ="block";
        swal({
            title: "Are you sure?",
            text: "Delete this Question.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method:'post',
                    url   : "{{ url('admin/faq/delete') }}",
                    data  : {
                        "_token": "{{ csrf_token() }}",
                        'id'    : id
                    },
                    success: function(data){
                        document.getElementById('loader').style.display ="none";
                        swal("", data, "success");
                        setTimeout(function(){ 
                            location.reload()
                        }, 2000);
                    }
                });
            } else {
                document.getElementById('loader').style.display ="none";
            }
        });
        
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.blah')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    CKEDITOR.replace( 'desc' );
</script>
<!-- ./wrapper -->
@endsection