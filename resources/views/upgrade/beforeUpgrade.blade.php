@extends('layouts.app')

@section('title', 'Check Student')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ</B>
        </h1>
        <ol class="breadcrumb" class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="/major_select/{!! Request::session()->get('ma_id') !!}">ຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ</a></li>
            <li class="active">ກວດສອບຂໍ້ມູນລົງທະບຽນຮຽນ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="{{ url('/major_select/' . Request::session()->get('ma_id')) }}"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">

                <br>

                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url' => 'upgrade/create', 'method' => 'GET', 'class' => 'form-horizontal']) !!}

                        {!! Form::hidden('ma_id', $ma_id, ['class' => 'form-control']) !!}

                        <div class="form-group{{ $errors->has('ug_studyyear') ? ' has-error' : '' }}">
                            {!! Form::label('ug_studyyear', 'ປີຮຽນ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('ug_studyyear', [1 => 'ປີ 1',2 => 'ປີ 2',3 => 'ປີ 3',4 => 'ປີ 4'], null, ['class' => 'form-control select2', 'placeholder' => 'ກະລຸນາເລືອກປີຮຽນ' , 'required']) !!}
                                @if ($errors->has('ug_studyyear'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ug_studyyear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('st_id') ? ' has-error' : '' }}">
                            {!! Form::label('st_id', 'ນັກສຶກສາ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('st_id', App\Student::select(DB::raw("CONCAT(st_fname,' ',st_lname, ' ', '(ລະຫັດ: ', st_id , ')') AS full_name, st_id"))->where('ma_id', $ma_id)->pluck('full_name', 'st_id'), null, ['class' => 'select2 form-control', 'placeholder' => 'ກະລຸນາເລືອກນັກສຶກສາ', 'required']) !!}

                                @if ($errors->has('st_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subb_id') ? ' has-error' : '' }}">
                            {!! Form::label('subb_id', 'ວິຊາທີ່ອັບເກຣດ', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                    {!! Form::select('subb_id', App\SubMajor::with('subject')->where('ma_id', $ma_id)->get()->pluck('subject.sub_name', 'subject.id')->toArray(), null, ['class' => 'select2 form-control', 'placeholder' => 'ກະລຸນາເລືອກວິຊາທີ່ອັບເກຣດ', 'required']) !!}
{{--                                {!! Form::select('subb_id', App\Subject::select(DB::raw("CONCAT(sub_name,' ','(', sub_id , ')') AS full_name, id"))->pluck('full_name', 'id'), null, ['class' => 'select2 form-control', 'placeholder' => 'ກະລຸນາເລືອກວິຊາທີ່ອັບເກຣດ', 'required']) !!}--}}

                                @if ($errors->has('subb_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('de_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/major_select/' . Request::session()->get('ma_id')) }}" class="btn bg-orange"
                                               style="font-weight: bold;"><span
                                            class="glyphicon glyphicon-remove"></span> ຍົກເລີກ</a>
                                &nbsp;&nbsp;<button type="submit" class="btn bg-blue"
                                                    style="font-weight: bold;">ກວດສອບຂໍ້ມູນລົງທະບຽນຮຽນ <span
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

@push('scripts')

@endpush

