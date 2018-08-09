@extends('layouts.app')

@section('title', 'View Program')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນລະບົບການຮຽນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນລະບົບການຮຽນ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນລະບົບການຮຽນ</li>
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

                        @permission('degree-create')
                        <a href="{{ url('degree/create') }}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມຂໍ້ມູນລະບົບການຮຽນ</b></a>
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
                            <table id="degreetable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ວູດທິ</th>
                                    <th class="text-center">ສາຍ</th>
                                    <th class="text-center">ລະບົບ</th>
                                    @permission('degree-edit')
                                    <th class="text-center" style="width: 50px;">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('degree-delete')
                                    <th class="text-center" style="width: 50px;">ລົບຂໍ້</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($degree as $dg)
                                    <tr>
                                        <td class="text-center">{{ $dg->degree }}</td>
                                        <td class="text-center">{{ $dg->course->name }}</td>
                                        <td class="text-center">({{ $dg->program }})</td>
                                        </td>
                                        @permission('degree-edit')
                                        <td class="text-center">
                                            <a href="{{ action('DegreeController@edit', [$dg->id]) }}"
                                               class="btn bg-green"><i class="fa fa-edit"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('degree-delete')
                                        <td class="text-center">
                                            {!! Form::open(array('url' => 'degree/' . $dg->id, 'method' => 'delete', 'class' => 'delete_form')) !!}
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