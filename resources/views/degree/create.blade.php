@extends('layouts.app')

@section('title', 'Add Program')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນລະບົບການຮຽນ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/degree') }}">ຂໍ້ມູນລະບົບການຮຽນ</a></li>
            <li class="active">ເພີ່ມຂໍ້ມູນລະບົບການຮຽນ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/degree"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        {!! Form::open(['url'=> 'degree', 'class' => 'form-horizontal']) !!}

                        <div class="form-group{{ $errors->has('degree') ? ' has-error' : '' }}">
                            {!! Form::label('degree', 'ລະດັບການສຶກສາ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('degree', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາປ້ອນລະດັບການສຶກສາ' , 'required']) !!}
                                @if ($errors->has('degree'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('degree') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
                            {!! Form::label('course_id', 'ສາຍ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('course_id', App\Course::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '--ສາຍ--' , 'required']) !!}
                                @if ($errors->has('course_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('program') ? ' has-error' : '' }}">
                            {!! Form::label('program', 'ລະບົບການສຶກສາ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('program', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາປ້ອນລະບົບການສຶກສາ' , 'required']) !!}
                                @if ($errors->has('program'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('program') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/degree') }}" class="btn bg-orange" style="font-weight: bold;"><span class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-blue" style="font-weight: bold;">ເພີ່ມຂໍ້ມູນລະບົບການຮຽນ <span class="glyphicon glyphicon-ok"></span> </button>
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