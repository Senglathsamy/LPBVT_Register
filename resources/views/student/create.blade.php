@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຂໍ້ມູນນັກສຶກສາ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('/student') }}">ຂໍ້ມູນນັກສຶກສາ</a></li>
            <li class="active">ເພີ່ມຂໍ້ມູນນັກສຶກສາ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="{{ url('/student') }}"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tabpane1" data-toggle="tab">ເພີ່ມເທື່ອລະຄົນ</a></li>
                        <li><a href="#tabpane2" data-toggle="tab">ເພີ່ມຂໍ້ມູນນັກສຶກສາດ້ວຍໄຟລ໌ .Excel</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="tabpane1">
                            <!--div class="box box-info"-->
                                <div class="box-header" align="center">
                                    <h3 class="box-title"></h3>
                                </div>

                                <div class="box-body">

                                    {!! Form::open(['url'=> 'student', 'class' => 'form-horizontal']) !!}
                                        {!! Form::hidden('st_status', 0, ['class' => 'form-control']) !!}
                                    <div class="form-group{{ $errors->has('st_id') ? ' has-error' : ' 111' }} form-inline">
                                        {!! Form::label('st_id', 'ລະຫັດນັກສຶກສາ:', ['class' => 'col-md-3 control-label']) !!}
                                        <div class="col-md-6">
                                            {!! Form::text('st_id', null, ['class' => 'form-control my-form-inline', 'placeholder' => 'ລະຫັດນັກສຶກສາ ' , 'required']) !!} (ໃຫ້ເປັນຕົວເລກ, ຕົວໜັງສື ແລະ ເຄື່ອງໝາຍ -, _ ເທົ່ານັ້ນ)
                                            @if ($errors->has('st_id'))
                                                <span class="help-block">
                                                    <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_id') }}</strong>
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
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_fname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="{{ $errors->has('st_lname') ? ' has-error' : '' }}">
                                            <div class="col-md-4">
                                                {!! Form::text('st_lname', null, ['class' => 'form-control', 'placeholder' => 'ນາມສະກຸນ' , 'required']) !!}
                                                @if ($errors->has('st_lname'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_lname') }}</strong>
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
                                                    <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="{{ $errors->has('st_bdate') ? ' has-error' : '' }} date">
                                            {!! Form::label('st_bdate', 'ວັນເດືອນປີເກີດ:', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-3">
                                                {!! Form::text('st_bdate', null, ['class' => 'form-control', 'placeholder' => 'yyyy-mm-dd' , 'required', 'id' => 'datepicker' ]) !!}
                                                @if ($errors->has('st_bdate'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_bdate') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="{{ $errors->has('st_bprovince') ? ' has-error' : '' }}">
                                            {!! Form::label('st_bprovince', 'ທີ່ເກີດ ແຂວງ:', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-3">
                                                {!! Form::select('st_bprovince', App\Province::where('country_code','LA')->pluck('province_name_lo', 'id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ແຂວງເກີດ--', 'required']) !!}
                                                @if ($errors->has('st_bprovince'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_bprovince') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="{{ $errors->has('st_bdistrict') ? ' has-error' : '' }}">
                                            {!! Form::label('st_bdistrict', 'ເມືອງ:', ['class' => 'col-md-1 control-label']) !!}
                                            <div class="col-md-3">
                                                {!! Form::select('st_bdistrict', App\District::where('prov_id', old('st_bprovince'))->pluck('district_name_lo','id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ເມືອງເກີດ--', 'required']) !!}
                                                @if ($errors->has('st_bdistrict'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_bdistrict') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="{{ $errors->has('st_bvillage') ? ' has-error' : '' }}">
                                            {!! Form::label('st_bvillage', 'ບ້ານ:', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-3">
                                                {!! Form::text('st_bvillage', null, ['class' => 'form-control', 'placeholder' => 'ບ້ານເກີດ' , 'required']) !!}
                                                @if ($errors->has('st_bvillage'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_bvillage') }}</strong>
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
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_nationality') }}</strong>
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
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_region') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="{{ $errors->has('st_pprovince') ? ' has-error' : '' }}">
                                            {!! Form::label('st_pprovince', 'ທີ່ຢູ່ປັດຈຸບັນ ແຂວງ:', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-3">
                                                 {!! Form::select('st_pprovince', App\Province::where('country_code', 'LA')->pluck('province_name_lo', 'id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ແຂວງຢູ່ປະຈຸບັນ--', 'required']) !!}
                                                @if ($errors->has('st_pprovince'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i>{{ $errors->first('st_pprovince') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="{{ $errors->has('st_bdistrict') ? ' has-error' : '' }}">
                                            {!! Form::label('st_pdistrict', 'ເມືອງ:', ['class' => 'col-md-1 control-label']) !!}
                                            <div class="col-md-3">
                                                {!! Form::select('st_pdistrict', App\District::where('prov_id', old('st_pprovince'))->pluck('district_name_lo','id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ເມືອງຢູ່ປະຈຸບັນ--', 'required']) !!}
                                                @if ($errors->has('st_pdistrict'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i>{{ $errors->first('st_pdistrict') }}</strong>
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
                                                        <strong><i class="fa fa-times-circle-o"></i>{{ $errors->first('st_pvillage') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="{{ $errors->has('st_phone') ? ' has-error' : '' }}">
                                            {!! Form::label('st_phone', 'ເບີໂທລະສັບ', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-4">
                                                {!! Form::text('st_phone', null, ['class' => 'form-control', 'placeholder' => 'ເບີໂທລະສັບ' , 'required']) !!}
                                                @if ($errors->has('st_phone'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="{{ $errors->has('gr_fname') ? ' has-error' : '' }}">
                                            {!! Form::label('gr_fname', 'ຊື່ ແລະ ນາມສະກຸນ ຜູ້ປົກຄອງ:', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-3">
                                                {!! Form::text('gr_fname', null, ['class' => 'form-control', 'placeholder' => 'ຊື່ຜູ້ປົກຄອງ' , 'required']) !!}
                                                @if ($errors->has('gr_fname'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('gr_fname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="{{ $errors->has('gr_lname') ? ' has-error' : '' }}">
                                            <div class="col-md-4">
                                                {!! Form::text('gr_lname', null, ['class' => 'form-control', 'placeholder' => 'ນາມສະກຸນຜູ້ປົກຄອງ' , 'required']) !!}
                                                @if ($errors->has('gr_lname'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('gr_lname') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="{{ $errors->has('gr_gender') ? ' has-error' : '' }}">
                                            {!! Form::label('gr_gender', 'ເພດ:', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-6">
                                                {!! Form::radio('gr_gender', 'ຊາຍ', true, ['class' => 'form-control minimal']) !!} ຊາຍ
                                                {!! Form::radio('gr_gender', 'ຍິງ', false, ['class' => 'form-control minimal']) !!} ຍິງ
                                                @if ($errors->has('gr_gender'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('gr_gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="{{ $errors->has('gr_phone') ? ' has-error' : '' }}">
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
                                    </div>

                                    <div class="form-group">
                                        <div class="{{ $errors->has('st_department') ? ' has-error' : '' }}">
                                            {!! Form::label('st_department', 'ພາກວິຊາ:', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-3">
                                                 {!! Form::select('st_department', App\Department::pluck('dept_name', 'id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ພາກວິຊາ--', 'required']) !!}
                                                @if ($errors->has('st_department'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i>{{ $errors->first('st_department') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="{{ $errors->has('ma_id') ? ' has-error' : '' }}">
                                            {!! Form::label('ma_id', 'ສາຂາວິຊາ:', ['class' => 'col-md-1 control-label']) !!}
                                            <div class="col-md-3">
                                                {!! Form::select('ma_id', App\Major::where('dept_id', old('st_department'))->pluck('ma_name','id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => '--ສາຂາວີຊາ--', 'required']) !!}
                                                @if ($errors->has('ma_id'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('ma_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="{{ $errors->has('de_id') ? ' has-error' : '' }}">
                                            {!! Form::label('de_id', 'ລະບົບ:', ['class' => 'col-md-3 control-label']) !!}
                                            <div class="col-md-3">
                                                {!! Form::select('de_id', App\Degree::join('courses as c', 'c.id', '=', 'degree.course_id')->select('degree.id', DB::raw("CONCAT(degree.degree,' ', c.name,' (', degree.program , ')') AS full_text"))->orderBy('full_text')->pluck('full_text', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => '--ລະບົບ--', 'required']) !!}

                                                @if ($errors->has('de_id'))
                                                    <span class="help-block">
                                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('de_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                                    <hr style="width: 70%">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <a href="{{ url('/student') }}" class="btn bg-orange"
                                               style="font-weight: bold;"><span
                                                class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                                &nbsp;&nbsp;<button type="submit" class="btn bg-blue"
                                                    style="font-weight: bold;">ບັນທຶກຂໍ້ມູນ <span
                                                    class="glyphicon glyphicon-ok"></span></button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            <!--/div-->
                        </div>
                        <div class="tab-pane" id="tabpane2">
                            <!--div class="box box-info"-->
                                <div class="box-header" align="center">
                                    <h3 class="box-title"></h3>
                                </div>

                                <div class="box-body">
                                    <form style="border: 1px solid #ddd; margin-top: 15px;padding: 10px;"
                                    action="{{ URL::to('importExcelStudent') }}" class="form-inline" method="post"
                                    enctype="multipart/form-data">
                                        <input type="file" name="import_file" class="form-control" required/>&nbsp;&nbsp;
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn bg-green"> Import File <i
                                        class="fa fa-file-excel-o" aria-hidden="true"></i></button>
                                    </form>
                                    <p>&nbsp;</p>
                                    <a href="/resources/views/student/Student_Import_Template.xlsx">Download .Excel Template</a>
                                </div>
                            <!--/div-->
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tabs-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- Main content -->

@endsection
@push('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush