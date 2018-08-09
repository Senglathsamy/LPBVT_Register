@extends('layouts.app')

@section('title', 'Add Major')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນສາຂາວິຊາ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/major') }}">ຂໍ້ມູນສາຂາວິຊາ</a></li>
            <li class="active">ເພີ່ມຂໍ້ມູນສາຂາວິຊາ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/major"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        {!! Form::open(['url'=> 'major', 'class' => 'form-horizontal']) !!}

                        <div class="form-group{{ $errors->has('ma_name') ? ' has-error' : '' }}">
                            {!! Form::label('ma_name', 'ຊື່ສາຂາວິຊາ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('ma_name', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາປ້ອນຊື່ສາຂາວິຊາ' , 'required']) !!}
                                @if ($errors->has('ma_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ma_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dept_id') ? ' has-error' : '' }}">
                            {!! Form::label('dept_id', 'ພາກວິຊາ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('dept_id', App\Department::pluck('dept_name', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => 'ກະລຸນາເລືອກພາກວິຊາ', 'required']) !!}
                                @if ($errors->has('dept_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dept_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/major') }}" class="btn bg-orange"
                                               style="font-weight: bold;"><span
                                            class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-blue"
                                                    style="font-weight: bold;">ເພີ່ມຂໍ້ມູນສາຂາວິຊາ <span
                                            class="glyphicon glyphicon-ok"></span></button>
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