@extends('layouts.app')

@section('title', 'View Subject')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນລາຍວິຊາ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນລາຍວິຊາ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນລາຍວິຊາ</li>
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

                        @permission('subject-create')
                        <a href="{{ url('/subject/create') }}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມຂໍ້ມູນລາຍວິຊາ</b></a>
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
                            <table id="subject" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">ລະຫັດວິຊາ</th>
                                    <th class="text-center">ຊື່ວິຊາ</th>
                                    <th class="text-center">ໜ່ວຍກິດ</th>
                                    <th class="text-center">( ບັນຍາຍ - ປະຕິບັດ - ທົດລອງ)</th>
                                    @permission('subject-edit')
                                    <th class="text-center">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('subject-delete')
                                    <th class="text-center">ລົບ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subject as $sub)
                                    <tr>
                                        <td class="text-center">{{ $sub->sub_id }}</td>
                                        <td>{{ $sub->sub_name }}</td>
                                        <td class="text-center">{{ $sub->sub_credit }}</td>
                                        <td class="text-center">({{ $sub->sub_unit1 }} - {{ $sub->sub_unit2 }} - {{ $sub->sub_unit3 }})</td>
                                        @permission('subject-edit')
                                        <td class="text-center">
                                            <a href="{{ action('SubjectController@edit', [$sub->id]) }}"
                                               class="btn bg-green"><i class="fa fa-edit"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('subject-delete')
                                        <td class="text-center">
                                            {!! Form::open(array('url' => 'subject/' . $sub->id, 'method' => 'delete', 'class' => 'delete_form')) !!}
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