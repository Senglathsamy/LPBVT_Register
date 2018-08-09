@extends('layouts.app')

@section('title', 'Edit Role Permission')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ສິດທິຜູ້ເຂົ້າໃຊ້</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/role') }}">ສິດທິຜູ້ເຂົ້າໃຊ້</a></li>
            <li class="active">ເພີ່ມສິດທິຜູ້ເຂົ້າໃຊ້</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/role"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        {!! Form::model($role, array('url' => 'role/' . $role->id, 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'ຊື່ສິດທິ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ຊື່ສິດທິ [Englist]' , 'required', 'disabled']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                            {!! Form::label('display_name', 'ຊື່ສິດທິທີ່ສະແດງ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'ຊື່ສິດທິທີ່ສະແດງ' , 'required']) !!}
                                @if ($errors->has('display_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {!! Form::label('description', 'ຄໍາບັນລະຍາຍ', ['class' => 'col-md-2 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control','style'=>'height:100px')) !!}
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>

                        <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                            {!! Form::label('permission', 'Permission', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-11">
                                <div class="row">
                                    @foreach($permission as $value)
                                        <div class="col-lg-3 col-xs-6">
                                            <label>
                                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                {{ $value->display_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <br/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-1">
                                <a href="{{ url('/role') }}" class="btn bg-orange" style="font-weight: bold;"><span class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-green" style="font-weight: bold;">ແກ້ໄຂສິດທິຜູ້ເຂົ້າໃຊ້ <span class="glyphicon glyphicon-ok"></span> </button>
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