@extends('front.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h4>Manage Services</h4>
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
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                    <tr>
                                        <td width="30%;">{{ $service->heading }}</td>
                                        <td>{!! $service->desc !!}</td>
                                        <td >
                                        <center>
                                            <a href="{{ url('admin/service').'/'.$service->id }}"><img src="{{ asset('/') }}public/dist/images/edit-blue-icon.svg" alt="Edit Icon" /></a>
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
<!-- ./wrapper -->
@endsection