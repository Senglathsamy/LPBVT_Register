@extends('layouts.app')

@section('title', 'Register Report')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ລາຍງານຂໍ້ມູນລົງທະບຽນຮຽນ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ລາຍງານຂໍ້ມູນລົງທະບຽນຮຽນ</li>
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
                    <div class="box-header with-border">
                        <i class="fa fa-search"></i>
                        <h3 class="box-title" style="font-family: Phetsarath_OT;">ລາຍງານຂໍ້ມູນລົງທະບຽນຮຽນ (ປະຈຳ ຫ້ອງ ແລະ ສົກຮຽນ)</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn bg-blue btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'register-report','method' => 'GET', 'class' => 'form-inline']) !!}

                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}"
                             style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-6">
                                {!! Form::select('year', [null=>'ປີຮຽນ'] + [1 => 'ປີ 1',2 => 'ປີ 2',3 => 'ປີ 3',4 => 'ປີ 4'], null, ['class' => 'form-control select24']) !!}
                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('academicyear') ? ' has-error' : '' }}"
                             style="font-family: 'Saysettha OT'">
                            <div class="col-md-6">
                                {!! Form::select('academicyear', [null=>'ສົກຮຽນ'] + App\Register::pluck('rg_academicyear', 'rg_academicyear')->toArray(), null, ['class' => 'select23 form-control', 'required']) !!}
                                @if ($errors->has('academicyear'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('academicyear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        &nbsp;&nbsp;<button type="submit" class="btn bg-blue" style="font-weight: bold;">
                            <span class="glyphicon glyphicon-search"></span> ຄົ້ນຫາ
                        </button>

                        &nbsp;&nbsp;<a href="/register-excel?academicyear={{ $academicyear }}&year={{ $year }}"
                                class="btn bg-green" style="font-weight: 600; <?php if (count($register) <= 0) echo "pointer-events: none;"; ?>">
                            <span class="fa fa-file-excel-o"></span> Export to Excel</a>

                        {!! Form::close() !!}

                        <br>


                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລະຫັດ</th>
                                    <th class="text-center">ຊື່&ນາມສະກຸນ</th>
                                    <th class="text-center">ລົງທະບຽນວັນທີ</th>
                                    <th class="text-center">ປີ</th>
                                    <th class="text-center">ຫ້ອງ</th>
                                    <th class="text-center">ສົກຮຽນ</th>
                                    <th class="text-center">ວັນທີຈ່າຍ</th>
                                    <th class="text-center">ເລກໃບບິນ</th>
                                </tr>

                                </thead>
                                <tbody>

                                @foreach($register as $reg)
                                    <tr>
                                        <td style="padding-right: 30px; font-weight: bold;" class="text-center">{{ $reg->student->st_id }}</td>
                                        <td>{{ $reg->student->st_fname }} {{ $reg->student->st_lname }}</td>
                                        <td class="text-center">
                                            {{ Carbon\Carbon::parse($reg->rg_date)->format('d/m/Y') }}
                                        </td>
                                        <td class="text-center">{{ $reg->rg_studyyear }}</td>
                                        <td class="text-center">{{ $reg->rg_classno }}</td>
                                        <td class="text-center">{{ $reg->rg_academicyear }}</td>
                                        <td class="text-center">
                                            @if(!empty($reg->rg_paiddate))
                                                {{ Carbon\Carbon::parse($reg->rg_paiddate)->format('d/m/Y') }}
                                            @else
                                                {{ '----' }}
                                            @endif
                                        </td>
                                        <td style="padding-right: 30px; font-weight: bold;" class="text-center">
                                            @if(!empty($reg->rg_recieptno))
                                                {{ $reg->rg_recieptno }}
                                            @else
                                                {{ '----' }}
                                            @endif
                                        </td>
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


