@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນສ່ວນຕົວ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນສ່ວນຕົວ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນສ່ວນຕົວຜູ້ເຂົ້າໃຊ້</li>
        </ol>
    </section>

    <br>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-info">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/img/user.svg"
                             alt="User profile picture">

                        <h3 class="profile-username text-center">{{ ucfirst(Auth::user()->username) }}</h3>

                        @if(!empty(Auth::user()->te_id))
                            <p class="text-muted text-center">
                                ອ.ຈ {{ Auth::user()->teacher->te_firstname }} {{ Auth::user()->teacher->te_lastname }}</p>
                        @else
                            <p class="text-red text-center">--ບໍ່ແມ່ນອາຈານ--</p>
                        @endif


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#teacher" data-toggle="tab">ຂໍ້ມູນອາຈານ</a></li>
                        <li><a href="#role-permission" data-toggle="tab">ສິດທິການນຳໃຊ້</a></li>
                        <li><a href="#edit-user" data-toggle="tab">ປ່ຽນແປງຂໍ້ມູນສ່ວນຕົວ</a></li>
                    </ul>

                    <div class="tab-content">

                        <div class="active tab-pane" id="teacher">
                            <!-- Post -->
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="/img/user.svg" alt="user image">
                                    <span class="username"><a href="#">{{ ucfirst(Auth::user()->username) }}</a></span>
                                    @if(!empty(Auth::user()->te_id))
                                        <span class="description">
                                            ອ.ຈ {{ Auth::user()->teacher->te_firstname }} {{ Auth::user()->teacher->te_lastname }}</span>
                                    @else
                                        <span class="description">--ບໍ່ແມ່ນອາຈານ--</span>
                                    @endif
                                </div>
                                <!-- /.user-block -->
                                @if(!empty(Auth::user()->te_id))
                                    <ul class="list-group list-group-unbordered" style="margin-left: 50px; margin-right: 50px;">
                                        <li class="list-group-item">
                                            <b>ຊື່ອາຈານ: </b>ອ.ຈ {{ Auth::user()->teacher->te_firstname }} {{ Auth::user()->teacher->te_lastname }}
                                        </li>
                                        <li class="list-group-item">
                                            <b>ເບີໂທ: </b>{{ Auth::user()->teacher->te_phone}}
                                        </li>
                                        <li class="list-group-item">
                                            <b>ລະດັບການສຶກສາ: </b>{{ Auth::user()->teacher->te_degree}}
                                        </li>
                                        <li class="list-group-item">
                                            <b>ຈົບຈາກສາຂາ: </b>{{ Auth::user()->teacher->te_major}}
                                        </li>
                                        <li class="list-group-item">
                                            <b>ພາກວິຊາ: </b>{{ Auth::user()->teacher->department->dept_name}}
                                        </li>
                                    </ul>
                                @else
                                    <br>
                                    <h2 style="font-family: 'Phetsarath_OT';" class="text-center">--ບໍ່ມີຂໍ້ມູນອາຈານ--</h2>
                                    <br>
                                @endif
                            </div>
                            <!-- /.post -->

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="role-permission">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <li class="time-label">
                        <span class="bg-red">
                          Privilege
                        </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>

                                    <div class="timeline-item">

                                        <div class="timeline-body">
                                            <br>
                                            <div class="form-group" style="font-family: 'Phetsarath_OT'">
                                                <strong>ຊື່ສິດທິ:</strong>
                                                {{ $role->display_name }}
                                            </div>
                                            <div class="form-group" style="font-family: 'Phetsarath_OT'">
                                                <strong>ລາຍລະອຽດ:</strong>
                                                {{ $role->description }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->

                                <!-- timeline time label -->
                                <li class="time-label">
                        <span class="bg-green">
                          Permission
                        </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-users bg-purple"></i>

                                    <div class="timeline-item">

                                        <div class="timeline-body">
                                            <br>
                                            @if(!empty($rolePermissions))
                                                <table class="table table-bordered table-striped table-hover">
                                                    <tr class="bg-blue">
                                                        <th class="text-center">ສິດທິ</th>
                                                        <th class="text-center">ອະທິບາຍ</th>
                                                    </tr>
                                                    @foreach($rolePermissions as $v)
                                                        <tr class="bg-gray-active">
                                                            <td>{{ $v->display_name }}</td>
                                                            <td>{{ $v->description }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="edit-user">

                            {!! Form::model($users, array('url' => 'edit-profile/' . $users->id, 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                {!! Form::label('username', 'ຊື່ຜູ້ໃຊ້', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username' , 'required', 'disabled']) !!}
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', 'ລະຫັດຜ່ານ', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('confirm-password') ? ' has-error' : '' }}">
                                {!! Form::label('confirm-password', 'ຢືນຢັນລະຫັດຜ່ານ', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                    @if ($errors->has('confirm-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('confirm-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                                {!! Form::label('roles', 'ສິດທິຜູ້ເຂົ້າໃຊ້', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::select('roles[]', $roles,$userRole, ['class' => 'select2 form-control', 'placeholder' => 'ເລືອກສິດທິໃຫ້ກັບຜູ້ໃຊ້', 'required', 'multiple' => 'multiple', 'disabled']) !!}
                                    @if ($errors->has('roles'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            {{--<div class="form-group{{ $errors->has('te_id') ? ' has-error' : '' }}">--}}
                                {{--{!! Form::label('te_id', 'ອາຈານສອນ', ['class' => 'col-md-4 control-label']) !!}--}}
                                {{--<div class="col-md-6">--}}
                                    {{--{!! Form::select('te_id', [null=>'--- ບໍ່ຜູກອາຈານໃສ່ຜູ້ໃຊ້ ---'] + App\Teacher::select(DB::raw("CONCAT(te_firstname,' ', te_lastname) AS full_name, id"))->pluck('full_name', 'id')->toArray(), null, ['class' => 'select2 form-control']) !!}--}}
                                    {{--@if ($errors->has('te_id'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('te_id') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn bg-blue"
                                                        style="font-weight: bold;">ປ່ຽນແປງຂໍ້ມູນສ່ວນຕົວ <span
                                                class="glyphicon glyphicon-ok"></span></button>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
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