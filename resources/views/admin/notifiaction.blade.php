@extends('front.admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <h4>Notification</h4>
            </div>
            <!-- Main content -->
            <section class="notification-section bg-white global-shadow">
                <div class="notification-listing">
                    <ul>
                        @foreach ($notifications as $notification) 
                        @if(!$notification)
                            <li style="background-color: lightgray;">
                                <p>{{ $notification->data['message'] }}</p>
                                <span>5 mins ago</span>
                                <div class="notification-btn">
                                    <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/mail-blue-border-icon.svg" alt="Mail Icon" /></a>
                                    <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/delete-blue-icon.svg" alt="Delete Icon" /></a>
                                </div>
                            </li>
                        @else
                            <li>
                                <p>{{ $notification->data['message'] }}</p>
                                <span>5 mins ago</span>
                                <div class="notification-btn">
                                    <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/mail-blue-border-icon.svg" alt="Mail Icon" /></a>
                                    <a href="javascript:void(0);"><img src="{{ asset('/') }}public/dist/images/delete-blue-icon.svg" alt="Delete Icon" /></a>
                                </div>
                            </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
@endsection
