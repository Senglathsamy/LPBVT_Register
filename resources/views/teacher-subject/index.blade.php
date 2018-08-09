@extends('layouts.app')

@section('title', 'View Teacher Subject')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນອາຈານສອນປະຈໍາວິຊາ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນອາຈານສອນປະຈໍາວິຊາ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນອາຈານສອນປະຈໍາວິຊາ</li>
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
                            <table id="teachersubjecttable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 40px">ລະຫັດວິຊາ</th>
                                    <th class="text-center" style="width: 180px">ວິຊາສອນ</th>
                                    <th class="text-center">ລາຍຊື່ອາຈານສອນປະຈໍາວິຊາ</th>
                                    @permission('teacher-subject-edit')
                                    <th class="text-center">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('teacher-subject-delete')
                                    <th class="text-center">ລົບ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teacher_subject as $t_s)
                                    
                                        <tr>
                                            <td class="text-center">{{ $t_s->sub_id }}.</td>
                                            <td>{{ $t_s->sub_name }}</td>
                                            <td>
                                                @if($t_s->teacher()->count() > 0)
                                                @foreach($t_s->teacher as $sub)
                                                    <span class="badge bg-teal-active" style="padding-top: 5px; padding-bottom: 5px; padding-left: 8px; padding-right: 8px; margin-top: 5px; margin-bottom: 5px; font-size: 13px;">
                                                        {{ $sub->te_init }} {{ @StaticArray::$short_degree[$sub->te_degree]?StaticArray::$short_degree[$sub->te_degree]:'' }} {{ $sub->te_firstname }} {{ $sub->te_lastname }}
                                                    </span>
                                                    
                                                @endforeach
                                                @endif
                                            </td>
                                            @permission('teacher-subject-edit')
                                            <td class="text-center">
                                                <a href="{{ action('TeacherSubjectController@edit', [$t_s->id]) }}"
                                                   class="btn bg-green"><i
                                                            class="fa fa-edit"></i></a>
                                            </td>
                                            @endpermission
                                            @permission('teacher-subject-delete')
                                            <td class="text-center">
                                                {!! Form::open(array('url' => 'teacher_subject/' . $t_s->id, 'method' => 'delete', 'class' => 'delete_form')) !!}
                                                <button type="submit" class="btn bg-red delete-btn">
                                                    <i class="fa fa-trash"></i>
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