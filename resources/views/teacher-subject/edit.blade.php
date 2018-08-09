@extends('layouts.app')

@section('title', 'Edit Teacher Subject')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນອາຈານສອນປະຈໍາວິຊາ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/teacher_subject') }}">ຂໍ້ມູນອາຈານສອນປະຈໍາວິຊາ</a></li>
            <li class="active">ແກ້ໄຂຂໍ້ມູນອາຈານສອນປະຈໍາວິຊາ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/teacher_subject"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        <?= Form::model($t_s, array('url' => 'teacher_subject/' . $t_s->id, 'method' => 'PATCH', 'class' => 'form-horizontal')) ?>

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            {!! Form::label('id', 'ວິຊາ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('id', App\Subject::pluck('sub_name', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => '--ວິຊາສອນ--', 'required', 'disabled']) !!}
                                @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('teacher') ? ' has-error' : '' }}">
                            {!! Form::label('teacher', 'ຊື່ອາຈານສອນ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('teacher[]', App\Teacher::select(DB::raw("CONCAT(te_init,' ', te_firstname,' ', te_lastname) AS full_name, id"))->pluck('full_name', 'id'), null, ['class' => 'select2 form-control', 'data-placeholder' => '--ອາຈານສອນ--', 'multiple' => 'multiple']) !!}
                                @if ($errors->has('teacher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('teacher') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/teacher_subject') }}" class="btn bg-orange"
                                               style="font-weight: bold;"><span
                                            class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-green"
                                                    style="font-weight: bold;">ແກ້ໄຂຂໍ້ມູນອາຈານສອນ ວິຊາ <span
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
@push('scripts')

@endpush