@extends('layouts.app')

@section('title', 'View Course')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນຫລັກສູດ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນຫລັກສູດ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນຫລັກສູດ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <br>

                <div class="row">
                    <div class="col-md-12 pull-left">
                        <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                           href="/manage"><i class="fa fa-reply"></i> ກັບຄືນ</a>

                        @permission('course-create')
                        <a href="{{ url('/sub_major/create?') }}{{Request::getQueryString()}}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມຂໍ້ມູນຫລັກສູດ</b></a>
                        @endpermission
                    </div>
                </div>

                <br>

                <div class="box box-info">
                    <div class="box-header">
                        <!--h3 class="box-title"></h3-->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'sub_major','method' => 'GET', 'class' => 'form-inline']) !!}
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
                                {!! Form::label('de_id', 'ລະບົບຮຽນ:', ['class' => 'col-md-0 control-label']) !!}<br>
                                {!! Form::select('de_id', App\Degree::join('courses as c', 'c.id', '=', 'degree.course_id')->select('degree.id', DB::raw("CONCAT(degree.degree,' ', c.name,' (', degree.program , ')') AS full_text"))->orderBy('full_text')->pluck('full_text', 'id'), null, ['class' => 'select23 form-control', 'required', 'placeholder' => '--ລະບົບຮຽນ--']) !!}

                                @if ($errors->has('de_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('de_id') }}</strong>
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
                            <table id="majorsubjects" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ປີຮຽນ</th>
                                    <th class="text-center">ພາກຮຽນ</th>
                                    <th class="text-center">ວິຊາຮຽນ</th>
                                    <th class="text-center">ລະຫັດວິຊາຮຽນ</th>
                                    <th class="text-center"> ໜ່ວຍກິດ</th>
                                    @permission('course-edit')
                                    <th class="text-center" style="width: 50px;">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('course-delete')
                                    <th class="text-center" style="width: 50px;">ລົບ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sub_major as $sm)
                                    <tr>
                                        <td class="text-center">{{ $sm->year }}</td>
                                        <td class="text-center">{{ $sm->term }}</td>
                                        <td style="padding-left: 25px;">
                                            {{ $sm->subject->sub_name }}
                                        </td>
                                        <td class="text-center">
                                            {{ $sm->subject->sub_id }}
                                        </td>
                                        <td class="text-center">
                                            <span class="text-center">
                                                {{ $sm->subject->sub_credit }}
                                            </span>
                                        </td>
                                        
                                        @permission('course-edit')
                                        <td class="text-center">
                                            <a href="{{ action('MajorSubjectController@edit', [$sm->id, Request::getQueryString()]) }}"
                                               class="btn bg-green"><i
                                                        class="fa fa-edit"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('course-delete')
                                        <td class="text-center">
                                            {!! Form::open(array('url' => 'sub_major/' . $sm->id, 'method' => 'delete', 'class' => 'delete_form')) !!}
                                            <button type="submit" class="btn bg-red delete-btn">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                        @endpermission
                                    </tr>
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
@push('scripts')
<script src="{{ asset('js/custom.js?df') }}"></script>
@endpush