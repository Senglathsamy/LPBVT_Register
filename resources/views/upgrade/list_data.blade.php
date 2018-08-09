@extends('layouts.app')

@section('title', 'View Upgrade')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ</B>
        </h1>
        <ol class="breadcrumb" class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="/upgrade">ຂໍ້ມູນພາກວິຊາ</a></li>
            <li><a href="/dept_select/{!! Request::session()->get('de_id') !!}">ຂໍ້ມູນສາຂາວິຊາ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ</li>
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
                           href="/dept_select/{!! Request::session()->get('de_id') !!}"><i class="fa fa-reply"></i> ກັບຄືນ</a>

                        @permission('upgrade-create')
                        <a href="/check_upgrade/before_create/{!! Request::session()->get('ma_id') !!}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມຂໍ້ມູນລົງທະບຽນແກ້ເກຣດ</b></a>
                        @endpermission
                    </div>
                </div>

                <br>

                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'major_select/'. Request::session()->get('ma_id'),'method' => 'GET', 'class' => 'form-inline']) !!}

                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}"
                             style="font-family: 'Saysettha OT'">
                            <div class="col-md-6">
                                {!! Form::select('year', [1 => 'ປີ 1',2 => 'ປີ 2',3 => 'ປີ 3',4 => 'ປີ 4'], null, ['class' => 'form-control select24', 'required']) !!}
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
                                {!! Form::select('academicyear', App\Register::pluck('rg_academicyear', 'rg_academicyear'), null, ['class' => 'select24 form-control', 'required']) !!}
                                @if ($errors->has('academicyear'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('academicyear') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('de_id') ? ' has-error' : '' }}"
                             style="font-family: 'Saysettha OT'">
                            <div class="col-md-6">
                                {!! Form::select('de_id', App\Degree::select(DB::raw("CONCAT(degree,' ','(', program , ')') AS full_name, id"))->pluck('full_name', 'id'), null, ['class' => 'select24 form-control', 'required']) !!}
                                @if ($errors->has('de_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('de_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        &nbsp;&nbsp;<button type="submit" class="btn bg-orange" style="font-weight: bold;">
                            <span class="glyphicon glyphicon-search"></span> ຄົ້ນຫາ
                        </button>


                        {!! Form::close() !!}

                        <br>

                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລ/ດ</th>
                                    <th class="text-center">ຄັ້ງທີ</th>
                                    <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th class="text-center">ວັນທີຈ່າຍ</th>
                                    <th class="text-center">ເລກໃບບິນ</th>
                                    @permission('upgrade-edit')
                                    <th class="text-center">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('upgrade-delete')
                                    <th class="text-center">ລົບ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($upgrade as $upg)
                                    @foreach($upg as $ug)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}.</td>
                                        <td class="text-center">{{ count($upg) }}</td>
                                        <td>{{ $ug->student->st_fname }} {{ $ug->student->st_lname }}</td>
                                        <td class="text-center"><i class="fa fa-calendar" aria-hidden="true"></i> {{ Carbon\Carbon::parse($ug->ug_paiddate)->format('d/m/Y') }}</td>
                                        <td class="text-center"><span class="badge bg-teal-active" style="padding-top: 5px; padding-bottom: 5px; padding-left: 15px; padding-right: 15px; font-size: 13px;">{{ $ug->ug_recieptno }}</span></td>
                                        @permission('upgrade-edit')
                                        <td class="text-center">
                                            <a href="{{ action('UpgradeController@edit', [$ug->ug_id]) }}" style="pointer-events: none;"
                                               class="btn bg-green"><i class="fa fa-edit"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('upgrade-delete')
                                        <td class="text-center">
                                            {!! Form::open(array('url' => 'upgrade/' . $ug->ug_id, 'method' => 'delete', 'class' => 'delete_form')) !!}
                                            <button type="submit" class="btn bg-red delete-btn" disabled=""><i
                                                        class="fa fa-trash"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                        @endpermission
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

@push('scripts')

@endpush

