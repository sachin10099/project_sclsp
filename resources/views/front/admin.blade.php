<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To S.C.L.S.P</title>
    <!-- Tell the browser to be responsive to screen width -->
    <!-- Bootstrap 3.3.7 -->
    <!-- Favicons -->
     <link href="{{ asset('/') }}public/assets/img/logo/logo.png" rel="icon">
    <link rel="stylesheet" href="{{ asset('/') }}public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}public/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- Scroll CSS -->
    <link href="{{ asset('/') }}public/dist/css/jquery.mCustomScrollbar.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Style CSS -->
    <link href="{{ asset('/') }}public/frontend/css/global.css" rel="stylesheet">
    <link href="{{ asset('/') }}public/dist/css/admin-style.css" rel="stylesheet">
    <link href="{{ asset('/') }}public/dist/css/admin-responsive.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style type="text/css">
    /* Absolute Center Spinner */
        .loading {
          position: fixed;
          z-index: 999;
          height: 2em;
          width: 2em;
          overflow: show;
          margin: auto;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
          content: '';
          display: block;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
            background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

          background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
          /* hide "loading..." text */
          font: 0/0 a;
          color: transparent;
          text-shadow: none;
          background-color: transparent;
          border: 0;
        }

        .loading:not(:required):after {
          content: '';
          display: block;
          font-size: 10px;
          width: 1em;
          height: 1em;
          margin-top: -0.5em;
          -webkit-animation: spinner 150ms infinite linear;
          -moz-animation: spinner 150ms infinite linear;
          -ms-animation: spinner 150ms infinite linear;
          -o-animation: spinner 150ms infinite linear;
          animation: spinner 150ms infinite linear;
          border-radius: 0.5em;
          -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
        box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
          0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
        @-moz-keyframes spinner {
          0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
        @-o-keyframes spinner {
          0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
        @keyframes spinner {
          0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
          }
          100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
        #users-table{
          width: auto !important;
        }
        #users-table_wrapper {
          background-color: #F1F1F1 !important;
        }
        .notification {
          color: white;
          text-decoration: none;
          padding: 15px 26px;
          position: relative;
          display: inline-block;
          border-radius: 2px;
        }

        .notification:hover {
          background: red;
        }

        .notification .badge {
          position: absolute;
          top: -10px;
          right: -10px;
          padding: 5px 10px;
          border-radius: 50%;
          background-color: red;
          color: white;
        }
  </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ url('admin/dashboard') }}" class="logo bg-white">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="{{ asset('/') }}public/assets/img/logo/logo.png" alt="Logo" /></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="{{ asset('/') }}public/assets/img/logo/logo.png" alt="Logo" /></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
              <!-- Sidebar toggle button-->
              <a href="#" data-toggle="push-menu" role="button">
                  <i class="fa fa-bars" aria-hidden="true" style="font-size:25px;margin-top: 3px;margin-left: 11px;"></i>
              </a>      
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="{{ url('admin/notification/list') }}" class="notification">
                                <i><span><img src="{{ asset('/') }}public/dist/images/bell-blue-icon.svg" alt="Notification Icon" /></span></i>
                                <span class="badge">{{ \Auth::user()->unreadnotifications()->count() }}</span>
                            </a>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs">{{ \Auth::user()->name }}</span>
                                @if(\Auth::user()->profile_pic)
                                    <img src="{{ \Auth::user()->profile_pic }}" class="user-image" alt="User Image">
                                @else
                                    <img src="{{ asset('/') }}public/assets/img/default.png" class="user-image" alt="User Image">
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li><a href="{{ url('admin/profile') }}">Profile</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/logout') }}">
                                        Sign out
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar bg-dark-red">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                        <a href="{{ url('admin/dashboard') }}"><span>Dashboard</span></a>
                    </li>
                    @can('check-admin')
                    <li class="{{ (request()->is('admin/banner/list')) || (request()->is('admin/why-choose/list')) || (request()->is('admin/service/list')) || (request()->is('admin/about/list')) || (request()->is('admin/scopes/list')) ||  (request()->is('admin/testimonial/list')) || (request()->is('admin/testimonial/list')) || (request()->is('admin/team/list')) || (request()->is('admin/faq/list')) || (request()->is('admin/contact/list')) || (request()->is('admin/social/link')) ? 'active' : '' }}">
                        <a  class="dropdown-btn" data-toggle="collapse" data-target="#demo2"><span >Home Management &nbsp;<i class="fa fa-angle-down"></i></span></a>
                        <div class="dropdown-container collapse" id="demo2">
                           <ul style="color: white;">
                                <li class="{{ (request()->is('admin/banner/list')) ? 'active' : '' }}" >
                                    <a href="{{ url('admin/banner/list') }}"><span>Manage Banner</span></a>
                                </li>
                                <li class="{{ (request()->is('admin/why-choose/list')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/why-choose/list') }}"><span>Why Us Content</span></a>
                                </li> 
                                <li class="{{ (request()->is('admin/service/list')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/service/list') }}"><span>Manage Services</span></a>
                                </li> 
                                <li class="{{ (request()->is('admin/about/list')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/about/list') }}"><span>Manage About Content</span></a>
                                </li> 
                                <li class="{{ (request()->is('admin/scopes/list')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/scopes/list') }}"><span>Manage Scopes</span></a>
                                </li> 
                                <li class="{{ (request()->is('admin/testimonial/list')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/testimonial/list') }}"><span>Manage Testimonials</span></a>
                                </li>
                                <li class="{{ (request()->is('admin/team/list')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/team/list') }}"><span>Manage Team</span></a>
                                </li>
                                <li class="{{ (request()->is('admin/faq/list')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/faq/list') }}"><span>Manage Faq's</span></a>
                                </li>
                                <li class="{{ (request()->is('admin/contact/list')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/contact/list') }}"><span>Manage Contact</span></a>
                                </li>
                                <li class="{{ (request()->is('admin/social/link')) ? 'active' : '' }}">
                                    <a href="{{ url('admin/social/link') }}"><span>Manage Social Links</span></a>
                                </li>
                           </ul>
                        </div>
                    </li> 
                    <li class="{{ (request()->is('admin/jobs/list-view')) ? 'active' : '' }}">
                        <a href="{{ url('admin/jobs/list-view') }}"><span>Manage Jobs</span></a>
                    </li>  
                    <li class="{{ (request()->is('admin/admission/list-view')) || (request()->is('admin/admission/create')) ? 'active' : '' }}">
                        <a href="{{ url('admin/admission/list-view') }}"><span>Manage Admissions</span></a>
                    </li>  
                    <li class="{{ (request()->is('admin/applied/jobs')) ? 'active' : '' }}">
                        <a href="{{ url('admin/applied/jobs') }}"><span>Manage Applied Request(s)</span></a>
                    </li>  
                    <li class="{{ (request()->is('form-filler/admit-card/list')) || (request()->is('form-filler/admit-card/add'))  ? 'active' : '' }}">
                        <a href="{{ url('form-filler/admit-card/list') }}"><span>Manage Admit Card</span></a>
                    </li>
                    <li class="{{ (request()->is('form-filler/answer-key/list')) || (request()->is('form-filler/admit-card/add'))  ? 'active' : '' }}">
                        <a href="{{ url('form-filler/answer-key/list') }}"><span>Manage Answer Keys</span></a>
                    </li>
                    <li class="{{ (request()->is('form-filler/results/list')) || (request()->is('form-filler/results/list'))  ? 'active' : '' }}">
                        <a href="{{ url('form-filler/results/list') }}"><span>Manage Results</span></a>
                    </li>
                    <li class="{{ (request()->is('admin/manage/terms')) ? 'active' : '' }}">
                        <a href="{{ url('admin/manage/terms') }}"><span>Manage Terms & Conditions</span></a>
                    </li>
                    <li class="{{ (request()->is('admin/notice/list-view')) ? 'active' : '' }}">
                        <a href="{{ url('admin/notice/list-view') }}"><span>Manage Notices</span></a>
                    </li>
                    <li class="{{ (request()->is('admin/manage/privecy-policy')) ? 'active' : '' }}">
                        <a href="{{ url('admin/manage/privecy-policy') }}"><span>Privacy policy</span></a>
                    </li>
                    <li class="{{ (request()->is('admin/query/list')) ? 'active' : '' }}">
                        <a href="{{ url('admin/query/list') }}"><span>Support Section</span></a>
                    </li>
                    @endcan
                    @can('check-operator')
                    <li class="{{ (request()->is('admin/manage/job/view')) ? 'active' : '' }}">
                        <a href="{{ url('admin/manage/job/view') }}"><span>Manage Jobs Request(s)</span></a>
                    </li>
                    <li class="{{ (request()->is('admin/manage/job/own-list')) ? 'active' : '' }}">
                        <a href="{{ url('admin/manage/job/own-list') }}"><span>Manage Accepted Request(s)</span></a>
                    </li>
                    <li class="{{ (request()->is('admin/query/list')) ? 'active' : '' }}">
                        <a href="{{ url('admin/query/list') }}"><span>Support Section</span></a>
                    </li>
                    @endcan
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        @yield('content')
            <!-- jQuery 3 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('/') }}public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}public/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/') }}public/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}public/dist/js/demo.js"></script>
    <script src="{{ asset('/') }}public/frontend/js/custom.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/') }}public/frontend/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        setTimeout(function(){ 
            document.getElementById("hideAlert").style.display  = "none";
        }, 5000);
    </script>
    @stack('scripts')
</body>

</html>