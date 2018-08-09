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
            <li class="active">ສະແດງລາຍຊື່ນັກສຶກສາ</li>
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
                        <a href="" class="btn bg-aqua btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> ລົງທະບຽນ</a>
                        @endpermission
                        @permission('register-list')
                        <a href="{{ url('/register/list') }}?{{Request::getQueryString()}}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-list"></i> ລາຍຊື່ລົງທະບຽນແລ້ວ</a>
                        @endpermission
                        
                    </div>
                </div>

                <div class="box box-info" style="min-height: 400px !important">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Phetsarath_OT'; font-weight: bold;">ລົງທະບຽນປະຈໍາສົກຮຽນປີ: 
                            @php 
                                $Y = date('Y');
                                $M = date('m');
                                $AY = ($M>7)?$Y+1:$Y;
                            @endphp
                            {{$AY-1}}-{{$AY}}
                        </h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'register', 'method' => 'GET', 'class' => 'form-inline']) !!}
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

                        {!! Form::open(['url' => 'register/create/', 'class' => 'register_form', 'onsubmit'=>"return checkform()"]) !!}
                                {!! Form::hidden('year', @$_GET['studyyear']) !!}
                                {!! Form::hidden('dept_id', @$_GET['department']) !!}
                                {!! Form::hidden('ma_id', @$_GET['ma_id']) !!}
                                {!! Form::hidden('de_id', @$_GET['de_id']) !!}
                                @php
                                    $AC = ($AY-1).'-'.$AY;
                                @endphp
                                {!! Form::hidden('academicyear', $AC) !!}

                        <div class="table-responsive">
                            <table id="registertable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 40px">ລ/ດ</th>
                                    <th class="text-center" style="width: 100px">ລະຫັດນັກສຶກສາ</th>
                                    <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th class="text-center" style="width: 100px">ເຂົ້າປີ</th>
                                    <th class="text-center" style="width: 100px">ປີຮຽນປະຈຸບັນ</th>
                                    <th class="text-center" style="width: 50px">ເລືອກ</th>
                                    @permission('register-create')
                                    <th class="text-center" style="width: 50px">ລົງທະບຽນ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($student as $std)
                                        
                                        <tr>
                                            <td class="text-center">{{ ++$i }}.</td>
                                            <td class="text-center"><span class="-badge -bg-blue">{{ $std->st_id}}</span></td>
                                            <td> {{ $std->st_gender=="ຊາຍ"?"ທ.":"ນ." }} {{ $std->st_fname }} {{ $std->st_lname }}</</td>
                                            <td class="text-center">{{ $std->st_registerdate }}</td>
                                            <td class="text-center">{{ ($std->current_year)?$std->current_year:'ນັກຮຽນໃໝ່' }}</td>
                                            <td class="text-center">
                                                <input type="checkbox" name="selectstudent[]" value="{{$std->st_id}}">
                                            </td>
                                            @permission('register-create')
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success show-btn"
                                                    data-toggle="modal" data-target="#myModal"
                                                    data-st_id="{{ $std->st_id }}"
                                                    data-st_name="{{ $std->st_gender=='ຊາຍ'?'ທ.':'ນ.' }} {{ $std->st_fname }} {{ $std->st_lname }}"
                                                    data-year="{{ $std->rg_studyyear }}"
                                                    data-ac_year="{{ $std->rg_academicyear }}"
                                                    data-rg_acyear="{{ $AY }}"
                                                    data-uri="Request::getQueryString()">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                            @endpermission
                                        </tr>
                                @endforeach
                                </tbody>
                                @if( $student->count()>0) 
                                <tfoot>
                                    <tr>
                                        <td colspan="7" style="text-align: right"> 
                                            <a href="javascript:void(0)" id="checkedall"><i class="fa fa-check-square-o" aria-hidden="true"></i> ເລືອກທັງໝົດ</a>&nbsp;&nbsp;
                                            <a href="javascript:void(0)"  id="uncheckall"><i class="fa fa-square-o" aria-hidden="true"></i> ບໍ່ເລືອກທັງໝົດ</a> <br>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> ລົງທະບຽນຕາມເລືອກ</button>
                                        </td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
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
                            id="exampleModalLabel">ລົງທະບຽນ</h4>
                    </center>
                </div>

                {!! Form::open(['url'=> 'register/', 'method'=>'POST', 'class' => 'form-horizontal']) !!}
                    <input type="hidden" id="uri" name="uri" value="">
                <div class="modal-body" style="margin-left: 15px; margin-right: 15px;">
                    <div class="panel panel-primary" id="show-note" style="padding: 15px;"><center>
                        <table class="panel-body" style="font-family: 'Phetsarath_OT'; ">
                            <tr><th>ລະຫັດນັກສຶກສາ: </th><td class="st_id" style="padding: 3px;"><input name="st_id" readonly></td></tr>
                            <tr><th>ຊື່ ແລະ ນາມສະກຸນ: </th><td class="st_name" style="padding: 3px;"><input name="st_name" readonly></td></tr>
                            <tr><th>ປີ: </th><td class="to_year" style="padding: 3px;"><input name="year" readonly></td></td></tr>
                            <tr><th>ລົງທະບຽນສົກປີ: </th><td class="ac_year" style="padding: 3px;"><input name="ac_year"></td></tr>
                            <tr><th>ເລກທີໃບບິນ: </th><td class="receipt_no" style="padding: 3px;"><input name="receipt_no"></td></tr>
                            <tr><th>ວັນທີຈ່າຍ:</th><td class="paid_date" style="padding: 3px;"><input name="paid_date"></td></tr>          
                        </table></center>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" class="btn bg-primary">
                        <i class="fa fa-floppy-o"></i> ຢືນຢັນການລົງທະບຽນ
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
        $('#checkedall').on('click', function () {
           $('input[type="checkbox"]').iCheck('check');
        });

        $('#uncheckall').on('click', function () {
           $('input[type="checkbox"]').iCheck('uncheck');
        });

        function checkform() {
            return $('input[type="checkbox"]').is(':checked');
        }
    </script>
    <script type="text/javascript">
        $('.show-btn').on('click', function () {
            var st_id = $(this).data('st_id');
            var st_name = $(this).data('st_name');
            var ac_year = $(this).data('ac_year');
            var rg_acyear = $(this).data('rg_acyear');
            var year = $(this).data('year');
            var url = $(this).data('uri');
            var ac = ac_year.substr(ac_year.length - 4);

            $('td.st_id').html("<input name='st_id' value='" + st_id + "'' readonly>");
            $('td.st_name').html("<input name='st_name' value='" + st_name + "'' readonly>");
            $('td.to_year').html("<input name='year' value='" + (year+1) + "'' readonly>");
            $('#uri').val(uri);
            var option = "";
            ac = (ac_year)?ac:rg_acyear;
            for (i = ac-1; i < rg_acyear; i++) {
                option = option + "<option>" + i + '-' + (i+1) + "</option>"; 
            } 
            $('td.ac_year').html("<select name='ac_year' >" + option + "</select>");
        });
    </script>
    <script src="{{ asset('js/custom.js?l34234234k') }}"></script>
@endpush

