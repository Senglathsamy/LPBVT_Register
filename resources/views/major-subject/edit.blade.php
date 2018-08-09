@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນຫລັກສູດ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/sub_major') }}">ຂໍ້ມູນຫລັກສູດ</a></li>
            <li class="active">ແກ້ໄຂຂໍ້ມູນຫລັກສູດ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/sub_major?year={{ $sub_major->year }}&term={{ $sub_major->term }}&ma_id={{ $sub_major->ma_id }}&de_id={{ $sub_major->de_id }}"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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
                        {!! Form::model($sub_major, array('url' => 'sub_major/' . $sub_major->id, 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}
                        {!! Form::hidden('uri', Request::getQueryString(), ['class' => 'form-control']) !!}
                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                            {!! Form::label('year', 'ປີຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('year', [1 => 'ປີ 1',2 => 'ປີ 2',3 => 'ປີ 3',4 => 'ປີ 4'], null, ['class' => 'form-control select2', 'placeholder' => '--ປີຮຽນ--' , 'required', 'disabled']) !!}
                                {!! Form::hidden('year', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('term') ? ' has-error' : '' }}">
                            {!! Form::label('term', 'ພາກຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('term', [1 => 'ພາກຮຽນ 1',2 => 'ພາກຮຽນ 2'], null, ['class' => 'form-control select2', 'placeholder' => '--ພາກຮຽນ--' , 'required', 'disabled']) !!}
                                {!! Form::hidden('term', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('term'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('term') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ma_id') ? ' has-error' : '' }}">
                            {!! Form::label('ma_id', 'ສາຂາຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('ma_id', App\Major::pluck('ma_name', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => '--ສາຂາຮຽນ--', 'required', 'disabled']) !!}
                                {!! Form::hidden('ma_id', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('ma_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ma_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dde_id') ? ' has-error' : '' }}">
                            {!! Form::label('dde_id', 'ລະບົບຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('dde_id', App\Degree::join('courses as c', 'c.id', '=', 'degree.course_id')->select('degree.id', DB::raw("CONCAT(degree.degree,' ', c.name,' (', degree.program , ')') AS full_text"))->orderBy('full_text')->pluck('full_text', 'id'), $sub_major->de_id, ['class' => 'select2 form-control', 'required', 'placeholder' => '--ລະບົບຮຽນ--']) !!}
                                @if ($errors->has('dde_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('dde_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subb_id') ? ' has-error' : '' }}">
                            {!! Form::label('subb_id', 'ວິຊາຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('subb_id', App\Subject::select(DB::raw("CONCAT(sub_name,' (', sub_id, ')') AS full_sub_name, id"))->pluck('full_sub_name', 'id'), null, ['class' => 'select2 form-control', 'data-placeholder' => '--ວິຊາຮຽນ--', 'required']) !!}
                                @if ($errors->has('subb_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subb_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/sub_major?{{Request::getQueryString()}}" class="btn bg-orange"
                                               style="font-weight: bold;"><span
                                            class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-green"
                                                    style="font-weight: bold;">ແກ້ໄຂຂໍ້ມູນຫລັກສູດ <span
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

@section('status_alert')

    @include('.alert')

@endsection
