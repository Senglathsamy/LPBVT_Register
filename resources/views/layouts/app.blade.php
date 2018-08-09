<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<!-- Tell the browser to be responsive to screen width -->--}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{--<!-- CSRF Token -->--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LPB VT College')</title>

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/bootstrap/dist/css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="/css/app.css">--}}
    <link rel="stylesheet" href="/css/sweetalert.css">
    {{--<!-- Font Awesome -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/font-awesome/css/font-awesome.min.css">
    {{--<!-- Ionicons -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/Ionicons/css/ionicons.min.css">
    {{--<!-- bootstrap datepicker -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    {{--<!-- iCheck for checkboxes and radio inputs -->--}}
    <link rel="stylesheet" href="/fw_fontend/plugins/iCheck/all.css">
    {{--<!-- Select2 -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/select2/dist/css/select2.min.css">
    {{--<!-- DataTables -->--}}
    <link rel="stylesheet" href="/fw_fontend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    {{--<!-- Theme style -->--}}
    <link rel="stylesheet" href="/fw_fontend/dist/css/AdminLTE.min.css">
    {{--<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->--}}
    <link rel="stylesheet" href="/fw_fontend/dist/css/skins/_all-skins.min.css">
    {{--<!-- Google Font -->--}}
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
    {{--Custom CSS Font Phetsarath--}}
    <link rel="stylesheet" href="/css/custom.css">

    {{--<!-- Scripts -->--}}
    <script>
        window.Laravel = <?php use Carbon\Carbon;echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>LVT</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><B style="font-family: 'Phetsarath_OT';">LPB VT College</B></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/img/user.svg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><B>
                                    @if(!empty(Auth::user()->te_id))
                                        {{ Auth::user()->teacher->te_firstname }} {{ Auth::user()->teacher->te_lastname }}
                                    @else
                                        {{ ucfirst(Auth::user()->username) }}
                                    @endif
                                </B></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/img/user.svg" class="img-circle" alt="User Image">
                                <p>
                                    <B>{{ ucfirst(Auth::user()->username) }}</B>
                                    <small>Login@ {{ Carbon::parse(Auth::user()->last_login)->format('d/m/Y H:i:s') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/profile/{{ Auth::user()->id }}" class="btn bg-green" style="font-family: 'Phetsarath_OT'"><big><i class="ion ion-android-person"></i></big> ຂໍ້ມູນສ່ວນຕົວ</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn bg-red" style="font-family: 'Phetsarath_OT'"><span class="glyphicon glyphicon-log-out"></span> ອອກຈາກລະບົບ
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/img/user.svg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ ucfirst(Auth::user()->username) }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ Request::path() == '/' ? 'active' : '' }} {{ Request::path() == 'home' ? 'active' : '' }} {{ Request::path() == 'report' ? 'active' : '' }} {{ Request::path() == 'manage' ? 'active' : '' }} {{ Request::path() == 'score' ? 'active' : '' }}">
                    <a href="/">
                        <i class="fa fa-dashboard"></i> <span><B>ໜ້າຫຼັກ</B></span>
                        <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                    </a>
                </li>
                @permission(['student-list', 'teacher-list', 'dept-list', 'major-list', 'subject-list', 'degree-list', 'course-list', 'teacher-subject-list'])
                <li class="treeview
                    @if(Request::is('student'))
                    {{ 'active' }}
                    @elseif(Request::is('student/create'))
                    {{ 'active' }}
                    @elseif(Request::is('student/*/edit'))
                    {{ 'active' }}
                    @elseif(Request::is('teacher'))
                    {{ 'active' }}
                    @elseif(Request::is('teacher/create'))
                    {{ 'active' }}
                    @elseif(Request::is('teacher/*/edit'))
                    {{ 'active' }}
                    @elseif(Request::is('dept'))
                    {{ 'active' }}
                    @elseif(Request::is('dept/create'))
                    {{ 'active' }}
                    @elseif(Request::is('dept/*/edit'))
                    {{ 'active' }}
                    @elseif(Request::is('major'))
                    {{ 'active' }}
                    @elseif(Request::is('major/create'))
                    {{ 'active' }}
                    @elseif(Request::is('major/*/edit'))
                    {{ 'active' }}
                    @elseif(Request::is('subject'))
                    {{ 'active' }}
                    @elseif(Request::is('subject/create'))
                    {{ 'active' }}
                    @elseif(Request::is('subject/*/edit'))
                    {{ 'active' }}
                    @elseif(Request::is('degree'))
                    {{ 'active' }}
                    @elseif(Request::is('degree/create'))
                    {{ 'active' }}
                    @elseif(Request::is('degree/*/edit'))
                    {{ 'active' }}
                    @elseif(Request::is('sub_major'))
                    {{ 'active' }}
                    @elseif(Request::is('sub_major/create'))
                    {{ 'active' }}
                    @elseif(Request::is('sub_major/*/edit'))
                    {{ 'active' }}
                    @elseif(Request::is('teacher_subject'))
                    {{ 'active' }}
                    @elseif(Request::is('teacher_subject/create'))
                    {{ 'active' }}
                    @elseif(Request::is('teacher_subject/*/edit'))
                    {{ 'active' }}
                    @else
                    {{ '' }}
                    @endif
                        ">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span><B>ຈັດການຂໍ້ມູນ</B></span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu" style="font-family: 'Phetsarath_OT'">

                        @permission('student-list')
                        <li class="
                        @if(Request::is('student'))
                        {{ 'active' }}
                        @elseif(Request::is('student/create'))
                        {{ 'active' }}
                        @elseif(Request::is('student/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/student"><big><i class="ion ion-university text-teal"></i></big> ຂໍ້ມູນນັກສຶກສາ</a>
                        </li>
                        @endpermission

                        @permission('teacher-list')
                        <li class="
                        @if(Request::is('teacher'))
                        {{ 'active' }}
                        @elseif(Request::is('teacher/create'))
                        {{ 'active' }}
                        @elseif(Request::is('teacher/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/teacher"><big><i class="ion ion-person-stalker text-teal"></i></big> ຂໍ້ມູນອາຈານ</a>
                        </li>
                        @endpermission

                        @permission('course-list')
                        <li class="
                        @if(Request::is('sub_major'))
                        {{ 'active' }}
                        @elseif(Request::is('sub_major/create'))
                        {{ 'active' }}
                        @elseif(Request::is('sub_major/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/sub_major"><big><i class="ion ion-clock text-teal"></i></big> ຂໍ້ມູນຫລັກສູດ</a>
                        </li>
                        @endpermission

                        @permission('major-list')
                        <li class="
                        @if(Request::is('major'))
                        {{ 'active' }}
                        @elseif(Request::is('major/create'))
                        {{ 'active' }}
                        @elseif(Request::is('major/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/major"><big><i class="ion ion-ios-home text-teal"></i></big> ຂໍ້ມູນສາຂາວິຊາ</a>
                        </li>
                        @endpermission

                        @permission('degree-list')
                        <li class="
                        @if(Request::is('degree'))
                        {{ 'active' }}
                        @elseif(Request::is('degree/create'))
                        {{ 'active' }}
                        @elseif(Request::is('degree/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/degree"><big><i class="ion ion-ios-toggle-outline text-teal"></i></big> ຂໍ້ມູນລະບົບການຮຽນ</a>
                        </li>
                        @endpermission

                        @permission('subject-list')
                        <li class="
                        @if(Request::is('subject'))
                        {{ 'active' }}
                        @elseif(Request::is('subject/create'))
                        {{ 'active' }}
                        @elseif(Request::is('subject/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/subject"><big><i class="ion ion-ios-list-outline text-teal"></i></big> ຂໍ້ມູນລາຍວິຊາ</a>
                        </li>
                        @endpermission

                        @permission('dept-list')
                        <li class="
                        @if(Request::is('dept'))
                        {{ 'active' }}
                        @elseif(Request::is('dept/create'))
                        {{ 'active' }}
                        @elseif(Request::is('dept/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/dept"><big><i class="ion ion-ios-home-outline text-teal"></i></big> ຂໍ້ມູນພາກວິຊາ</a>
                        </li>
                        @endpermission

                        @permission('teacher-subject-list')
                        <li class="
                        @if(Request::is('teacher_subject'))
                        {{ 'active' }}
                        @elseif(Request::is('teacher_subject/create'))
                        {{ 'active' }}
                        @elseif(Request::is('teacher_subject/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/teacher_subject"><big><i class="ion ion-ios-paper-outline text-teal"></i></big> ຂໍ້ມູນວິຊາ-ອາຈານສອນ</a>
                        </li>
                        @endpermission
                        @permission('teacher-subject-list')
                        <!--
                        <li class="
                        @if(Request::is('setting'))
                        {{ 'active' }}
                        @elseif(Request::is('setting/create'))
                        {{ 'active' }}
                        @elseif(Request::is('setting/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/setting"><big><i class="ion ion-ios-paper-outline text-teal"></i></big> ຂໍ້ມູນອື່ໆ...</a>
                        </li>
                        -->
                        @endpermission

                    </ul>
                </li>
                @endpermission

                @permission(['register-list', 'manage-classroom', 'real-score', 'upgrade-list', 'upgrade-score'])
                <li class="treeview
                @if(Request::is('register'))
                {{ 'active' }}
                @elseif(Request::is('r_dept_select/*'))
                {{ 'active' }}
                @elseif(Request::is('r_major_select/*'))
                {{ 'active' }}
                @elseif(Request::is('register/create'))
                {{ 'active' }}
                @elseif(Request::is('register/*/edit'))
                {{ 'active' }}
                @elseif(Request::is('manage_teach_score'))
                {{ 'active' }}
                @elseif(Request::is('manage_teach_score/create'))
                {{ 'active' }}
                @elseif(Request::is('manage_teach_score/*/edit'))
                {{ 'active' }}
                @elseif(Request::is('teach_score'))
                {{ 'active' }}
                @elseif(Request::is('teach_score/create'))
                {{ 'active' }}
                @elseif(Request::is('teach_score/*/edit'))
                {{ 'active' }}
                @elseif(Request::is('upgrade'))
                {{ 'active' }}
                @elseif(Request::is('check_upgrade/before_create/*'))
                {{ 'active' }}
                @elseif(Request::is('dept_select/*'))
                {{ 'active' }}
                @elseif(Request::is('major_select/*'))
                {{ 'active' }}
                @elseif(Request::is('upgrade/create'))
                {{ 'active' }}
                @elseif(Request::is('upgrade/*/edit'))
                {{ 'active' }}
                @elseif(Request::is('teach_score_upgrade'))
                {{ 'active' }}
                @elseif(Request::is('teach_score_upgrade/create'))
                {{ 'active' }}
                @elseif(Request::is('teach_score_upgrade/*/edit'))
                {{ 'active' }}
                @elseif(Request::is('manage/class'))
                {{ 'active' }}
                @elseif(Request::is('manage/class/*'))
                {{ 'active' }}
                @elseif(Request::is('manage/class/create'))
                {{ 'active' }}
                @elseif(Request::is('teach_score/class/*'))
                {{ 'active' }}
                @else
                {{ '' }}
                @endif
                        ">
                    <a href="#">
                        <i class="fa  fa-calendar-plus-o"></i> <span><B>ຈັດການຮຽນ-ສອນ</B></span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu" style="font-family: 'Phetsarath_OT'">

                        @permission('register-list')
                        <li class="
                        @if(Request::is('register'))
                        {{ 'active' }}
                        @elseif(Request::is('r_dept_select/*'))
                        {{ 'active' }}
                        @elseif(Request::is('r_major_select/*'))
                        {{ 'active' }}
                        @elseif(Request::is('register/create'))
                        {{ 'active' }}
                        @elseif(Request::is('register/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/register"><i class="fa fa-square-o text-teal"></i> ລົງທະບຽນປະຈໍາປີ</a>
                        </li>
                        @endpermission


                        @permission('upgrade-list')
                        <li class="
                        @if(Request::is('upgrade'))
                        {{ 'active' }}
                        @elseif(Request::is('check_upgrade/before_create/*'))
                        {{ 'active' }}
                        @elseif(Request::is('dept_select/*'))
                        {{ 'active' }}
                        @elseif(Request::is('major_select/*'))
                        {{ 'active' }}
                         @elseif(Request::is('upgrade/create'))
                        {{ 'active' }}
                        @elseif(Request::is('upgrade/*/edit'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/upgrade"><i class="fa fa-square-o text-teal"></i> ລົງທະບຽນແກ້ເກຣດ</a>
                        </li>
                        @endpermission

                        @permission('manage-classroom')
                        <li class="
                        @if(Request::is('manage/class'))
                        {{ 'active' }}
                        @elseif(Request::is('manage/class/create'))
                        {{ 'active' }}
                        @elseif(Request::is('manage/class/*/edit'))
                        {{ 'active' }}
                        @elseif(Request::is('manage/class/*'))
                        {{ 'active' }}
                        @else
                        {{ '' }}
                        @endif
                                "><a href="/manage/class"><i class="fa fa-square-o text-teal"></i> ຈັດການຫ້ອງຮຽນ</a>
                        </li>
                        @endpermission
                        
                            @permission('real-score')
                            <li class="
                            @if(Request::is('teach_score'))
                            {{ 'active' }}
                            @elseif(Request::is('teach_score/class/*'))
                            {{ 'active' }}
                            @else
                            {{ '' }}
                            @endif
                                    "><a href="/teach_score"><i class="fa fa-square-o text-teal"></i> ຈັດການຄະແນນ</a>
                            </li>
                            @endpermission

                        
                            @permission('upgrade-score')
                            <li class="
                            @if(Request::is('teach_score_upgrade'))
                            {{ 'active' }}
                            @elseif(Request::is('teach_score_upgrade/create'))
                            {{ 'active' }}
                            @elseif(Request::is('teach_score_upgrade/*/edit'))
                            {{ 'active' }}
                            @else
                            {{ '' }}
                            @endif
                                    "><a href="/teach_score_upgrade"><i class="fa fa-square-o text-teal"></i> ຈັດການຄະແນນແກ້ເກຣດ</a>
                            </li>
                            @endpermission
                    </ul>
            </li>
                @endpermission

                @permission(['report-student', 'report-register', 'report-upgrade', 'report-grade', 'report-score'])
                <li class="treeview
                    @if(Request::is('student-report'))
                    {{ 'active' }}
                    @elseif(Request::is('register-report'))
                    {{ 'active' }}
                    @elseif(Request::is('upgrade-report'))
                    {{ 'active' }}
                    @elseif(Request::is('grade-report'))
                    {{ 'active' }}
                    @elseif(Request::is('score-report'))
                    {{ 'active' }}
                    @else
                    {{ '' }}
                    @endif
                        ">
                    <a href="#">
                        <i class="fa fa-clipboard"></i>
                        <span><B>ລາຍງານຂໍ້ມູນ</B></span>
                        <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
                    </a>
                    <ul class="treeview-menu" style="font-family: 'Phetsarath_OT'">

                        @permission('report-student')
                        <li class="{{ Request::is('student-report') ? 'active' : '' }}"><a href="/student-report"><i class="fa fa-circle-o text-teal"></i> ລາຍງານຂໍ້ມູນນັກສຶກສາ</a></li>
                        @endpermission

                        @permission('report-register')
                        <li class="{{ Request::is('register-report') ? 'active' : '' }}"><a href="/register-report"><i class="fa fa-circle-o text-teal"></i> ລາຍງານການລົງທະບຽນຮຽນ</a></li>
                        @endpermission

                        @permission('report-upgrade')
                        <li class="{{ Request::is('upgrade-report') ? 'active' : '' }}"><a href="/upgrade-report"><i class="fa fa-circle-o text-teal"></i> ລາຍງານການລົງທະບຽນແກ້ເກຣດ</a></li>
                        @endpermission

                        @permission('report-grade')
                        <li class="{{ Request::is('grade-report') ? 'active' : '' }}"><a href="/grade-report"><i class="fa fa-circle-o text-teal"></i> ລາຍງານຜົນການຮຽນ</a></li>
                        @endpermission

                        @permission('report-score')
                        <li class="{{ Request::is('score-report') ? 'active' : '' }}"><a href="/score-report"><i class="fa fa-circle-o text-teal"></i> ລາຍງານໃບຄະແນນ</a></li>
                        @endpermission

                    </ul>
                </li>
                @endpermission

                @permission('user-list')
                <li class="
                    @if(Request::is('users'))
                    {{ 'active' }}
                    @elseif(Request::is('users/create'))
                    {{ 'active' }}
                    @elseif(Request::is('users/*/edit'))
                    {{ 'active' }}
                    @else
                    {{ '' }}
                    @endif
                ">
                    <a href="/users">
                        <i class="fa fa-user"></i> <span><B>ຜູ້ໃຊ້ລະບົບ</B></span>
                        <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                    </a>
                </li>
                @endpermission

                @permission('role-list')
                <li class="
                    @if(Request::is('role'))
                    {{ 'active' }}
                    @elseif(Request::is('role/create'))
                    {{ 'active' }}
                    @elseif(Request::is('role/*/edit'))
                    {{ 'active' }}
                    @elseif(Request::is('role/*'))
                    {{ 'active' }}
                    @else
                    {{ '' }}
                    @endif
                ">
                    <a href="/role">
                        <i class="fa fa-users"></i> <span><B>ສິດທິຜູ້ເຂົ້າໃຊ້</B></span>
                        <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                    </a>
                </li>
                @endpermission

                <li class="
                    @if(Request::is('profile/*'))
                {{ 'active' }}
                @else
                {{ '' }}
                @endif
                        ">
                    <a href="/profile/{{ Auth::user()->id }}">
                        <big><i class="ion ion-android-person"></i></big> <span><B> ຂໍ້ມູນສ່ວນຕົວ</B></span>
                        <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.0.0
        </div>
        <strong>Copyright &copy; 2018 <a href="#">LPB VT College</a>.</strong> &nbsp;All rights reserved.
    </footer>

</div>

<script src="/js/sweetalert.min.js" type="text/javascript"></script>
{{--<!-- jQuery 3 -->--}}
<script src="/fw_fontend/bower_components/jquery/dist/jquery.min.js"></script>
{{--<!-- Bootstrap 3.3.7 -->--}}
<script src="/fw_fontend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
{{--<!-- DataTables -->--}}
<script src="/fw_fontend/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/fw_fontend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
{{--<!-- Select2 -->--}}
<script src="/fw_fontend/bower_components/select2/dist/js/select2.full.min.js"></script>
{{--<!-- bootstrap datepicker -->--}} 
<script src="/fw_fontend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
{{--<!-- Slimscroll -->--}}
<script src="/fw_fontend/jquery-slimscroll/jquery.slimscroll.min.js"></script>
{{--<!-- FastClick -->--}}
<script src="/fw_fontend/fastclick/fastclick.js"></script>
{{--<!-- iCheck 1.0.1 -->--}}
<script src="/fw_fontend/plugins/iCheck/icheck.min.js"></script>
{{--<!-- AdminLTE App -->--}}
<script src="/fw_fontend/dist/js/adminlte.min.js"></script>
{{--<!-- AdminLTE for demo purposes -->--}}
<script src="/fw_fontend/dist/js/demo.js"></script>
{{--<!-- Page script -->--}} 
<script> 
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({ width: '100%' })
        $('.select36').select2({ width: '100%' })
        $('.select21').select2({ width: '60px' })
        $('.select22').select2({ width: '100px' })
        $('.select23').select2({ width: '220px' })
        $('.select24').select2({ width: '180px' })
        $('.select25').select2({ width: '150px' })
        $('.select26').select2({ width: '300px' })
        $('.select26').select2({ width: '338px' })

        //Date picker 
        $('#datepicker').datepicker({
            minViewMode: 0,
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
        })

        $('#datepicker1').datepicker({
            minViewMode: 0,
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
        })

        $('#datepicker2').datepicker({
            minViewMode: 0,
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
        })

        $('#datepicker3').datepicker({
            minViewMode: 0,
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            clearBtn: true,
        })

        $('#date-y').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true,
            clearBtn: true,
        })

        $('#year-range').datepicker({

        });

    })

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });

    $(function () {
        $('#studenttable').DataTable({
            'ordering': true,
            'info': true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "iDisplayLength": 25,
            "order": [ [1, 'asc'] ],
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 0, 6, 7, 8]
            } ]
        })

        $('#registertable').DataTable({
            'ordering': true,
            'info': true,
            'lengthChange': false,
            "lengthMenu": false,
            "iDisplayLength": 30,
            //'searching': false,
            //'paging': false,
            'autoWidth': true,
            "order": [ [1, 'asc'] ],
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 0, 4, 5, 6 ]
            } ]
        })

        $('#registertable_list').DataTable({
            'ordering': true,
            'info': true,
            'lengthChange': false,
            "lengthMenu": false,
            "iDisplayLength": 30,
            //'searching': false,
            //'paging': false,
            'autoWidth': true,
            "order": [ [3, 'desc'] ],
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 0, 6, 7, 8 ]
            } ]
        })

        $('#classtable').DataTable({
            'ordering': true,
            //'info': false,
            'lengthChange': false,
            "lengthMenu": false,
            "iDisplayLength": 10,
           // 'searching': false,
           // 'paging': false,
            'autoWidth': false,
            "order": [ [4, 'desc'] ],
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 0, 5, 6, 7 ]
            } ]
        })

        $('#majortable').DataTable({
            'ordering': true,
            'info': true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "iDisplayLength": 25,
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 3, 4]
            } ]
        })

        $('#majorsubjects').DataTable({
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            "iDisplayLength": 100,
            'info': true,
            'autoWidth': false
        })

        $('#subject').DataTable({
            'ordering': true,
            'info': true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "iDisplayLength": 25,
            "order": [ [0, 'asc'] ],
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 2, 3, 4, 5]
            } ]
        })

        $('#degreetable').DataTable({
            'ordering': true,
            'info': true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "iDisplayLength": 25,
            "order": [2 ],
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 2, 3, 4]
            } ]
        })

        
        $('#teachersubjecttable').DataTable({
            'ordering': true,
            'info': true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "iDisplayLength": 25,
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 2, 3, 4]
            } ]
        })

        $('#example1').DataTable({
            'ordering': true,
            'info': true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "iDisplayLength": 25,
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [ 6, 7, 8]
            } ]
        })

        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })

        $('#example3').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })

        $('#example4').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    }) 
</script>

@yield('status_alert')
@stack('scripts')

</body>
</html>