@extends('layouts.app')

@section('title', 'Add User')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຜູ້ໃຊ້ລະບົບ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/users') }}">ຜູ້ໃຊ້ລະບົບ</a></li>
            <li class="active">ເພີ່ມຂໍ້ມູນຜູ້ໃຊ້ລະບົບ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/users"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        {!! Form::open(['url'=> 'users', 'class' => 'form-horizontal']) !!}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', 'ຊື່ຜູ້ໃຊ້', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-5">
                                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username' , 'required']) !!}
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'ລະຫັດຜ່ານ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-5">
                                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control', 'required')) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('confirm-password') ? ' has-error' : '' }}">
                            {!! Form::label('confirm-password', 'ຢືນຢັນລະຫັດຜ່ານ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-5">
                                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control', 'required')) !!}
                                @if ($errors->has('confirm-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                            {!! Form::label('roles', 'ສິດທິຜູ້ໃຊ້', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-5">
                                {!! Form::select('roles[]', App\Role::pluck('display_name', 'id'), null, ['class' => 'select2 form-control','data-placeholder' => ' ເລືອກສິດທິໃຫ້ກັບຜູ້ໃຊ້', 'required', 'multiple' => 'multiple']) !!}
                                @if ($errors->has('roles'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('te_id') ? ' has-error' : '' }}">
                            {!! Form::label('te_id', 'ອາຈານສອນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-5">
                                {!! Form::select('te_id', [null=>'--- ບໍ່ຜູກອາຈານໃສ່ຜູ້ໃຊ້ ---'] + App\Teacher::select(DB::raw("CONCAT(te_firstname,' ', te_lastname) AS full_name, id"))->pluck('full_name', 'id')->toArray(), null, ['class' => 'select2 form-control']) !!}
                                @if ($errors->has('te_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/users') }}" class="btn bg-orange"
                                               style="font-weight: bold;"><span
                                            class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-blue"
                                                    style="font-weight: bold;">ເພີ່ມຜູ້ໃຊ້ລະບົບ <span
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