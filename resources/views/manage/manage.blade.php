@extends('layouts.app')

@section('title', 'All Manage')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຈັດການຂໍ້ມູນຕ່າງໆ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ຈັດການຂໍ້ມູນ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
            </div>
        </div>
        <br>
        <!-- Small boxes (Stat box) -->
        <div class="row">

            @permission('student-list')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box">
                    <a href="student"  class="small-box bg-green">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ນັກຮຽນທັງໝົດ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 30px;">----------</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-university"></i>
                    </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ຈັດການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('teacher-list')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box">
                    <a href="teacher"  class="small-box bg-green">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">ອາຈານສອນ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 30px;">----------</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ຈັດການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('dept-list')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box">
                    <a href="dept"  class="small-box bg-green">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">ພາກວິຊາຮຽນ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 30px;">----------</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-home-outline"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ຈັດການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('major-list')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box">
                    <a href="major"  class="small-box bg-green">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">ສາຂາວິຊາຮຽນ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 30px;">----------</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-home"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ຈັດການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('subject-list')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box">
                    <a href="subject"  class="small-box bg-green">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">ວິຊາຮຽນທັງໝົດ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 30px;">----------</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-list"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ຈັດການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('degree-list')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box">
                    <a href="degree"  class="small-box bg-green">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">ລະບົບຮຽນ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 30px;">----------</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-toggle"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ຈັດການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('course-list')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box">
                    <a href="sub_major"  class="small-box bg-green">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">ຫຼັກສູດຮຽນ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 30px;">----------</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clock"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ຈັດການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('teacher-subject-list')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box">
                    <a href="teacher_subject"  class="small-box bg-green">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">ອາຈານ-ວິຊາຮຽນ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 30px;">----------</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-paper-outline"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ຈັດການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

        </div>
        <!-- /.row -->
    </section>
    {{--</section>--}}

@endsection
