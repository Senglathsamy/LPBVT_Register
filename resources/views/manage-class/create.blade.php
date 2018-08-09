@extends('layouts.app')

@section('title', 'Manage Class')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຈັດຫ້ອງຮຽນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">

            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ສ້າງຫ້ອງຮຽນ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                        <a href="{{ url('/manage/class') }}?{{Request::getQueryString()}}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-list"></i> ລາຍການຫ້ອງຮຽນ</a>
                        <a href="" class="btn bg-aqua btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> ສ້າງຫ້ອງຮຽນໃໝ່</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-info">
                    <div class="box-header" align="center">
                        <br>
                        <h2 class="box-title" style="font-family: 'Phetsarath_OT'; font-weight: 600; font-size: 16pt">ສ້າງຫ້ອງໃໝ່</h2>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                    {!! Form::open(['url'=> '/manage/class/', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

                        <div class="form-group{{ $errors->has('cr_name') ? ' has-error' : ' ' }}">
                            {!! Form::label('cr_name', 'ຊື່ຫ້ອງ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::text('cr_name', null, ['class' => 'form-control', 'placeholder' => '--ຊື່ຫ້ອງ--', 'required']) !!}
                                @if ($errors->has('cr_name'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('cr_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cr_name') ? ' has-error' : ' ' }}"">
                            {!! Form::label('cr_ac_year', 'ສົກຮຽນປີ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-4">
                                @php
                                    $Y = date('Y');
                                    $M = date('m');
                                    $AY = ($M>7)?$Y+1:$Y;
                                    $AC = ($AY-1).'-'.$AY;
                                @endphp
                                {!! Form::text('cr_ac_year', @$AC, ['class' => 'form-control', 'placeholder' => '--ສົກປີ--', 'required', 'readonly']) !!}
                                @if ($errors->has('cr_ac_year'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('cr_ac_year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            {!! Form::label('department', 'ພາກວິຊາ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-4">
                                {!! Form::select('department', App\Department::pluck('dept_name', 'id')->toArray(), null, ['class' => 'select27 form-control', 'required', 'placeholder' => '--ພາກວິຊາ--']) !!}
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ma_id') ? ' has-error' : '' }}">
                            {!! Form::label('ma_id', 'ສາຂາວິຊາ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-4"> 
                                {!! Form::select('ma_id', App\Major::where('dept_id', @$_GET['department'])->pluck('ma_name','id')->toArray(), null, ['class' => 'select27 form-control', 'required', 'placeholder' => '--ສາຂາວິຊາ--']) !!}
                                @if ($errors->has('ma_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('ma_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('de_id') ? ' has-error' : '' }}">
                            {!! Form::label('de_id', 'ລະບົບການຮຽນ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-4">
                                
                                {!! Form::select('de_id', App\Degree::leftjoin('sub_major', 'sub_major.de_id', '=', 'degree.id')
                                    ->join('courses', 'degree.course_id', '=', 'courses.id')
                                    ->where('sub_major.ma_id', @$_GET[ma_id])->groupby('degree.id')
                                    ->selectRaw("degree.id, CONCAT(degree.degree,' ', courses.name,' (', degree.program , ')') AS full_text")->orderBy('full_text')
                                    ->pluck('full_text', 'id'), null, ['class' => 'select27 form-control', 'required', 'placeholder' => '--ລະບົບຮຽນ--']) !!}
                                @if ($errors->has('de_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('de_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('studyyear') ? ' has-error' : '' }}">
                            {!! Form::label('studyyear', 'ຮຽນປີ:', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-4">
                                <?php use App\Http\Controllers\RegisterController;?>
                                {!! Form::select('studyyear',  json_decode(RegisterController::getStudyYear(@$_GET['de_id']), TRUE), null, ['class' => 'select23 form-control', 'required', 'placeholder' => '--ຮຽນປີ--']) !!}
                                @if ($errors->has('studyyear'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('studyyear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="/manage/class/?{{Request::getQueryString()}}" class="btn bg-orange"
                                    style="font-weight: bold;"><span
                                    class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>&nbsp;&nbsp;
                                <button type="submit" class="btn bg-blue"
                                    style="font-weight: bold;">ບັນທຶກຂໍ້ມູນ <span
                                    class="glyphicon glyphicon-ok"></span></button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        
                        </div>
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
@push('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush