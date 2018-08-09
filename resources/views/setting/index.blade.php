@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນອື່ນໆ...</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນອື່ນໆ..</a></li>
            <li class="active"></li>
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
        <div class="row">

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#classroom" data-toggle="tab">ຂໍ້ມູນຫ້ອງຮຽນ</a></li>
                        <li class="active"><a href="#degree" data-toggle="tab">ຂໍ້ມູນວຸດທິການສຶກສາ</a></li>
                        <li><a href="#other" data-toggle="tab">....</a></li>
                    </ul>

                    <div class="tab-content">

                        <div class="active tab-pane" id="classroom">

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="degree">
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="other">

                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->


@endsection

@section('status_alert')

    @include('.alert')

@endsection