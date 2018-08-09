@extends('layouts.app')

@section('title', 'Student Report')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ລາຍງານຂໍ້ມູນນັກສຶກສາ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ລາຍງານຂໍ້ມູນນັກສຶກສາ</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">


        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/report"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
            </div>
        </div>
        <br>

        <div class="row">

            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header  with-border">
                        <i class="fa fa-search"></i>
                        <h3 class="box-title" style="font-family: Phetsarath_OT;">ລາຍງານຂໍ້ມູນນັກສຶກສາ (ປີຮຽນ, ຫ້ອງ, ສົກຮຽນ ແລະ ສາຂາວິຊາ)</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn bg-blue btn-sm" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'student-report','method' => 'GET', 'class' => 'form-inline']) !!}
						<div class="form-group{{ $errors->has('ma_id') ? ' has-error' : '' }}"
                             style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-6">
                                {!! Form::select('ma_id', App\Major::pluck('ma_name', 'id')->toArray(), null, ['class' => 'select24 form-control', 'placeholder' => 'ສາຂາວິຊາ', 'required']) !!}

                                @if ($errors->has('ma_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('ma_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('academicyear') ? ' has-error' : '' }}"
                             style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-6">
                                {!! Form::select('academicyear', [null=>'ສົກຮຽນ'] + App\Register::pluck('rg_academicyear', 'rg_academicyear')->toArray(), null, ['class' => 'select24 form-control']) !!}
                                @if ($errors->has('academicyear'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('academicyear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}"
                             style="font-family: 'Phetsarath_OT'">
                            {{--                            {!! Form::label('year', 'ປີຮຽນ', ['class' => 'col-md-4 control-label']) !!}--}}
                            <div class="col-md-6">
                                {!! Form::select('year', [null=>'ປີຮຽນ'] + [1 => 'ປີ 1',2 => 'ປີ 2',3 => 'ປີ 3',4 => 'ປີ 4'], null, ['class' => 'form-control select24']) !!}
                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('classno') ? ' has-error' : '' }}"
                             style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-6">
                                {!! Form::select('classno', [null=>'ຫ້ອງຮຽນ'] +  App\Register::pluck('rg_classno', 'rg_classno')->toArray(), null, ['class' => 'select24 form-control']) !!}
                                @if ($errors->has('classno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('classno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						

                        &nbsp;&nbsp;<button type="submit" class="btn bg-blue" style="font-weight: bold;">
                            <span class="glyphicon glyphicon-search"></span> ຄົ້ນຫາ
                        </button>


                        &nbsp;&nbsp;<a href="/student-excel?ma_id={{ $ma_id }}&year={{ $year }}&classno={{ $classno }}&academicyear={{ $academicyear }}"
                                class="btn bg-green"
                                style="font-weight: 600; <?php if (@!$st) echo "pointer-events: none;"; ?>">
                            <span class="fa fa-file-excel-o"></span> Export to Excel </a>

                        {!! Form::close() !!}

                        <br>
                        <div class="table-responsive">
                            <table id="example4" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລະຫັດ</th>
                                    <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th class="text-center">ວັນເດືອນປີເກີດ</th>
                                    <th class="text-center">ເພດ</th>
                                    <th class="text-center">ເບີໂທ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($student as $stds)
                                    @foreach($stds as $std)
                                        <tr>
                                            <td style="padding-right: 30px; font-weight: bold;"
                                                class="text-center">{{ $std->student->st_id }}</td>
                                            <td style="padding-left: 30px;">{{ $std->student->st_fname }} {{ $std->student->st_lname }}</td>
                                            <td style="padding-right: 30px;"
                                                class="text-center">{{ Carbon\Carbon::parse($std->student->st_bdate)->format('d/m/Y') }}</td>
                                            <td style="padding-right: 30px;"
                                                class="text-center">{{ $std->student->st_gender }}</td>
                                            <td style="padding-right: 30px;"
                                                class="text-center">{{ $std->student->st_phone }}</td>
                                        </tr>
                                @endforeach
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


