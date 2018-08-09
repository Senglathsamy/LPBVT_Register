@extends('layouts.app')

@section('title', 'Manage Teacher to Subject')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຈັດຫ້ອງຮຽນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">

            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນວິຊາສອນອາຈານ</li>
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
                        <a href="" class="btn bg-aqua btn-lg"
                           style="font-weight: bold;"><i class="fa fa-list"></i> ລາຍການຫ້ອງຮຽນ</a>
                        <a href="{{ url('/register/list') }}?{{Request::getQueryString()}}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> ສ້ອງຫ້ອງຮຽນ</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                         {!! Form::open(['url'=> 'register','method' => 'GET', 'class' => 'form-inline']) !!}
                       <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}" style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-0">
                                {!! Form::label('department', 'ພາກວິຊາ:', ['class' => 'col-md-0 control-label']) !!}<br>
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
                                {!! Form::label('ma_id', 'ສາຂາວິຊາ:', ['class' => 'col-md-0 control-label']) !!}<br>
                                {!! Form::select('ma_id', App\Major::where('dept_id', @$_GET['department'])->pluck('ma_name','id')->toArray(), null, ['class' => 'select23 form-control', 'required', 'placeholder' => '--ສາຂາວິຊາ--']) !!}

                                @if ($errors->has('ma_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('ma_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('de_id') ? ' has-error' : '' }}" style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-0">
                                {!! Form::label('de_id', 'ລະບົບການຮຽນ:', ['class' => 'col-md-0 control-label']) !!}<br>
                                {!! Form::select('de_id', App\Degree::leftjoin('sub_major', 'sub_major.de_id', '=', 'degree.id')
                                    ->join('courses', 'degree.course_id', '=', 'courses.id')
                                    ->where('sub_major.ma_id', @$_GET[ma_id])->groupby('degree.id')
                                    ->selectRaw("degree.id, CONCAT(degree.degree,' ', courses.name,' (', degree.program , ')') AS full_text")->orderBy('full_text')
                                    ->pluck('full_text', 'id'), null, ['class' => 'select23 form-control', 'required', 'placeholder' => '--ລະບົບຮຽນ--']) !!}
                                @if ($errors->has('de_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('de_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('studyyear') ? ' has-error' : '' }}" style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-0">
                                
                                {!! Form::label('studyyear', 'ລົງທະບຽນຮຽນປີ:', ['class' => 'col-md-0 control-label']) !!}<br>
                                <?php use App\Http\Controllers\RegisterController;?>
                                {!! Form::select('studyyear',  json_decode(RegisterController::getStudyYear(@$_GET['de_id']), TRUE), null, ['class' => 'select22 form-control', 'required', 'placeholder' => '--ເຂົ້າປີ--']) !!}
                                @if ($errors->has('studyyear'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('studyyear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"><br>
                        &nbsp;&nbsp;<button type="submit" class="btn bg-teal-active" style="font-weight: bold;">
                            <span class="glyphicon glyphicon-search"></span> ສະແດງ
                            </button>
                        </div>


                        {!! Form::close() !!}

                        <br>

                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລ/ດ</th>
                                    <th class="text-center">ລະຫັດວິຊາ</th>
                                    <th class="text-center">ຊື່ວິຊາ</th>
                                    <th class="text-center">ໜ່ວຍກິດ</th>
                                    <th class="text-center">ພາກຮຽນ</th>
                                    @permission('manage-teacher-subject')
                                    <th class="text-center">ເລືອກອາຈານສອນ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($manage_teach_score as $manage)
                                    @foreach($manage as $manage_teacher)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}.</td>
                                            <td><span class="badge bg-teal-active"
                                                      style="padding-top: 5px; padding-bottom: 5px; padding-left: 8px; padding-right: 8px; font-size: 13px;">{{ $manage_teacher->subjects->sub_id }}
                                                </span>
                                            </td>
                                            <td>{{ $manage_teacher->subjects->sub_name }}
                                            </td>
                                            <td> {{ $manage_teacher->subjects->sub_credit }}
                                            </td>
                                            <td> 
                                            </td>
                                            @permission('manage-teacher-subject')
                                            <td class="text-center">
                                                {!! Form::open(array('url' => 'manage_teach_score/' . $manage_teacher->subb_id, 'method' => 'PATCH', 'class' => 'form-inline')) !!}
                                                {!! Form::hidden('classno', $classno, ['class' => 'form-control']) !!}
                                                {!! Form::hidden('academicyear', $academicyear, ['class' => 'form-control']) !!}
                                                <div class="form-group{{ $errors->has('te_id') ? ' has-error' : '' }}"
                                                     style="font-family: 'Saysettha OT'">
                                                    <div class="col-md-10">
{{--                                                        {!! Form::select('te_id', App\SubTeach::with('teacher')->where('subb_id', $manage_teacher->subjects->id)->get()->pluck('teacher.te_firstname', 'subject.id')->toArray(), null, ['class' => 'select24 form-control', 'required']) !!}--}}
                                                        {!! Form::select('te_id', [null=>'--- ບໍ່ມີອາຈານສອນ ---'] + App\Teacher::select(DB::raw("CONCAT(te_firstname,' ',te_lastname) AS full_name, id"))->pluck('full_name', 'id')->toArray(), $manage_teacher->te_id, ['class' => 'form-control select23', 'placeholder' => 'ເລືອກອາຈານສອນ', 'required']) !!}
                                                        {{--where('dept_id', $dept->dept_id)->--}}
                                                        @if ($errors->has('te_id'))
                                                            <span class="help-block"><strong>{{ $errors->first('te_id') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            @endpermission
                                        </tr>

                                @endforeach
                                @break
                                @endforeach
                                </tfoot>
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