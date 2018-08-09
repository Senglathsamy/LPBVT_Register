@extends('layouts.app')

@section('title', 'All Report')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ລາຍງານຂໍ້ມູນຕ່າງໆ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ລາຍງານຂໍ້ມູນ</li>
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

            @permission('report-student')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <a href="student-report" class="small-box bg-red">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ຂໍ້ມູນນັກສຶກສາ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">----------</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-university"></i>
                    </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ລາຍງານດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('report-register')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <a href="register-report" class="small-box bg-red">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'; ">ລົງທະບຽນຮຽນ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">----------</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-compose"></i>
                    </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ລາຍງານດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('report-upgrade')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <a href="upgrade-report" class="small-box bg-red">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'; ">ລົງທະບຽນແກ້ເກຼດ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">----------</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-compose-outline"></i>
                    </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ລາຍງານດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('report-grade')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <a href="grade-report" class="small-box bg-red">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'; ">ຜົນການຮຽນ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">----------</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-calendar"></i>
                    </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ລາຍງານດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            @endpermission

            @permission('report-score')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <a href="score-report" class="small-box bg-red">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'">ໃບຄະແນນ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">----------</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-paper"></i>
                    </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ລາຍງານດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
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
