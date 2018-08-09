@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຂໍ້ມູນນັກສຶກສາ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/student') }}">ຂໍ້ມູນນັກສຶກສາ</a></li>
            <li class="active">ແກ້ໄຂຂໍ້ມູນນັກສຶກສາ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="{{ url('/student') }}"><i class="fa fa-reply"></i> ກັບຄືນ...</a>
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

                        {!! Form::model($student, array('url' => 'student/' . $student->st_id, 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}

                        <div class="form-group{{ $errors->has('st_id') ? ' has-error' : '' }} form-inline">
                            {!! Form::label('st_id', 'ລະຫັດນັກສຶກສາ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('stid', $student->st_id, ['class' => 'form-control', 'placeholder' => 'ລະຫັດນັກສຶກສາ', 'disabled']) !!} (ໃຫ້ເປັນຕົວເລກ, ຕົວໜັງສື ແລະ ເຄື່ອງໝາຍ -, _ ເທົ່ານັ້ນ)
                                {!! Form::hidden('st_id', null, ['class' => 'form-control']) !!}
                                {!! Form::hidden('uri', Request::getQueryString(), ['class' => 'form-control']) !!}
                                @if ($errors->has('st_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('st_fname') ? ' has-error' : '' }}">
                            {!! Form::label('st_fname', 'ຊື່ ແລະ ນາມສະກຸນ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('st_fname', null, ['class' => 'form-control', 'placeholder' => 'ຊື່' , 'required']) !!}
                                @if ($errors->has('st_fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('st_lname') ? ' has-error' : '' }}">
                            <div class="col-md-4">
                                {!! Form::text('st_lname', null, ['class' => 'form-control', 'placeholder' => 'ນາມສະກຸນ' , 'required']) !!}
                                @if ($errors->has('st_lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                            {!! Form::label('st_fname_eng', 'ຊື່ ແລະ ນາມສະກຸນ (English):', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('st_fname_eng', null, ['class' => 'form-control', 'placeholder' => 'First name']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::text('st_lname_eng', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
                            </div>
                    </div>

                        <div class="form-group{{ $errors->has('st_gender') ? ' has-error' : '' }}">
                            {!! Form::label('st_gender', 'ເພດ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::radio('st_gender', 'ຊາຍ', true, ['class' => 'form-control minimal']) !!} ຊາຍ
                                {!! Form::radio('st_gender', 'ຍິງ', false, ['class' => 'form-control minimal']) !!} ຍິງ
                                @if ($errors->has('st_gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('st_bdate') ? ' has-error' : '' }} date">
                            {!! Form::label('st_bdate', 'ວັນເດືອນປີເກີດ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('st_bdate', null, ['class' => 'form-control', 'placeholder' => 'ວັນເດືອນປີເກີດ' , 'required', 'id' => 'datepicker' ]) !!}
                                @if ($errors->has('st_bdate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_bdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="{{ $errors->has('st_bprovince') ? ' has-error' : '' }}">
                            {!! Form::label('st_bprovince', 'ແຂວງ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('st_bprovince', App\Province::where('country_code',$student->bdistrict->province->country_code)->pluck('province_name_lo', 'id')->toArray(), $student->bdistrict->prov_id, ['class' => 'select2 form-control', 'placeholder' => '--ແຂວງເກີດ--', 'required']) !!}
                                @if ($errors->has('st_bprovince'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_bprovince') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('st_bdistrict') ? ' has-error' : '' }}">
                            {!! Form::label('st_bdistrict', 'ເມືອງ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('st_bdistrict', App\District::where('prov_id',$student->bdistrict->prov_id)->pluck('district_name_lo', 'id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ເມືອງເກີດ--', 'required']) !!}
                                @if ($errors->has('st_bdistrict'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_bdistrict') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="{{ $errors->has('st_bvillage') ? ' has-error' : '' }}">
                            {!! Form::label('st_bvillage', 'ບ້ານ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('st_bvillage', null, ['class' => 'form-control', 'placeholder' => 'ບ້ານເກີດ' , 'required']) !!}
                                @if ($errors->has('st_bvillage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_bvillage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <div class="{{ $errors->has('st_nationality') ? ' has-error' : '' }}">
                            {!! Form::label('st_nationality', 'ສັນຊາດ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('st_nationality', null, ['class' => 'form-control', 'placeholder' => 'ສັນຊາດ' , 'required']) !!}
                                @if ($errors->has('st_nationality'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_nationality') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('st_region') ? ' has-error' : '' }}">
                            {!! Form::label('st_region', 'ສາດສະໜາ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('st_region', null, ['class' => 'form-control', 'placeholder' => 'ສາດສະໜາ' , 'required']) !!}
                                @if ($errors->has('st_region'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_region') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('st_pprovince') ? ' has-error' : '' }}">
                            {!! Form::label('st_pprovince', 'ທີ່ຢູ່ປັດຈຸບັນ ແຂວງ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                 {!! Form::select('st_pprovince', App\Province::where('country_code',$student->pdistrict->province->country_code)->pluck('province_name_lo', 'id')->toArray(), $student->pdistrict->prov_id, ['class' => 'select2 form-control', 'placeholder' => '--ແຂວງຢູ່ປະຈຸບັນ--', 'required']) !!}
                                @if ($errors->has('st_pprovince'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_pprovince') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="{{ $errors->has('st_bdistrict') ? ' has-error' : '' }}">
                            {!! Form::label('st_pdistrict', 'ເມືອງ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('st_pdistrict', App\District::where('prov_id',$student->pdistrict->prov_id)->pluck('district_name_lo', 'id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ເມືອງຢູ່ປະຈຸບັນ--', 'required']) !!}
                                @if ($errors->has('st_pdistrict'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_pdistrict') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('st_pvillage') ? ' has-error' : '' }}">
                            {!! Form::label('st_pvillage', 'ບ້ານ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('st_pvillage', null, ['class' => 'form-control', 'placeholder' => 'ບ້ານຢູ່ປັດຈຸບັນ' , 'required']) !!}
                                @if ($errors->has('st_pvillage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_pvillage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('st_phone') ? ' has-error' : '' }}">
                            {!! Form::label('st_phone', 'ເບີໂທລະສັບ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::text('st_phone', null, ['class' => 'form-control', 'placeholder' => 'ເບີໂທລະສັບ' , 'required']) !!}
                                @if ($errors->has('st_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('gr_fname') ? ' has-error' : '' }}">
                            {!! Form::label('gr_fname', 'ຊື່ ແລະ ນາມສະກຸນຜູ້ປົກຄອງ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::text('gr_fname', null, ['class' => 'form-control', 'placeholder' => 'ຊື່ຜູ້ປົກຄອງ' , 'required']) !!}
                                @if ($errors->has('gr_fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gr_fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="{{ $errors->has('gr_lname') ? ' has-error' : '' }}">
                            <div class="col-md-4">
                                {!! Form::text('gr_lname', null, ['class' => 'form-control', 'placeholder' => 'ນາມສະກຸນຜູ້ປົກຄອງ' , 'required']) !!}
                                @if ($errors->has('gr_lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gr_lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                        <div class="form-group{{ $errors->has('gr_gender') ? ' has-error' : '' }}">
                            {!! Form::label('gr_gender', 'ເພດ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::radio('gr_gender', 'ຊາຍ', true, ['class' => 'form-control minimal']) !!} ຊາຍ
                                {!! Form::radio('gr_gender', 'ຍິງ', false, ['class' => 'form-control minimal']) !!} ຍິງ
                                @if ($errors->has('gr_gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gr_gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('gr_phone') ? ' has-error' : '' }}">
                            {!! Form::label('gr_phone', 'ເບີໂທລະສັບຜູ້ປົກຄອງ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::text('gr_phone', null, ['class' => 'form-control', 'placeholder' => 'ເບີໂທລະສັບຜູ້ປົກຄອງ' , 'required']) !!}
                                @if ($errors->has('gr_phone'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('gr_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('st_registerdate') ? ' has-error' : '' }} date">
                            {!! Form::label('st_registerdate', 'ເຂົ້າຮຽນສົກປີ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-2">
                                {!! Form::text('st_registerdate', null, ['class' => 'form-control', 'placeholder' => '--ປີເຂົ້າຮຽນ--' , 'disabled' ]) !!}
                                @if ($errors->has('st_registerdate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_registerdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="{{ $errors->has('department') ? ' has-error' : '' }}">
                            {!! Form::label('department', 'ພາກວິຊາ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                 {!! Form::select('department', App\Department::pluck('dept_name', 'id')->toArray(), $student->major->department->id, ['class' => 'select2 form-control', 'placeholder' => '--ພາກວິຊາ--', 'required', $student->xstudent?'disabled':'']) !!}
                                @if ($errors->has('st_department'))
                                    <span class="help-block">
                                        <strong></i>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="{{ $errors->has('ma_id') ? ' has-error' : '' }}">
                            {!! Form::label('ma_id', 'ສາຂາວິຊາ:', ['class' => 'col-md-1 control-label']) !!}
                            <div class="col-md-3">
                                  {!! Form::select('ma_id', App\Major::where('dept_id',$student->major->department->id)->pluck('ma_name', 'id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ສາຂາວີຊາ--', 'required', $student->xstudent?'disabled':'']) !!}
                                @if ($errors->has('ma_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ma_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="{{ $errors->has('de_id') ? ' has-error' : '' }}">
                            {!! Form::label('de_id', 'ລະບົບ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-3">
                                {!! Form::select('de_id', App\Degree::select('degree.id', DB::raw("CONCAT(degree.degree,' ', c.name,' (', degree.program , ')') AS full_text"))->join('courses as c', 'c.id', '=', 'degree.course_id')->leftjoin('sub_major', 'sub_major.de_id', '=', 'degree.id')->where('sub_major.ma_id',$student->ma_id)->pluck('full_text', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => '--ລະບົບ--', 'required', $student->xstudent?'disabled':'']) !!}
                                @if ($errors->has('de_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('de_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                        <div class="form-group{{ $errors->has('st_status') ? ' has-error' : '' }}">
                            {!! Form::label('st_status', 'ສະຖານະນັກສຶກສາ:', ['class' => 'col-md-3 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::radio('st_status', 0, true, ['class' => 'form-control minimal']) !!} ຮຽນປົກກະຕິ
                                {!! Form::radio('st_status', 1, false, ['class' => 'form-control minimal']) !!} ພັກຮຽນຊົ່ວຄາວ
                                {!! Form::radio('st_status', 2, false, ['class' => 'form-control minimal']) !!} ພັກຮຽນຊົ່ວຖາວອນ
                                @if ($errors->has('st_status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('st_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr style="width: 70%">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/student') }}" class="btn bg-orange" style="font-weight: bold;"><span class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-green" style="font-weight: bold;">ບັນທຶກຂໍ້ມູນ <span class="glyphicon glyphicon-ok"></span> </button>
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
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush