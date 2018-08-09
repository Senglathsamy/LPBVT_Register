@extends('layouts.app')

@section('content')

    <br>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            @permission('user-list')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->

                <div class="small-box">
                    <a href="student/create"  class="small-box bg-aqua">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ລົງທະບຽນ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ນັກສຶກສາໃໝ່</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                        <br>
                    <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;"><i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('student-list')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->

                <div class="small-box">
                    <a href="student"  class="small-box bg-purple">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'; ">{{ $std }} ຄົນ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ນັກສຶກສາທັງໝົດ</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-university"></i>
                    </div>
                        <br>
                    <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ </div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('subject-list')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->
                <div class="small-box">
                    <a href="subject" class="small-box bg-orange-active">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'; ">{{ $subject }} ວິຊາ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ວິຊາຮຽນທັງໝົດ</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-list-outline"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            @endpermission

            @permission('teacher-list')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->
                <div class="small-box">
                    <a href="teacher" class="small-box bg-teal-active">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">{{ $teacher }} ຄົນ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ອາຈານທັງໝົດ</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission(['student-list', 'teacher-list', 'dept-list', 'major-list', 'subject-list', 'degree-list', 'course-list', 'teacher-subject-list'])
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->

                <div class="small-box">
                    <a href="manage" class="small-box bg-green">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ຈັດການ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ຈັດການຂໍ້ມູນ</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-settings"></i>
                    </div>
                        <br>
                    <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission(['report-student', 'report-register', 'report-upgrade', 'report-grade', 'report-score'])
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->
                <div class="small-box">
                    <a href="report" class="small-box bg-red">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ລາຍງານ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ລາຍງານຂໍ້ມູນຕ່າງໆ</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                        <br>
                    <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('course-list')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->
                <div class="small-box bg-olive-active">
                    <a href="sub_major" class="small-box bg-olive-active">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ຫລັກສູດ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ຫຼັກສູດຮຽນ-ສອນ</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clock"></i>
                    </div>
                        <br>
                    <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('role-list')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->
                <div class="small-box">
                    <a href="role" class="small-box bg-orange-active">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">Privilege</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ສິດທິຜູ້ໃຊ້ລະບົບ</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-lock-combination"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i
                                    class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('register-list')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <a href="register" class="small-box bg-aqua">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ລົງທະບຽນ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ນ/ສ ລົງທະບຽນຮຽນ</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                        <br>
                    <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('manage-teacher-subject')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->
                <div class="small-box bg-green" style="margin-bottom: 20px;">
                    <a href="manage_teach_score" class="small-box bg-green">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ວິຊາສອນ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ຜູກວິຊາສອນໃຫ້ ອ.ຈ</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-filing"></i>
                    </div>
                        <br>
                    <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i
                                class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('upgrade-list')
            <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <a href="upgrade" class="small-box bg-purple">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'; ">ແກ້ເກຣດ</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ລົງທະບຽນແກ້ເກຣດ</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-compose"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i
                                    class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @if(!empty(Auth::user()->te_id))
                <!-- ./col -->
                    @permission(['real-score', 'upgrade-score'])
                    <div class="col-lg-3 col-xs-6" style="margin-bottom: 20px;">
                        <!-- small box -->
                        <div class="small-box">
                            <a href="score" class="small-box bg-blue">
                                <div class="inner">
                                    <h3 style="font-family: 'Phetsarath_OT'">ຄະແນນ</h3>
                                    <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ຄະແນນ & ແກ້ເກຣດ</h4>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-cog"></i>
                                </div>
                                <br>
                                <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເບິ່ງຂໍ້ມູນເພີ່ມ <i class="fa fa-arrow-circle-right"></i></div>
                            </a>
                        </div>
                    </div>
                    @endpermission
            @endif
            <!-- ./col -->

        </div>
        <!-- /.row -->


    </section>
    {{--</section>--}}

@endsection

@section('status_alert')

    @include('.alert')

@endsection
