@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h4>Manage About Us</h4>
    </div>
    <br>
    @if(session()->has('success'))
        <div class="alert alert-success" id="hideAlert">
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Main content -->
    <section class="content manage-company-user-section">
        <div class="tab-section">
            <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                    <div class="table-section">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Heading</th>
                                        <th>Description</th>
                                        <th>Video URL</th>
                                        <th>Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="20%">{{ $about->heading }}</td>
                                        <td width="30%">{!! $about->desc !!}</td>
                                        <td width="20%">{!! $about->video_url !!}</td>
                                        <td width="30%">
                                            @if($about->image)
                                                <img src="{{ $about->image }}" alt="Images" style="width:600px;height: 300px;">
                                            @else 
                                                <img src="{{ asset('/') }}public/dist/images/imgdefault.png" alt="Images" style="width:70px;height: 70px;">
                                            @endif
                                        </td>
                                        <td >
                                        <center>
                                            <a href="{{ url('admin/about').'/'.$about->id }}"><img src="{{ asset('/') }}public/dist/images/edit-blue-icon.svg" alt="Edit Icon" /></a>
                                        </center>
                                        </td>
                                    </tr>
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
<!-- ./wrapper -->
@endsection