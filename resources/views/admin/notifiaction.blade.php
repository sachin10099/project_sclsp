@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Notifications</h4>
            </div>
            <!-- Main content -->
            <section class="notification-section bg-white global-shadow">
                <div class="notification-listing">
                    <ul>
                        @if(count($notifications) != 0)
                            @foreach ($notifications as $notification) 
                            @if(\Auth::user()->type != 'admin')
                                @if(!$notification->read_at)
                                    <li style="background-color: lightgray;">
                                        <p>{{ $notification->data['message'] }}</p>  
                                        <span>5 mins ago</span>
                                        <div class="notification-btn">
                                            <a href="{{ url('admin/notification/read/') }}/{{ $notification->id }}/{{ $notification->data['data']['id'] }}"><img src="{{ asset('/') }}public/dist/images/mail-blue-border-icon.svg" alt="Mail Icon" onclick="readNotification('{{$notification->id}}')" /></a>
                                            <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/delete-blue-icon.svg" alt="Delete Icon" onclick="deleteNotification('{{$notification->id}}')" /></a>
                                        </div>
                                    </li>
                                @else
                                    <li>
                                        <p>{{ $notification->data['message'] }}</p>
                                        <span>5 mins ago</span>
                                        <div class="notification-btn">
                                            <a href="{{ url('admin/notification/read/') }}/{{ $notification->id }}/{{ $notification->data['data']['id'] }}"><img src="{{ asset('/') }}public/dist/images/mail-blue-border-icon.svg" alt="Mail Icon" onclick="readNotification('{{$notification->id}}')" /></a>
                                            <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/delete-blue-icon.svg" alt="Delete Icon" onclick="deleteNotification('{{$notification->id}}')" /></a>
                                        </div>
                                    </li>
                                @endif
                            @else
                                @if(!$notification->read_at)
                                    <li style="background-color: lightgray;">
                                        <p>{{ $notification->data['message'] }}</p>  
                                        <span>5 mins ago</span>
                                        <div class="notification-btn">
                                            <a href="{{ url('admin/notification/read/') }}/{{ $notification->id }}"><img src="{{ asset('/') }}public/dist/images/mail-blue-border-icon.svg" alt="Mail Icon" onclick="readNotification('{{$notification->id}}')" /></a>
                                            <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/delete-blue-icon.svg" alt="Delete Icon" onclick="deleteNotification('{{$notification->id}}')" /></a>
                                        </div>
                                    </li>
                                @else
                                    <li>
                                        <p>{{ $notification->data['message'] }}</p>
                                        <span>5 mins ago</span>
                                        <div class="notification-btn">
                                            <a href="{{ url('admin/notification/read/') }}/{{ $notification->id }}"><img src="{{ asset('/') }}public/dist/images/mail-blue-border-icon.svg" alt="Mail Icon" onclick="readNotification('{{$notification->id}}')" /></a>
                                            <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/delete-blue-icon.svg" alt="Delete Icon" onclick="deleteNotification('{{$notification->id}}')" /></a>
                                        </div>
                                    </li>
                                @endif 

                            @endif
                            @endforeach
                        @else
                            <center><p>No data(s) found.</p></center>
                        @endif
                    </ul>
                </div>
                <!-- Loader content -->
                    <div class="loading" id="loader">Loading&#8230;</div>
                <!--  End loader Content -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <script type="text/javascript">
        document.getElementById('loader').style.display ="none";
        function deleteNotification(id) {
        document.getElementById('loader').style.display ="block";
        swal({
            title: "Are you sure?",
            text: "Delete this Notification.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    method:'post',
                    url   : "{{ url('admin/notification/delete') }}",
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
            }else {
                document.getElementById('loader').style.display ="none";
            }
        });
        
    }


    function readNotification(id) {
        document.getElementById('loader').style.display ="block";
        $.ajax({
            method:'post',
            url   : "{{ url('admin/notification/read') }}",
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
    }
    </script>
@endsection
