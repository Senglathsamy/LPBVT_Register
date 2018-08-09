@extends('layouts.app')

@section('title', 'Upgrade Report')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ລາຍງານການລົງທະບຽນແກ້ເກຣດ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ລາຍງານການລົງທະບຽນແກ້ເກຣດ</li>
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
                        <h3 class="box-title" style="font-family: Phetsarath_OT;">ລາຍງານການລົງທະບຽນແກ້ເກຣດ (ປະຈຳ ສົກຮຽນ)</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn bg-blue btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'upgrade-report','method' => 'GET', 'class' => 'form-inline']) !!}

                        <div class="form-group{{ $errors->has('academicyear') ? ' has-error' : '' }}"
                             style="font-family: 'Saysettha OT'">
                            <div class="col-md-6">
                                {!! Form::select('academicyear', [null=>'ສົກຮຽນ'] + App\Register::pluck('rg_academicyear', 'rg_academicyear')->toArray(), null, ['class' => 'select26 form-control', 'required']) !!}
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

                        &nbsp;&nbsp;<a href="/upgrade-excel?academicyear={{ $academicyear }}"
                                       class="btn bg-green" style="font-weight: 600; <?php if ($ug <= 0) echo "pointer-events: none;"; ?>">
                            <span class="fa fa-file-excel-o"></span> Export to Excel</a>

                        {!! Form::close() !!}

                        <br>


                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລະຫັດ</th>
                                    <th class="text-center">ຊື່&ນາມສະກຸນ</th>
                                    <th class="text-center">ເພດ</th>
                                    <th class="text-center">ວັນທີຈ່າຍ</th>
                                    <th class="text-center">ເລກໃບບິນ</th>
                                </tr>

                                </thead>
                                <tbody>

                                @foreach($upgrade as $upgs)
                                    @foreach($upgs as $upg)
                                    <tr>
                                        <td style="padding-right: 30px; font-weight: bold;" class="text-center">{{ $upg->student->st_id }}</td>
                                        <td>{{ $upg->student->st_fname }} {{ $upg->student->st_lname }}</td>
                                        <td class="text-center">{{ $upg->student->st_gender }}</td>
                                        <td class="text-center">
                                            @if(!empty($upg->ug_paiddate))
                                                {{ Carbon\Carbon::parse($upg->ug_paiddate)->format('d/m/Y') }}
                                            @else
                                                {{ '----' }}
                                            @endif
                                        </td>
                                        <td style="padding-right: 30px; font-weight: bold;" class="text-center">
                                            @if(!empty($upg->ug_recieptno))
                                                {{ $upg->ug_recieptno }}
                                            @else
                                                {{ '----' }}
                                            @endif
                                        </td>
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


