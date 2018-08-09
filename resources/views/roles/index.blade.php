@extends('layouts.app')

@section('title', 'View Role Permission')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ສິດທິຜູ້ເຂົ້າໃຊ້ລະບົບ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ສິດທິຜູ້ເຂົ້າໃຊ້ລະບົບ</a></li>
            <li class="active">ສະແດງສິດທິຜູ້ເຂົ້າໃຊ້</li>
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
                           href="/"><i class="fa fa-reply"></i> ກັບຄືນ</a>

                        @permission('role-create')
                        <a href="{{ url('/role/create') }}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມສິດທິຜູ້ເຂົ້າໃຊ້</b></a>
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
                                    <th class="text-center">ສິດທິຜູ້ເຂົ້າໃຊ້</th>
                                    <th class="text-center">ຊື່ເຕັມ</th>
                                    <th class="text-center">ລາຍລະອຽດ</th>
                                    @permission('role-list')
                                        <th class="text-center">ສະແດງ</th>
                                    @endpermission
                                    @permission('role-edit')
                                        <th class="text-center">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('role-delete')
                                        <th class="text-center">ລົບ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}.</td>
                                        <td><span class="badge bg-teal-active" style="padding-top: 5px; padding-bottom: 5px; padding-left: 15px; padding-right: 15px; font-size: 13px;">{{ $role->name }}</span></td>
                                        <td>{{ $role->display_name }}</td>
                                        <td>{{ $role->description }}</td>
                                        @permission('role-list')
                                        <td class="text-center">
                                            <a href="{{ action('RoleController@show', [$role->id]) }}"
                                               class="btn bg-teal"><i class="fa fa-eye"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('role-edit')
                                        <td class="text-center">
                                            <a href="{{ action('RoleController@edit', [$role->id]) }}"
                                               class="btn bg-green"><i class="fa fa-edit"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('role-delete')
                                        <td class="text-center">
                                            {!! Form::open(array('url' => 'role/' . $role->id, 'method' => 'DELETE', 'class' => 'delete_form')) !!}
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