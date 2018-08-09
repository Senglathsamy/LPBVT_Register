@extends('layouts.app')

@section('title', 'Score Report')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ລາຍງານໃບຄະແນນ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ລາຍງານໃບຄະແນນ</li>
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

                <div class="box box-danger">
                    <div class="box-header with-border">
                        <i class="fa fa-search"></i>
                        <h3 class="box-title" style="font-family: Phetsarath_OT;">ລາຍງານໃບຄະແນນ</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn bg-blue btn-sm" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'score-report','method' => 'GET', 'class' => 'form-inline']) !!}

                        <div class="form-group{{ $errors->has('st_id') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                {!! Form::select('st_id', App\Student::select(DB::raw("CONCAT(st_fname,' ',st_lname, ' ', '(ລະຫັດ: ', st_id , ')') AS full_name, st_id"))->pluck('full_name', 'st_id'), null, ['class' => 'select26 form-control', 'placeholder' => 'ເລືອກນັກສຶກສາ', 'required']) !!}

                                @if ($errors->has('st_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('st_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        &nbsp;&nbsp;<button type="submit" class="btn bg-blue" style="font-weight: bold;">
                            <span class="glyphicon glyphicon-search"></span> ຄົ້ນຫາ
                        </button>

                        &nbsp;&nbsp;<a href="/score-pdf?st_id=kk"
                                       class="btn bg-red-active" style="font-weight: 600; <?php if (!isset($academicyear)) echo "pointer-events: none;"; ?>">
                            <span class="fa fa-file-pdf-o"></span> Export to PDF</a>

                        {!! Form::close() !!}

                        <br>


                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">ລະຫັດນັກສຶກສາ</th>
                                    <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th class="text-center">ເພດ</th>
                                    <th class="text-center">ເບີໂທ</th>
                                    <th class="text-center">ສາຂາຮຽນ</th>
                                </tr>
                                </thead>
                                <tbody>



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


