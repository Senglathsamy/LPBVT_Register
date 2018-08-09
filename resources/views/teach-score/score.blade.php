@extends('layouts.app')

@section('title', 'Score Management')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນຄະແນນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ສະແດງລາຍວິຊາ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/teach_score/class/{{$class->cr_id}}?{{ Request::getQueryString() }}"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div style="font-family: 'Phetsarath_OT'; font-size: 14pt; margin-left: 20px"><br>
                            ຫ້ອງ: <span style="font-weight: bold; font-size: 14pt;"> {{ $class->cr_name }}</span> , ປີ {{ $class->cr_year }}, ສົກປີ {{ $class->cr_ac_year }}, {{ $class->degree->degree }} {{ $class->degree->course->name }} ({{ $class->degree->program }}), {{ $class->major->ma_name }}, {{ $class->major->department->dept_name }}<br>
                            ວິຊາ: <span style="font-weight: bold;">{{App\Subject::find($studentScore->first()->subb_id)->sub_name}}</span> ອາຈານປະຈໍາວິຊາ: <span style="font-weight: bold;">
                            @php ($teacher = App\Teacher::find($studentScore->first()->te_id))
                            {{ $teacher->te_init }} {{ $teacher->te_firstname }} {{ $teacher->te_lastname }}</span>
                        </div>
                        <!--include content-->
                            <div class="col-md-10">
                                <div class="table-responsive box box-solid box-primary">
                                    <div class="box-body">
                        
                                        {!! Form::open(array('url' => 'teach_score/score/update', 'method' => 'PATCH', 'class' => 'form-inline')) !!}
                                        <table id="enrolledable" class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center" style="width: 50px">ລ/ດ</th>
                                                <th class="text-center">ສະຫັດນັກສຶກສາ</th>
                                                <th class="text-center">ຊື່ນັກສຶກສາ</th>
                                                <th class="text-center">ເກຣດ</th>
                                                <th class="text-center">ໝາຍເຫດ</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($studentScore as $Score)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}.</td>
                                                <td class="text-center">{{ $Score->st_id }}</td>
                                                <td>{{ $Score->full_name }}</td>
                                                <td class="text-center">
                                                    <input name="score[{{ $Score->id }}]" id="{{ $Score->id }}" value="{{ strtoupper($Score->score_real) }}"
                                                    {{ ($Score->score_upgraded)?'disabled':'' }}
                                                    size="6" style="text-align: center;"/>
                                                    </td>
                                                <td class="text-center">
                                                    @if($Score->score_upgraded)
                                                    <a>
                                                        ແກ້ເກຣດແລ້ວ: ({{ strtoupper($Score->score_upgraded) }})
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            @if(count($studentScore)>0 )
                                            <tfoot>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-center"><button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> ບັນທຶກ</button></td>
                                                <td><a class="btn btn-default" href="/teach_score/class/{{$class->cr_id}}?{{ Request::getQueryString() }}"><i class="fa fa-times"></i> &nbsp;&nbsp;ປິດ&nbsp;&nbsp; </a></td>
                                            </tr>
                                            </tfoot>
                                            @endif
                                        </table>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>   
                        <!--include content-->
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
<script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
@endpush