@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນພາກວິຊາ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/dept') }}">ຂໍ້ມູນພາກວິຊາ</a></li>
            <li class="active">ແກ້ໄຂຂໍ້ມູນພາກວິຊາ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/dept"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-xs-12">

                <div class="box box-info">
                    <div class="box-header" align="center">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <?= Form::model($department, array('url' => 'dept/' . $department->id, 'method' => 'PATCH', 'class' => 'form-horizontal')) ?>

                        <div class="form-group{{ $errors->has('dept_name') ? ' has-error' : '' }}">
                            {!! Form::label('dept_name', 'ຊື່ພາກວິຊາ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('dept_name', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາປ້ອນຊື່ພາກວິຊາ' , 'required']) !!}
                                @if ($errors->has('dept_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dept_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/dept') }}" class="btn bg-orange" style="font-weight: bold;"><span class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-green" style="font-weight: bold;">ແກ້ໄຂຂໍ້ມູນພາກວິຊາ <span class="glyphicon glyphicon-ok"></span> </button>
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


@endsection