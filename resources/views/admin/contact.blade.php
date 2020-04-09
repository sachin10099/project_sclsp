@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h4>Manage Contact</h4>
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success" id="hideAlert">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Modal -->
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
                                        <th>Id</th>
                                        <th>Address</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $data['address']['id'] }}</td>
                                        <td>{{ $data['address']['data'] }}</td>
                                        <td >
                                        <center>
                                            <a href="{{ url('admin/contact').'/'.$data['address']['id'] }}"><img src="{{ asset('/') }}public/dist/images/edit-blue-icon.svg" alt="Edit Icon" /></a>
                                        </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-section" style="margin-top: 20px;">
                        <div class="table-responsive">
                             <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['emails'] as $email)
                                    <tr>
                                        <td>{{ $email->id }}</td>
                                        <td>{!! $email->data !!}</td>
                                        <td >
                                        <center>
                                            <a href="{{ url('admin/contact').'/'.$email->id }}"><img src="{{ asset('/') }}public/dist/images/edit-blue-icon.svg" alt="Edit Icon" /></a>
                                        </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-section" style="margin-top: 20px;">
                        <div class="table-responsive">
                            
                            <table>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Contact Numbers</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['contacts'] as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{!! $contact->data !!}</td>
                                        <td >
                                        <center>
                                            <a href="{{ url('admin/contact').'/'.$contact->id }}"><img src="{{ asset('/') }}public/dist/images/edit-blue-icon.svg" alt="Edit Icon" /></a>
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