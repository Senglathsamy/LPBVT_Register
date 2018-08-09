@extends('layouts.app')

@section('title', 'View Department')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນພາກວິຊາ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນພາກວິຊາ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນພາກວິຊາ</li>
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

                        @permission('dept-create')
                        <a href="{{ url('/dept/create') }}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມຂໍ້ມູນພາກວິຊາ</b></a>
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
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລ/ດ</th>
                                    <th class="text-center">ຊື່ພາກວິຊາ</th>
                                    @permission('dept-edit')
                                    <th class="text-center">ແກ້ໄຂຂໍ້ມູນ</th>
                                    @endpermission
                                    @permission('dept-delete')
                                    <th class="text-center">ລົບຂໍ້ມູນ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($department as $dept)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}.</td>
                                        <td style="padding-left: 30px;">{{ $dept->dept_name }}</td>
                                        @permission('dept-edit')
                                        <td class="text-center">
                                            <a href="{{ action('DepartmentController@edit', [$dept->id]) }}"
                                               class="btn bg-green"><i class="fa fa-edit"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('dept-delete')
                                        <td class="text-center">
                                            {!! Form::open(array('url' => 'dept/' . $dept->id, 'method' => 'delete', 'class' => 'delete_form')) !!}
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