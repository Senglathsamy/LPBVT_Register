@extends('layouts.app')

@section('title', 'Add Upgrade')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນລົງທະບຽນອັບເກຣດ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="/major_select/{!! Request::session()->get('ma_id') !!}">ຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ</a></li>
            <li><a href="/check_upgrade/before_create/{!! Request::session()->get('ma_id') !!}">ກວດສອບຂໍ້ມູນລົງທະບຽນອັບເກຣດ</a></li>
            <li class="active">ເພີ່ມຂໍ້ມູນລົງທະບຽນອັບເກຣດ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="{{ URL::previous() }}"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        {!! Form::open(['url'=> 'upgrade', 'class' => 'form-horizontal']) !!}

                        {!! Form::hidden('id', $id, ['class' => 'form-control']) !!}
                        {!! Form::hidden('ma_id', $ma_id, ['class' => 'form-control']) !!}
                        {!! Form::hidden('subb_id', $subb_id, ['class' => 'form-control']) !!}

                        <div class="form-group{{ $errors->has('st_id') ? ' has-error' : '' }}">
                            {!! Form::label('st_id', 'ນັກສຶກສາ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('st_id', App\Student::select(DB::raw("CONCAT(st_fname,' ',st_lname, ' ', '(ລະຫັດ: ', st_id , ')') AS full_name, st_id"))->pluck('full_name', 'st_id'), null, ['class' => 'select2 form-control', 'placeholder' => 'ກະລຸນາເລືອກນັກສຶກສາ', 'required', 'disabled']) !!}
                                {!! Form::hidden('st_id', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('st_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('score_real') ? ' has-error' : '' }}">
                            {!! Form::label('score_real', 'ເກຣດເກົ່າ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('score_real', $score_real, ['class' => 'form-control', 'placeholder' => 'ເກຣດເກົ່າ', 'required', 'disabled']) !!}
                                @if ($errors->has('score_real'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('score_real') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('ug_recieptno') ? ' has-error' : '' }}">
                            {!! Form::label('ug_recieptno', 'ເລກໃບບິນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('ug_recieptno', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາປ້ອນເລກໃບບິນ']) !!}
                                @if ($errors->has('ug_recieptno'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('ug_recieptno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ug_paiddate') ? ' has-error' : '' }} date">
                            {!! Form::label('ug_paiddate', 'ວັນທີຊຳລະ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('ug_paiddate', null, ['class' => 'form-control', 'placeholder' => 'ກະລຸນາເລືອກວັນທີຊຳລະຄ່າລົງທະບຽນ', 'id' => 'datepicker1' ]) !!}
                                @if ($errors->has('ug_paiddate'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('ug_paiddate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ URL::previous() }}" class="btn bg-green"
                                               style="font-weight: bold;"><span
                                            class="glyphicon glyphicon-chevron-left"></span> ກັບຄືນ</a>
                                &nbsp;&nbsp;<a href="/major_select/{!! Request::session()->get('ma_id') !!}" class="btn bg-orange"
                                               style="font-weight: bold;"><span
                                            class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-blue" @if(($score_real == "C+") or ($score_real == "B") or ($score_real == "B+") or ($score_real == "A") or ($score_real == "I")) {{ 'disabled' }} @endif
                                                    style="font-weight: bold;">ເພີ່ມຂໍ້ມູນລົງທະບຽນຮຽນ <span
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