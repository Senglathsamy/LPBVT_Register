@extends('layouts.app')

@section('title', 'View User')

@section('content')
    {{--php artisan db:seed --class=PermissionTableSeeder--}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຜູ້ໃຊ້ລະບົບ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຜູ້ໃຊ້ລະບົບ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນຜູ້ໃຊ້ລະບົບ</li>
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

                        @permission('user-create')
                        <a href="{{ url('/users/create') }}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມຜູ້ໃຊ້ລະບົບ</b></a>
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
                                    <th class="text-center">#</th>
                                    <th class="text-center">ຊື່ຜູ້ໃຊ້</th>
                                    <th class="text-center">ອາຈານສອນ</th>
                                    <th class="text-center">ສິດທິຜູ້ໃຊ້</th>
                                    <th class="text-center">ເຂົ້າໃຊ້ຫຼ້າສຸດ</th>
                                    @permission('user-edit')
                                    <th class="text-center">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('user-delete')
                                    <th class="text-center">ລົບ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    @if(Auth::user()->id == $user->id)
                                        <tr class="success">
                                            <td class="text-center">{{ ++$i }}.</td>
                                            <td style="padding-left: 20px; font-family: 'Phetsarath_OT'; font-size: 16px; font-weight: 600;" class="text text-blue">
                                                {{--<span class="badge bg-blue-active" style="padding-top: 5px; padding-bottom: 5px; padding-left: 15px; padding-right: 15px; font-size: 13px;">--}}
                                                {{ ucfirst($user->username) }}
                                                {{--</span>--}}
                                            </td>
                                            <td>
                                                @if(!empty($user->te_id))
                                                    {{ $user->teacher->te_firstname }} {{ $user->teacher->te_lastname }}
                                                @else
                                                    <span class="text text-red" style="font-size: 20px">{{ '--- ບໍ່ມີ ---' }}</span>
                                                @endif
                                            </td>
                                            <td style="padding-left: 20px;">
                                                @if(!empty($user->roles))
                                                    @foreach($user->roles as $v)
                                                        <span class="badge bg-teal-active"
                                                              style="padding-top: 5px; padding-bottom: 5px; padding-left: 15px; padding-right: 15px; font-size: 13px;">{{ $v->display_name }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(!empty($user->last_login))
                                                    <i class="fa fa-clock-o"
                                                       aria-hidden="true"></i> {{ Carbon\Carbon::parse($user->last_login)->format('d/m/Y H:i:s') }}
                                                @else
                                                    <span class="text text-red" style="font-size: 20px">{{ '--- ບໍ່ມີ ---' }}</span>
                                                @endif
                                            </td>
                                            @permission('user-edit')
                                            <td class="text-center">
                                                <a href="{{ action('UserController@edit', [$user->id]) }}"
                                                   class="btn bg-green"><i class="fa fa-edit"></i></a>
                                            </td>
                                            @endpermission
                                            @permission('user-delete')
                                            <td class="text-center">
                                                {!! Form::open(array('url' => 'users/' . $user->id, 'method' => 'DELETE', 'class' => 'delete_form')) !!}
                                                <button type="submit" class="btn bg-red delete-btn" <?php if(Auth::user()->id == $user->id) echo 'disabled' ?>><i
                                                            class="fa fa-trash"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            @endpermission
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center">{{ ++$i }}.</td>
                                            <td style="padding-left: 20px; font-family: 'Phetsarath_OT'; font-size: 16px; font-weight: 600;" class="text text-blue">
                                                {{--<span class="badge bg-blue-active" style="padding-top: 5px; padding-bottom: 5px; padding-left: 15px; padding-right: 15px; font-size: 13px;">--}}
                                                {{ ucfirst($user->username) }}
                                                {{--</span>--}}
                                            </td>
                                            <td>
                                                @if(!empty($user->te_id))
                                                    {{ $user->teacher->te_firstname }} {{ $user->teacher->te_lastname }}
                                                @else
                                                    <span class="text text-red" style="font-size: 20px">{{ '--- ບໍ່ມີ ---' }}</span>
                                                @endif
                                            </td>
                                            <td style="padding-left: 20px;">
                                                @if(!empty($user->roles))
                                                    @foreach($user->roles as $v)
                                                        <span class="badge bg-teal-active"
                                                              style="padding-top: 5px; padding-bottom: 5px; padding-left: 15px; padding-right: 15px; font-size: 13px;">{{ $v->display_name }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(!empty($user->last_login))
                                                    <i class="fa fa-clock-o"
                                                       aria-hidden="true"></i> {{ Carbon\Carbon::parse($user->last_login)->format('d/m/Y H:i:s') }}
                                                @else
                                                    <span class="text text-red" style="font-size: 20px">{{ '--- ບໍ່ມີ ---' }}</span>
                                                @endif
                                            </td>
                                            @permission('user-edit')
                                            <td class="text-center">
                                                <a href="{{ action('UserController@edit', [$user->id]) }}"
                                                   class="btn bg-green"><i class="fa fa-edit"></i></a>
                                            </td>
                                            @endpermission
                                            @permission('user-delete')
                                            <td class="text-center">
                                                {!! Form::open(array('url' => 'users/' . $user->id, 'method' => 'DELETE', 'class' => 'delete_form')) !!}
                                                <button type="submit" class="btn bg-red delete-btn"><i
                                                            class="fa fa-trash"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            @endpermission
                                        </tr>
                                    @endif
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