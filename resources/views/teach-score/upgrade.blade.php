@extends('layouts.app')

@section('title', 'Score Upgrade')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນຄະແນນແກ້ເກຣດ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">

            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#"> ຂໍ້ມູນຄະແນນແກ້ເກຣດ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນຄະແນນແກ້ເກຣດ</li>
        </ol>
        {{--</span>--}}
    </section>

    <!-- Main content -->
    <section class="content">
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <br>

                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        {!! Form::open(['url'=> 'teach_score_upgrade','method' => 'GET', 'class' => 'form-inline']) !!}

                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}"
                             style="font-family: 'Saysettha OT'">
                            {{--                            {!! Form::label('year', 'ປີຮຽນ', ['class' => 'col-md-4 control-label']) !!}--}}
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

                        <div class="form-group{{ $errors->has('subb_id') ? ' has-error' : '' }}"
                             style="font-family: 'Saysettha OT'">
                            <div class="col-md-6">
                                {{--                                {!! Form::select('subb_id', App\Subject::select(DB::raw("CONCAT(sub_name,' ','(', sub_id , ')') AS full_name, id"))->pluck('full_name', 'id'), null, ['class' => 'select2 form-control', 'required']) !!}--}}
                                {!! Form::select('subb_id', App\SubTeach::with('subject')->where('te_id', Auth::user()->te_id)->get()->pluck('subject.sub_name', 'subject.id'), null, ['class' => 'select24 form-control', 'required']) !!}
                                @if ($errors->has('subb_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('subb_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        &nbsp;&nbsp;<button type="submit" class="btn bg-orange" style="font-weight: bold;">
                            <span class="glyphicon glyphicon-search"></span> ຄົ້ນຫາ
                        </button>


                        {!! Form::close() !!}

                        <br>
                        <hr>

                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລ/ດ</th>
                                    <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th class="text-center">ໜ່ວຍກິດ - ອາຈານສອນ</th>
                                    <th class="text-center">ເກຣດເກົ່າ</th>
                                    <th class="text-center">ຄະແນນແກ້ເກຣດ</th>
                                    <th class="text-center">ປ່ຽນແປງຫຼ້າສຸດ</th>
                                    @permission('upgrade-score')
                                    <th class="text-center">ແກ້ໄຂເກຣດ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($score_upgrade as $sg)
                                    @foreach($sg as $sc)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}.</td>
                                            <td>{{ $sc->register->student->st_fname }} {{ $sc->register->student->st_lname }}</td>
                                            <td>
                                                <span class="badge bg-light-blue"
                                                      style="padding-top: 5px; padding-bottom: 5px; padding-left: 8px; padding-right: 8px; font-size: 13px;">
                                                {{ $sc->subjects->sub_credit }} ໜ່ວຍກິດ
                                            </span> &nbsp;
                                                @if(($sc->te_id == null) || ($sc->te_id == ""))
                                                    <span style="color: #ff2638;">{{ 'ຍັງບໍ່ມີອາຈານສອນ' }}</span>
                                                @else
                                                    {{ $sc->teachers->te_firstname }} {{ $sc->teachers->te_lastname }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(($sc->score_real == null) || ($sc->score_real == ""))
                                                    <span class="badge bg-orange-active"
                                                          style="padding-top: 5px; padding-bottom: 5px; padding-left: 8px; padding-right: 8px; font-size: 13px;">{{ 'ຍັງບໍ່ມີຄະແນນ' }}</span>
                                                @else
                                                    <span class="badge bg-blue-active"
                                                          style="padding-top: 5px; padding-bottom: 5px; padding-left: 32px; padding-right: 32px; font-size: 13px;">{{ $sc->score_real }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(($sc->score_upgrade == null) || ($sc->score_upgrade == ""))
                                                    <span class="badge bg-orange-active"
                                                          style="padding-top: 5px; padding-bottom: 5px; padding-left: 8px; padding-right: 8px; font-size: 13px;">{{ 'ຍັງບໍ່ມີຄະແນນ' }}</span>
                                                @else
                                                    <span class="badge bg-teal-active"
                                                          style="padding-top: 5px; padding-bottom: 5px; padding-left: 32px; padding-right: 32px; font-size: 13px;">{{ $sc->score_upgrade }}</span>
                                                @endif

                                            </td>
                                            <td class="text-center"><i class="fa fa-clock-o"
                                                                       aria-hidden="true"></i> {{ Carbon\Carbon::parse($sc->updated_at)->format('d/m/Y H:i:s') }}
                                            </td>
                                            @permission('upgrade-score')
                                            <td class="text-center">

                                                {!! Form::open(array('url' => 'teach_score_upgrade/' . $sc->id, 'method' => 'PATCH', 'class' => 'form-inline')) !!}
                                                <div class="form-group{{ $errors->has('score_upgrade') ? ' has-error' : '' }}"
                                                     style="font-family: 'Saysettha OT'">
                                                    <div class="col-md-10">
                                                        {!! Form::select('score_upgrade', [NULL=>'ຍັງບໍ່ມີຄະແນນ','B+' => ' B+ ','B' => ' B ','C+' => ' C+ ', 'C' => ' C ','D+' => ' D+ ','D' => ' D ','F' => ' F ','W' => ' W ','I' => ' I '], $sc->score_upgrade, ['class' => 'form-control select25', 'required']) !!}
                                                        @if ($errors->has('score_upgrade'))
                                                            <span class="help-block"><strong>{{ $errors->first('score_upgrade') }}</strong></span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <button type="submit"
                                                        class="btn btn-info" <?php if (($sc->te_id == null) || ($sc->te_id == "")) echo "disabled=''"; if (Auth::user()->te_id != $sc->te_id) echo "disabled=''";?>>
                                                    <i class="fa fa-pencil"></i>
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