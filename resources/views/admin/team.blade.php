@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h4>Manage Team</h4>
    </div>
    <button class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Add Team Members</button><br>
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
          <div class="modal-header" style="margin-top: 100px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Team Member</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ url('admin/team/add') }}" enctype="multipart/form-data">
                @csrf
                <div class="profile-box d-flex align-items-center justify-content-between">
                    <div class="edit-profile-box">
                        <div class="browse-image-box">
                            <label class=newbtn>
                                    <img src="{{ asset('/') }}public/dist/images/imgdefault.png" class="blah" alt="Profile Image" />
                                <span>
                                    <input id="pic" name="image" class='pis' onchange="readURL(this);" type="file">
                                </span>
                            </label>
                        </div>
                        @if($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                    
                </div>
                <div class="row">
                            <div class="col-sm-12">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                                @if($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation">
                                @if($errors->has('designation'))
                                    <span style="color: red;">{{ $errors->first('designation') }}</span>
                                @endif
                               
                               
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <label>Facebook Link</label>
                                <input type="text" class="form-control" name="facebook">
                                @if($errors->has('facebook'))
                                    <span style="color: red;">{{ $errors->first('facebook') }}</span>
                                @endif       
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <label>Twitter Link</label>
                                <input type="text" class="form-control" name="twitter">
                                @if($errors->has('twitter'))
                                    <span style="color: red;">{{ $errors->first('twitter') }}</span>
                                @endif       
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <label>Insta Link</label>
                                <input type="text" class="form-control" name="insta">
                                @if($errors->has('insta'))
                                    <span style="color: red;">{{ $errors->first('insta') }}</span>
                                @endif       
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <label>LinkedIn Link</label>
                                <input type="text" class="form-control" name="LinkedIn">
                                @if($errors->has('LinkedIn'))
                                    <span style="color: red;">{{ $errors->first('LinkedIn') }}</span>
                                @endif       
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
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Facebook Link</th>
                                        <th>Twitter Link</th>
                                        <th>Insta Link</th>
                                        <th>LinkedIn Link</th>
                                        <th>Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teams as $team)
                                    <tr>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->designation }}</td>
                                        <td>{{ $team->facebook_link }}</td>
                                        <td>{{ $team->twitter_link }}</td>
                                        <td>{{ $team->insta_link }}</td>
                                        <td>{{ $team->linkedin_link }}</td>
                                        <td width="20%">
                                            @if($team->image)
                                                <img src="{{ $team->image }}" alt="Images" style="width:500px;height: 200px;">
                                            @else 
                                                <img src="{{ asset('/') }}public/dist/images/imgdefault.png" alt="Images" style="width:200px;height: 200px;">
                                            @endif
                                        </td>
                                        <td >
                                        <center>
                                            <a href="{{ url('admin/team').'/'.$team->id }}"><img src="{{ asset('/') }}public/dist/images/edit-blue-icon.svg" alt="Edit Icon" /></a>

                                            <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/delete-blue-icon.svg" onclick="deleteTestimonial('{{ $team->id }}')" alt="Delete Icon" /></a>
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
            text: "Delete this Member.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method:'post',
                    url   : "{{ url('admin/team/delete') }}",
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