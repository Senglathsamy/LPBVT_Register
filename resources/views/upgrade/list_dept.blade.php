@extends('layouts.app')

@section('title', 'List Department')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ</B>
        </h1>
        <ol class="breadcrumb" class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນພາກວິຊາ</li>
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

            @foreach($list_dept as $dept)
            <div class="col-lg-3 col-xs-6">

                <!-- small box -->
                <div class="small-box bg-teal-active">
                    <a href="{{ url('dept_select/' . $dept->id) }}" class="small-box bg-teal-active">
                    <div class="inner">
                        <h3 style="font-family: 'Phetsarath_OT'; ">ພາກວິຊາ</h3>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size: 20px;">
                            {{ str_limit($dept->dept_name, $limit = 20, $end = '...') }}
                        </h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-home-outline"></i>
                    </div>
                        <br>
                        <div class="small-box-footer" style="font-family: 'Phetsarath_OT'; font-size: 20px;">ເລືອກພາກວິຊານີ້ <i class="fa fa-arrow-circle-right"></i></div>
                    </a>
                </div>

            </div>
            <!-- ./col -->
            @endforeach

        </div>
        <!-- /.row -->

    </section>
    {{--</section>--}}

@endsection

@section('status_alert')

    @include('.alert')

@endsection
