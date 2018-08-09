@extends('layouts.app')
@section('title', 'Student Registration')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ລົງທະບຽນຮຽນປະຈໍາປີ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('#') }}">ລົງທະບຽນປະຈໍາປີ</a></li>
            <li class="active">ສະແດງລາຍຊື່ລົງທະບຽນ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-12 pull-left">
                        <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                           href="/manage"><i class="fa fa-reply"></i> ກັບຄືນ </a>
                        @permission('register-create')
                        <a href="{{ url('/register') }}?{{Request::getQueryString()}}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> ລົງທະບຽນ</a>
                        @endpermission
                        @permission('register-list')
                        <a href="" class="btn bg-aqua btn-lg"
                           style="font-weight: bold;"><i class="fa fa-list"></i> ລາຍຊື່ລົງທະບຽນແລ້ວ</a>
                        @endpermission
                        
                    </div>
                </div>

                <div class="box box-info" style="min-height: 400px !important">
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! Form::open(['url'=> 'register/list','method' => 'GET', 'class' => 'form-inline']) !!}
                        <div class="box-body">
                                @php
                                    $Y = date('Y');
                                    $M = date('m');
                                    $AY = ($M>7)?$Y+1:$Y;
                                    for($i=0; $i<5; $i++) {
                                        $acyear = ($AY-1).'-'.$AY;
                                        $AC[$acyear] = $acyear;
                                        $AY--;
                                    }
                                @endphp
                                {!! Form::label('ac_year', 'ສົກຮຽນປີ:', ['class' => 'col-md-0 control-label']) !!}
                                {!! Form::select('ac_year', $AC, null, ['class' => 'select23 form-control', 'required']) !!}
                        </div>
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
                                
                                {!! Form::label('studyyear', 'ຮຽນປີ:', ['class' => 'col-md-0 control-label']) !!}<br>
                                <?php use App\Http\Controllers\RegisterController;?>
                                {!! Form::select('studyyear',  json_decode(RegisterController::getStudyYear(@$_GET['de_id']), TRUE), null, ['class' => 'select22 form-control', 'required', 'placeholder' => '--ຮຽນປີ--']) !!}
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

                        <div class="table-responsive">
                            <table id="registertable_list" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 30px">ລ/ດ</th>
                                    <th class="text-center" style="width: 100px">ລະຫັດນັກສຶກສາ</th>
                                    <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th class="text-center" style="width: 180px">ວັນທີລົງທະບຽນ</th>
                                    <th class="text-center" style="width: 100px">ໃບຮັບເລກທີ</th>
                                    <th class="text-center" style="width: 100px">ວັນທີຈ່າຍ</th>
                                    <th class="text-center" style="width: 50px">ເລືອກ</th>
                                    @permission('register-edit')
                                    <th class="text-center" style="width: 50px">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('register-delete')
                                    <th class="text-center" style="width: 50px">ລືບອອກ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($register as $reg)
                                        
                                        <tr>
                                            <td class="text-center">{{ ++$i }}.</td>
                                            <td class="text-center"><span class="-badge -bg-blue">{{ $reg->st_id}}</span></td>
                                            <td> {{ $reg->st_gender=="ຊາຍ"?"ທ.":"ນ." }} {{ $reg->st_fname }} {{ $reg->st_lname }}</</td>
                                            <td class="text-center">{{ $reg->created_at }}</td>
                                            <td class="text-center">
                                                <?php
                                                if($reg->rg_recieptno) {
                                                    echo $reg->rg_recieptno;
                                                } else {
                                                    echo "<span style='color: red'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> ລໍຖ້າ</span>";
                                                    } 
                                                ?>
                                            </td>
                                            <td class="text-center">{{ $reg->rg_paiddate }}</td>
                                            <td class="text-center">
                                                <input type="checkbox" name="reg_ids[]" value="{{$reg->rg_id}}"
                                                @if( $reg->rg_recieptno )
                                                    @if(!Auth::user()->hasRole('Admin'))
                                                        disabled="disabled"
                                                    @endif
                                                @endif
                                                >
                                            </td>
                                            @permission('register-edit')
                                            <th class="text-center" style="width: 50px">

                                                <button type="button" class="btn btn-success show-btn"
                                                @if( $reg->rg_recieptno )
                                                    @if(!Auth::user()->hasRole('Admin'))
                                                        disabled="disabled"
                                                    @endif
                                                @endif
                                                    data-toggle="modal" data-target="#myModal"
                                                    data-rg_id="{{ $reg->rg_id }}"
                                                    data-st_name="{{ $reg->st_gender=='ຊາຍ'?'ທ.':'ນ.' }} {{ $reg->st_fname }} {{ $reg->st_lname }}"
                                                    data-uri="Request::getQueryString()">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </th>
                                            @endpermission
                                            @permission('register-delete')
                                            <td class="text-center">
                                                {!! Form::open(array('url' => 'register/' . $reg->rg_id, 'method' => 'delete', 'class' => 'delete_form')) !!}
                                                <button type="submit" class="btn btn-danger delete-btn"
                                                @if( $reg->rg_recieptno )
                                                    @if(!Auth::user()->hasRole('Admin'))
                                                        disabled="disabled"
                                                    @endif
                                                @endif
                                                >
                                                <i class="fa fa-trash"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            @endpermission
                                        </tr>
                                @endforeach
                                </tbody>
                                @if( $register->count()>0) 
                                <tfoot>
                                    <tr>
                                        <td colspan="9" style="text-align: right"> 
                                            <a href="javascript:void(0)" id="checkedall"><i class="fa fa-check-square-o" aria-hidden="true"></i> ເລືອກທັງໝົດ</a>&nbsp;&nbsp;
                                            <a href="javascript:void(0)"  id="uncheckall"><i class="fa fa-square-o" aria-hidden="true"></i> ບໍ່ເລືອກທັງໝົດ</a> <br>
                                            <button type="button" class="btn btn-danger" id="btn_delete"><i class="fa fa-trash" aria-hidden="true"></i> ລືບອອກ</button>
                                        </td>
                                    </tr>
                                </tfoot>
                                @endif
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
        {!! Form::open(['url'=> '/register', 'method'=>'delete', 'class' => 'form-horizontal', 'id'=>'form2']) !!}
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

    {{-- Modal Bootstrap Alert --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </span>
                    <center>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size:x-large" class="modal-title"
                            id="exampleModalLabel">ບັນທຶກການສໍາລະຄ່າລົງທະບຽນ</h4>
                    </center>
                </div>

                {!! Form::open(['url'=> 'register', 'method'=>'PATCH', 'class' => 'form-horizontal', 'id'=>'form1']) !!}
                <div class="modal-body" style="margin-left: 15px; margin-right: 15px;">
                    <div class="panel panel-primary" id="show-note" style="padding: 15px;"><center>
                        <table class="panel-body" style="font-family: 'Phetsarath_OT'; ">
                            <tr><th>ຊື່ ແລະ ນາມສະກຸນ: </th><td class="st_name" style="padding: 3px;"><input name="st_name" readonly></td></tr>
                            <tr><th>ເລກທີໃບບິນ: </th><td class="receipt_no" style="padding: 3px;"><input name="rg_recieptno"></td></tr>
                            <tr><th>ວັນທີຈ່າຍ:</th><td class="paid_date" style="padding: 3px;"><input name="rg_paiddate"></td></tr>          
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

        $('#btn_delete').on('click', function () {
            if ( !$('input[type="checkbox"]').is(':checked'))
                return false;

            var form = $('#form2');
            form.append($('input[type="checkbox"]:checked'));
            form.appendTo('body').submit().remove();

        });

           // return $('input[type="checkbox"]').is(':checked');

        $('#checkedall').on('click', function () {
           $('input[type="checkbox"]').iCheck('check');
        });

        $('#uncheckall').on('click', function () {
           $('input[type="checkbox"]').iCheck('uncheck');
        });
    </script>
    <script type="text/javascript">
        $('.show-btn').on('click', function () {
            var rg_id = $(this).data('rg_id');
            var st_name = $(this).data('st_name');

            $('td.st_name').html("<input name='st_name' value='" + st_name + "'' readonly>");
            $('#form1').prop('action', '/register/' + rg_id);
        });

    </script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush

