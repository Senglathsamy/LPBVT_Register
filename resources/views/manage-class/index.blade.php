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
            <li class="active">ສະແດງຫ້ອງຮຽນ</li>
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
                        <a href="{{ url('/manage/class/create') }}?{{Request::getQueryString()}}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> ສ້າງຫ້ອງຮຽນໃໝ່</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'manage/class/','method' => 'GET', 'class' => 'form-inline']) !!}
                        
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
                        <div class="form-group">
                            {!! Form::label('ac_year', 'ສົກຮຽນປີ:', ['class' => 'col-md-0 control-label']) !!}<br>
                            {!! Form::select('ac_year', $ac_option, null, ['class' => 'select23 form-control', 'required']) !!}
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
                                    <th class="text-center" style="width: 100px">ຈໍານວນນັກຮຽນ</th>
                                    <th class="text-center" style="width: 50px">ປີ</th>
                                    <th class="text-center" style="width: 200px">ຫຼັກສູດ</th>
                                    @permission('register-edit')
                                    <th class="text-center" style="width: 40px">ສະແດງ</th>
                                    @endpermission
                                    @permission('manage-classroom')
                                    <th class="text-center" style="width: 40px">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('manage-classroom')
                                    <th class="text-center" style="width: 50px">ລຶບອອກ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($classes as $class)

                                <tr>
                                    <td class="text-center">{{ ++$i }}.</td>
                                     <td><a href="{{ action('ManageClassController@enroll', [$class->cr_id, Request::getQueryString()] ) }}">{{ $class->cr_name }}</a></td>
                                     <td class="text-center">{{ $class->member }}</td>
                                    <td class="text-center">{{ $class->cr_year }}</td>
                                    <td>{{ $class->system }}</td>
                                    @permission('register-edit')
                                    <td class="text-center">
                                        <a href="{{ action('ManageClassController@enroll', [$class->cr_id, Request::getQueryString()] ) }}"
                                                   class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    </td>
                                    @endpermission
                                    @permission('manage-classroom')
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success show-btn"
                                                    data-toggle="modal" data-target="#myModal"
                                                    data-cr_id="{{ $class->cr_id }}"
                                                    data-cr_name="{{ $class->cr_name }}"
                                                    data-cr_year="{{ $class->cr_year }}"
                                                    data-cr_ac_year="{{ $class->cr_ac_year }}"
                                                    data-system="{{ $class->system }}"
                                                    data-uri="Request::getQueryString()">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                    </td>
                                    @endpermission
                                    @permission('manage-classroom')
                                    <td class="text-center">
                                        {!! Form::open(array('url' => 'manage/class/' . $class->cr_id, 'method' => 'delete', 'class' => 'delete_form')) !!}
                                        <button type="submit" class="btn btn-danger delete-btn"><i
                                                            class="fa fa-trash"></i>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                    @endpermission
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
    {{-- Modal Bootstrap Alert --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document" style="width: 400px">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </span>
                    <center>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size:x-large" class="modal-title"
                            id="exampleModalLabel">ແກ້ໄຂຂໍ້ມູນຫ້ອງຮຽນ</h4>
                    </center>
                </div>

                {!! Form::open(['url'=> 'manage/class/', 'method'=>'PATCH', 'class' => 'form-horizontal', 'id'=>'form1']) !!}
                <input name="cr_id" value="" type="hidden">
                <div class="modal-body" style="margin-left: 15px; margin-right: 15px;">
                    <div class="panel panel-primary" id="show-note" style="padding: 15px;"><center>
                        <table class="panel-body" style="font-family: 'Phetsarath_OT'; ">
                            <tr><th>ຊື່ຫ້ອງ: </th><td class="cr_name" style="padding: 3px;"><input name="cr_name" value=""></td></tr>         
                        </table></center>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" class="btn bg-primary">
                        <i class="fa fa-floppy-o"></i> ບັນທືກ
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('status_alert')

    @include('.alert')

@endsection
@push('scripts')
    <script type="text/javascript">
        $('.show-btn').on('click', function () {
            var cr_id = $(this).data('cr_id');
            var cr_name = $(this).data('cr_name');

            $('input[name="cr_id"]').val(cr_id);
            $('input[name="cr_name"]').val(cr_name);
        });

    </script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush