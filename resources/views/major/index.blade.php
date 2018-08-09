@extends('layouts.app')

@section('title', 'View Major')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນສາຂາວິຊາ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນສາຂາວິຊາ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນສາຂາວິຊາ</li>
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
                           href="/manage"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                        @permission('major-create')
                        <a href="{{ url('/major/create') }}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມຂໍ້ມູນສາຂາວິຊາ</b></a>
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
                        <div class="table-responsive">
                            <table id="majortable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລ/ດ</th>
                                    <th class="text-center">ສາຂາວິຊາ</th>
                                    <th class="text-center">ພາກວິຊາ</th>
                                    @permission('major-edit')
                                    <th class="text-center">ແກ້ໄຂຂໍ້ມູນ</th>
                                    @endpermission
                                    @permission('major-delete')
                                    <th class="text-center">ລົບຂໍ້ມູນ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($major as $majors)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}.</td>
                                        <td>{{ $majors->ma_name }}</td>
                                        <td>{{ $majors->department->dept_name }}</td>
                                        @permission('major-edit')
                                        <td class="text-center">
                                            <a href="{{ action('MajorController@edit', [$majors->id]) }}"
                                               class="btn bg-green"><i class="fa fa-edit"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('major-delete')
                                        <td class="text-center">
                                            {!! Form::open(array('url' => 'major/' . $majors->id, 'method' => 'delete', 'class' => 'delete_form')) !!}
                                            <button type="submit" class="btn bg-red delete-btn"><i
                                                        class="fa fa-trash"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                        @endpermission
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