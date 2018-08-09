@extends('layouts.app')

@section('title', 'Score Management')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນຄະແນນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ URL::previous() }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
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
                       href="/teach_score/?{{ Request::getQueryString() }}"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div style="float: left; margin-left: 30px">
                            <h3 class="box-title" style="font-family: 'Phetsarath_OT'; font-weight: bold;">ຫ້ອງ: {{ $class->cr_name }} , <span style="font-weight: normal; font-size: 14pt;">ປີ {{ $class->cr_year }}, ສົກປີ {{ $class->cr_ac_year }}, {{ $class->degree->degree }} {{ $class->degree->course->name }} ({{ $class->degree->program }}), {{ $class->major->ma_name }}, {{ $class->major->department->dept_name }}</span></h3>
                        </div>
                        <!--include content-->
                            <div class="">
                                <div class="table-responsive box box-solid box-primary">
                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center" style="width: 40px">ລ/ດ</th>
                                                <th class="text-center">ພາກຮຽນ</th>
                                                <th class="text-center">ສະຫັດວິຊາ</th>
                                                <th class="text-center">ຊື່ວິຊາ</th>
                                                <th class="text-center">ອາຈານສອນ</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($teachSubjects as $teachSubject)
                                            <tr class="{{ (@Auth::user()->teacher->id==$teachSubject->te_id | @Auth::user()->username=='admin')?'link':'denied' }}" href="{{ action('TeachScoreController@score', [$class->cr_id, $teachSubject->subb_id, Request::getQueryString()] ) }}">
                                                <td class="text-center">{{ ++$i }}.</td>
                                                <td class="text-center">{{ $teachSubject->term }}</td>
                                                <td class="text-center">{{ $teachSubject->sub_id }}</td>
                                                <td>{{ $teachSubject->sub_name }}</td>
                                                <td>
                                                    {{ $teachSubject->te_init }} {{ @StaticArray::$short_degree[$teachSubject->te_degree]?StaticArray::$short_degree[$teachSubject->te_degree]:'' }} {{ $teachSubject->te_firstname }} {{ $teachSubject->te_lastname }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
<script type="text/javascript">
    $('tr.link').on('click', function() {
        var action = $(this).attr('href');
        document.location = action;
    }).css({'cursor':'pointer', 'font-weight':'bold'})
    .hover(function(){
        $(this).css('color', '#3c8dbc');
    }, function() {
        $(this).css('color', '');
    });

    $('tr.denied').on('click', function() {
    });

</script>
<script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
@endpush