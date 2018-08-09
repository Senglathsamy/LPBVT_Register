@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນລາຍວິຊາ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/subject') }}">ຂໍ້ມູນລາຍວິຊາ</a></li>
            <li class="active">ເພີ່ມຂໍ້ມູນລາຍວິຊາ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/subject"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        {!! Form::open(['url'=> 'subject', 'class' => 'form-horizontal']) !!}

                        <div class="form-group{{ $errors->has('sub_id') ? ' has-error' : '' }}">
                            {!! Form::label('sub_id', 'ລະຫັດວິຊາ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::text('sub_id', null, ['class' => 'form-control', 'placeholder' => 'ລະຫັດວິຊາ' , 'required']) !!}
                                @if ($errors->has('sub_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sub_name') ? ' has-error' : '' }}">
                            {!! Form::label('sub_name', 'ຊື່ວິຊາ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('sub_name', null, ['class' => 'form-control', 'placeholder' => 'ຊື່ວິຊາ', 'required']) !!}
                                @if ($errors->has('sub_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sub_credit') ? ' has-error' : '' }}">
                            {!! Form::label('sub_credit', 'ໜ່ວຍກິດ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('sub_credit', null, ['class' => 'form-control', 'placeholder' => 'ຈຳນວນໜ່ວຍກິດ', 'required']) !!}
                                @if ($errors->has('sub_credit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_credit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sub_unit1') ? ' has-error' : '' }}">
                            {!! Form::label('sub_unit1', 'ບັນຍາຍ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('sub_unit1', null, ['class' => 'form-control', 'placeholder' => 'ຈຳນວນຊົ່ວໂມງປະຕິບັດ', 'required']) !!}
                                @if ($errors->has('sub_unit1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_unit1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sub_unit2') ? ' has-error' : '' }}">
                            {!! Form::label('sub_unit2', 'ປະຕິບັດ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('sub_unit2', null, ['class' => 'form-control', 'placeholder' => 'ຈຳນວນຊົ່ວໂມງປະຕິບັດ', 'required']) !!}
                                @if ($errors->has('sub_unit2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_unit2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sub_unit3') ? ' has-error' : '' }}">
                            {!! Form::label('sub_unit3', 'ທົດລອງ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('sub_unit3', null, ['class' => 'form-control', 'placeholder' => 'ຈຳນວນຊົ່ວໂມງທົດລອງ', 'required']) !!}
                                @if ($errors->has('sub_unit3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_unit3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/subject') }}" class="btn bg-orange" style="font-weight: bold;"><span class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-blue" style="font-weight: bold;">ເພີ່ມຂໍ້ມູນລາຍວິຊາ <span class="glyphicon glyphicon-ok"></span> </button>
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