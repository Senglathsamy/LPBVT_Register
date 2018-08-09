@extends('layouts.app')

@section('title', 'Grade')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຂໍ້ມູນຄະແນນ ແລະ ຄະແນນແກ້ເກຣດ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ຂໍ້ມູນຄະແນນ ແລະ ຄະແນນແກ້ເກຣດ</li>
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

            @permission('real-score')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <a href="teach_score" class="small-box bg-blue">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">Score</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ຂໍ້ມູນຄະແນນ</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-calendar"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">
                            ດຳເນີນການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endpermission

            @permission('upgrade-score')
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->

                <div class="small-box bg-blue">
                    <a href="teach_score_upgrade" class="small-box bg-blue">
                        <div class="inner">
                            <h3 style="font-family: 'Phetsarath_OT'">Upgrade</h3>
                            <h4 style="font-family: 'Phetsarath_OT'; font-size: 25px;">ຂໍ້ມູນຄະແນນແກ້ເກຣດ</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-compose"></i>
                        </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">
                            ດຳເນີນການດຽວນີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            @endpermission

        </div>
        <!-- /.row -->
    </section>
    {{--</section>--}}

@endsection
