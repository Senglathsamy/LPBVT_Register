@extends('layouts.app')

@section('title', 'Teacher Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນອາຈານສອນ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/teacher') }}">ຂໍ້ມູນອາຈານສອນ</a></li>
            <li class="active">ແກ້ໄຂຂໍ້ມູນອາຈານສອນ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/teacher"><i class="fa fa-reply"></i> ກັບຄືນ</a>
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

                        <?= Form::model($teacher, array('url' => 'teacher/' . $teacher->id, 'method' => 'PATCH', 'class' => 'form-horizontal')) ?>

                        <div class="form-group">
                        <div class="{{ $errors->has('te_firstname') ? ' has-error' : '' }}">
                            {!! Form::label('st_fname', 'ຊື່ ແລະ ນາມສະກຸນ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-1">
                                {!! Form::select('te_init', ['--', 'ອຈ.'=>'ອຈ.', 'ຮສ.'=>'ຮສ.', 'ສຈ.'=>'ສຈ.'], 'ອຈ.', ['class' => 'form-control select2']) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::text('te_firstname', null, ['class' => 'form-control', 'placeholder' => 'ຊື່ອາຈານ' , 'required']) !!}
                                @if ($errors->has('te_firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('te_lastname') ? ' has-error' : '' }}">
                            <div class="col-md-3">
                                {!! Form::text('te_lastname', null, ['class' => 'form-control', 'placeholder' => 'ນາມສະກຸນອາຈານ' , 'required']) !!}
                                @if ($errors->has('te_lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                        <div class="form-group{{ $errors->has('te_gender') ? ' has-error' : '' }}">
                            {!! Form::label('te_gender', 'ເພດ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::radio('te_gender', 'ຊາຍ', true, ['class' => 'form-control minimal']) !!} ຊາຍ
                                {!! Form::radio('te_gender', 'ຍິງ', false, ['class' => 'form-control minimal']) !!} ຍິງ
                                @if ($errors->has('te_gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('te_bdate') ? ' has-error' : '' }} date">
                            {!! Form::label('st_bdate', 'ວັນເດືອນປີເກີດ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('te_bdate', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd' , 'required', 'id' => 'datepicker' ]) !!}
                                @if ($errors->has('te_bdate'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('te_bdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="{{ $errors->has('te_bvillage') ? ' has-error' : '' }}">
                            {!! Form::label('te_bvillage', 'ບ້ານ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('te_bvillage', null, ['class' => 'form-control', 'placeholder' => 'ບ້ານເກີດ' , 'required']) !!}
                                @if ($errors->has('te_bvillage'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('te_bvillage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('bprovince') ? ' has-error' : '' }}">
                            {!! Form::label('bprovince', 'ແຂວງ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('bprovince', App\Province::where('country_code', $teacher->district->province->country_code)->pluck('province_name_lo', 'id')->toArray(), $teacher->district->prov_id, ['class' => 'select2 form-control', 'placeholder' => '--ແຂວງເກີດ--', 'required']) !!}
                                @if ($errors->has('bprovince'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('bprovince') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('bdistrict') ? ' has-error' : '' }}">
                            {!! Form::label('bdistrict', 'ເມືອງ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('bdistrict', App\District::where('prov_id', $teacher->district->prov_id)->pluck('district_name_lo','id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ເມືອງເກີດ--', 'required']) !!}
                                @if ($errors->has('bdistrict'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('bdistrict') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('te_nationality') ? ' has-error' : '' }}">
                            {!! Form::label('te_nationality', 'ສັນຊາດ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('te_nationality', null, ['class' => 'form-control', 'placeholder' => 'ສັນຊາດ' , 'required']) !!}
                                @if ($errors->has('te_nationality'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_nationality') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('te_region') ? ' has-error' : '' }}">
                            {!! Form::label('te_region', 'ສາດສະໜາ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('te_region', null, ['class' => 'form-control', 'placeholder' => 'ສາດສະໜາ' , 'required']) !!}
                                @if ($errors->has('te_region'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_region') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('te_phone') ? ' has-error' : '' }}">
                            {!! Form::label('te_phone', 'ເບີໂທລະສັບ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('te_phone', null, ['class' => 'form-control', 'placeholder' => 'ເບີໂທລະສັບ' , 'required']) !!}
                                @if ($errors->has('te_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('te_education') ? ' has-error' : '' }}">
                            {!! Form::label('te_education', 'ລະດັບວັນທະນະທໍາ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('te_education', [ 'ມັດທະຍົມປາຍ' => 'ມັດທະຍົມປາຍ', 'ມັດທະຍົມຕົ້ນ' => 'ມັດທະຍົມຕົ້ນ', 'ປະຖົມສຶກສາ' => 'ປະຖົມສຶກສາ', 'ອານຸບານ' => 'ອານຸບານ'], null, ['class' => 'form-control select2', 'placeholder' => '--ລະດັບວັນທະນະທໍາ--' , 'required']) !!}
                                @if ($errors->has('te_education'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_education') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('te_degree') ? ' has-error' : '' }}">
                            {!! Form::label('te_degree', 'ລະດັບວິຊາສະເພາະ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('te_degree', ['ປະລິນຍາເອກ' => 'ປະລິນຍາເອກ', 'ປະລິນຍາໂທ' => 'ປະລິນຍາໂທ', 'ປະລິນຍາຕີ' => 'ປະລິນຍາຕີ', 'ຊັ້ນສູງ' => 'ຊັ້ນສູງ', 'ຊັ້ນກາງ' => 'ຊັ້ນກາງ', 'ຊັ້ນຕົ້ນ' => 'ຊັ້ນຕົ້ນ'], null, ['class' => 'form-control select2', 'placeholder' => '--ລະດັບວິຊາສະເພາະ--' , 'required']) !!}
                                @if ($errors->has('te_degree'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_degree') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="{{ $errors->has('te_major') ? ' has-error' : '' }}">
                            {!! Form::label('te_major', 'ສາຂາ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('te_major', null, ['class' => 'form-control', 'placeholder' => 'ສາຂາ' , 'required']) !!}
                                @if ($errors->has('te_major'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_major') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('startwork') ? ' has-error' : '' }} date">
                            {!! Form::label('startwork', 'ວັນເດືອນປີເຂົ້າສັງກັດລັດ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('startwork', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'id' => 'datepicker1' ]) !!}
                                @if ($errors->has('startwork'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('startwork') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="{{ $errors->has('te_position') ? ' has-error' : '' }}">
                            {!! Form::label('te_position', 'ຕໍາແໜ່ງລັດ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('te_position', null, ['class' => 'form-control', 'placeholder' => 'ຕໍາແໜ່ງລັດ' ]) !!}
                                @if ($errors->has('te_position'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('te_position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('date_to_party1') ? ' has-error' : '' }}">
                            {!! Form::label('date_to_party1', 'ວັນເດືອນປີເຂົ້າພັກສໍາຮອງ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('date_to_party1', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'id' => 'datepicker2' ]) !!}
                                @if ($errors->has('date_to_party1'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('date_to_party1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('date_to_party2') ? ' has-error' : '' }}">
                            {!! Form::label('date_to_party2', 'ວັນເດືອນປີເຂົ້າພັກສົມບູນ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('date_to_party2', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd', 'id' => 'datepicker3' ]) !!}
                                @if ($errors->has('date_to_party2'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('date_to_party2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('te_party_position') ? ' has-error' : '' }}">
                            {!! Form::label('te_party_position', 'ຕໍາແໜ່ງພັກ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('te_party_position', null, ['class' => 'form-control', 'placeholder' => 'ຕໍາແໜ່ງພັກ' ]) !!}
                                @if ($errors->has('te_party_position'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('te_party_position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('politic_level') ? ' has-error' : '' }}">
                            {!! Form::label('politic_level', 'ລັບດັບທິດສະດີ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('politic_level', null, ['class' => 'form-control', 'placeholder' => 'ລັບດັບທິດສະດີການເມື່ອງ' ]) !!}
                                @if ($errors->has('politic_level'))
                                    <span class="help-block">
                                        <strong> {{ $errors->first('politic_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group{{ $errors->has('dept_id') ? ' has-error' : '' }}">
                            {!! Form::label('dept_id', 'ສັງກັດພາກວິຊາ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-5">
                                {!! Form::select('dept_id', App\Department::pluck('dept_name', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => '--ພາກວິຊາ--', 'required']) !!}
                                @if ($errors->has('dept_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dept_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group{{ $errors->has('te_status') ? ' has-error' : '' }}">
                            {!! Form::label('te_status', 'ສະຖານະພາບ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('te_status', App\TeacherStatus::pluck('status', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => '--ສະຖານະພາບ--', 'required']) !!}
                                @if ($errors->has('te_status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('te_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr style="width: 70%">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/teacher') }}" class="btn bg-orange" style="font-weight: bold;"><span class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-blue" style="font-weight: bold;">ເພີ່ມຂໍ້ມູນອາຈານ <span class="glyphicon glyphicon-ok"></span> </button>
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