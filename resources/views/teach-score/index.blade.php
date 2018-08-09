@extends('layouts.app')

@section('title', 'Manage Score')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນຄະແນນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">

            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#"> ຂໍ້ມູນຄະແນນ</a></li>
            <li class="active">ພາກວິຊາ</li>
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'teach_score', 'method' => 'GET', 'class' => 'form-inline']) !!}
                        
                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}" style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-0">
                                {!! Form::label('department', 'ພາກວິຊາ:', ['class' => 'col-md-0 control-label']) !!}*<br>
                                {!! Form::select('department', App\Department::pluck('dept_name', 'id')->toArray(), null, ['class' => 'select23 form-control', 'required', 'placeholder' => '--ພາກວິຊາ--']) !!}

                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ma_id') ? ' has-error' : '' }}" style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-0"> 
                                {!! Form::label('ma_id', 'ສາຂາວິຊາ:', ['class' => 'col-md-0 control-label']) !!}*<br>
                                {!! Form::select('ma_id', App\Major::where('dept_id', @$_GET['department'])->pluck('ma_name','id')->toArray(), null, ['class' => 'select23 form-control', 'required', 'placeholder' => '--ສາຂາວິຊາ--']) !!}

                                @if ($errors->has('ma_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('ma_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('ac_year', 'ສົກຮຽນປີ:', ['class' => 'col-md-0 control-label']) !!}<br>
                            {!! Form::select('ac_year', $ac_option, null, ['class' => 'select23 form-control' ]) !!}
                        </div>
                        <div class="form-group"><br>
                        &nbsp;&nbsp;<button type="submit" class="btn bg-teal-active" style="font-weight: bold;">
                            <span class="glyphicon glyphicon-search"></span> ສະແດງ
                            </button>
                        </div>

                        {!! Form::close() !!}
                        <div class="table-responsive">
                            <table id="classtable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 40px">ລ/ດ</th>
                                    <th class="text-center">ຊື່ຫ້ອງ</th>
                                    <th class="text-center">ຫຼັກສູດ</th>
                                    <th class="text-center" style="width: 50px">ປີ</th>
                                    <th class="text-center" style="width: 100px">ສົກຮຽນປີ</th>
                                    <th class="text-center" style="width: 100px">ຈໍານວນນັກຮຽນ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($classes as $class)

                                <tr>
                                    <td class="text-center">{{ ++$i }}.</td>
                                     <td><a href="{{ action('TeachScoreController@classlist', [$class->cr_id, Request::getQueryString()] ) }}">{{ $class->cr_name }}</a></td>
                                     <td>{{ $class->system }}</td>
                                     <td class="text-center">{{ $class->cr_year }}</td>
                                     <td class="text-center">{{ $class->cr_ac_year }}</td>
                                     <td class="text-center">{{ $class->member }}</td>    
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
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
    <script type="text/javascript">
        

    </script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush