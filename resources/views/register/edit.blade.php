@extends('layouts.app')

@section('title', 'Edit Register')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນລົງທະບຽນຮຽນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/register') }}">ຂໍ້ມູນລົງທະບຽນຮຽນ</a></li>
            <li class="active">ແກ້ໄຂຂໍ້ມູນລົງທະບຽນຮຽນ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/register"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        {!! Form::model($register, array('url' => 'register/' . $register->rg_id, 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}

                        {!! Form::open(['url'=> 'register', 'class' => 'form-horizontal']) !!}

                        {!! Form::hidden('ma_id', $ma_id, ['class' => 'form-control']) !!}

                        <div class="form-group{{ $errors->has('st_id') ? ' has-error' : '' }}">
                            {!! Form::label('st_id', 'ນັກສຶກສາ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('st_id', App\Student::select(DB::raw("CONCAT(st_fname,' ',st_lname, ' ', '(ລະຫັດ: ', st_id , ')') AS full_name, st_id"))->pluck('full_name', 'st_id'), null, ['class' => 'select2 form-control', 'placeholder' => 'ກະລຸນາເລືອກນັກສຶກສາ', 'required']) !!}

                                @if ($errors->has('st_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rg_date') ? ' has-error' : '' }} date">
                            {!! Form::label('rg_date', 'ລົງທະບຽນວັນທີ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('rg_date', null, ['class' => 'form-control', 'placeholder' => 'ວັນທີລົງທະບຽນ' , 'required', 'id' => 'datepicker' ]) !!}
                                @if ($errors->has('rg_date'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('rg_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rg_studyyear') ? ' has-error' : '' }}">
                            {!! Form::label('rg_studyyear', 'ປີຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('rg_studyyear', [1 => 'ປີ 1',2 => 'ປີ 2',3 => 'ປີ 3',4 => 'ປີ 4'], null, ['class' => 'form-control select2', 'placeholder' => 'ກະລຸນາເລືອກປີຮຽນ' , 'required']) !!}
                                @if ($errors->has('rg_studyyear'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rg_studyyear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('rg_classno') ? ' has-error' : '' }}">
                            {!! Form::label('rg_classno', 'ຫ້ອງຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('rg_classno', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາປ້ອນຫ້ອງຮຽນ']) !!}
                                @if ($errors->has('rg_classno'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('rg_classno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('rg_paiddate') ? ' has-error' : '' }} date">
                            {!! Form::label('rg_paiddate', 'ວັນທີຊຳລະ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('rg_paiddate', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາເລືອກວັນທີຊຳລະຄ່າລົງທະບຽນ', 'id' => 'datepicker1']) !!}
                                @if ($errors->has('rg_paiddate'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('rg_paiddate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('rg_recieptno') ? ' has-error' : '' }}">
                            {!! Form::label('rg_recieptno', 'ເລກໃບບິນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('rg_recieptno', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາປ້ອນເລກໃບບິນ']) !!}
                                @if ($errors->has('rg_recieptno'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('rg_recieptno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rg_academicyear') ? ' has-error' : '' }}">
                            {!! Form::label('rg_academicyear', 'ສົກຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('rg_academicyear', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາປ້ອນສົກຮຽນ', 'required']) !!}
                                @if ($errors->has('rg_academicyear'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('rg_academicyear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/register') }}" class="btn bg-orange"
                                               style="font-weight: bold;"><span
                                            class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-green"
                                                    style="font-weight: bold;">ແກ້ໄຂຂໍ້ມູນລົງທະບຽນຮຽນ <span
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