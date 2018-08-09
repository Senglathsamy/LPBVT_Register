@extends('layouts.app')

@section('title', 'View Student')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຂໍ້ມູນນັກສຶກສາທັງໝົດ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('#') }}">ຂໍ້ມູນນັກສຶກສາ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນນັກສຶກສາ</li>
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
                           href="/manage"><i class="fa fa-reply"></i> ກັບຄືນ </a>
                        @permission('student-create')
                        <a href="{{ url('/student/create') }}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> ເພີ່ມຂໍ້ມູນນັກສຶກສາ</a>
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


                        {!! Form::open(['url'=> 'student','method' => 'GET', 'class' => 'form-inline']) !!}
                       <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}" style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-0">
                                {!! Form::select('department', App\Department::pluck('dept_name', 'id')->toArray(), null, ['class' => 'select23 form-control', 'placeholder' => '--ພາກວິຊາ--']) !!}

                                @if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ma_id') ? ' has-error' : '' }}" style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-0"> 
                                {!! Form::select('ma_id', App\Major::where('dept_id', @$_GET['department'])->pluck('ma_name','id')->toArray(), null, ['class' => 'select23 form-control', 'placeholder' => '--ສາຂາວິຊາ--']) !!}

                                @if ($errors->has('ma_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('ma_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('de_id') ? ' has-error' : '' }}" style="font-family: 'Phetsarath_OT'">
                            <div class="col-md-0">
                                {!! Form::select('de_id', App\Degree::join('courses as c', 'c.id', '=', 'degree.course_id')->select('degree.id', DB::raw("CONCAT(degree.degree,' ', c.name,' (', degree.program , ')') AS full_text"))->orderBy('full_text')->pluck('full_text', 'id'), null, ['class' => 'select23 form-control', 'placeholder' => '--ລະບົບຮຽນ--']) !!}
                                @if ($errors->has('de_id'))
                                    <span class="help-block">
                                        <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('de_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        &nbsp;&nbsp;<button type="submit" class="btn bg-teal-active" style="font-weight: bold;">
                            <span class="glyphicon glyphicon-search"></span> ສະແດງ
                        </button>


                        {!! Form::close() !!}

                        <hr>

                        <div class="table-responsive">
                            <table id="studenttable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 30px">ລ/ດ</th>
                                    <th class="text-center">ລະຫັດນັກສຶກສາ</th>
                                    <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th class="text-center">ພາກວິຊາ</th>
                                    <th class="text-center">ສາຂາຮຽນ</th>
                                    <th class="text-center" style="width: 80px">ຫຼັກສູດ</th>
                                    <th class="text-center">ສະແດງ</th>
                                    @permission('student-edit')
                                    <th class="text-center">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('student-delete')
                                    <th class="text-center">ລົບ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($student as $std)
                                        
                                            <tr  class="{{ $std->st_status == 1?'warning':($std->st_status == 2?'danger':'') }}" 
                                                title="
                                                {{ $std->st_status == 1?'ສະຖານະພາບ: ພັກການຮຽນຊົ່ວຄາວ':($std->st_status == 2?'ສະຖານະພາບ: ພັກການຮຽນຖາວອນ':'') }}
                                                ">
                                            <td class="text-center">{{ ++$i }}.</td>
                                            <td class="text-center"><span class="-badge -bg-blue">{{ $std->st_id}}</span></td>
                                            <td> {{ $std->st_gender=="ຊາຍ"?"ທ.":"ນ." }} {{ $std->st_fname }} {{ $std->st_lname }}</</td>
                                            <td>{{ @$std->major->department->dept_name }}</td>
                                            <td>{{ @$std->major->ma_name }}</td>
                                            <td class="text-center">{{ @$std->degree->degree }} {{ @$std->degree->course->name }} ({{ @$std->degree->program }})</td>
                                            <td class="text-center">
                                            <button type="button" class="btn bg-teal show-btn"
                                                    data-toggle="modal" data-target="#myModal"
                                                        data-id="{{ $std->st_id }}"
                                                        data-firstname="{{ $std->st_fname }}"
                                                        data-lastname="{{ $std->st_lname }}"
                                                        data-firstname_eng="{{ $std->st_fname_eng }}"
                                                        data-lastname_eng="{{ $std->st_lname_eng }}"
                                                        data-gender="{{ $std->st_gender }}"
                                                        data-birthday="{{ Carbon\Carbon::parse($std->st_bdate)->format('d/m/Y') }}"
                                                        data-bvillage="{{ $std->st_bvillage }}"
                                                        data-bdistrict="{{ @$std->bdistrict->district_name_lo }}"
                                                        data-bprovince="{{ @$std->bdistrict->province->province_name_lo }}"
                                                        data-nationality="{{ $std->st_nationality }}"
                                                        data-region="{{ $std->st_region }}"
                                                        data-phone="{{ $std->st_phone }}"
                                                        data-pvillage="{{ $std->st_pvillage }}"
                                                        data-pdistrict="{{ @$std->pdistrict->district_name_lo }}"
                                                        data-pprovince="{{ @$std->pdistrict->province->province_name_lo }}"
                                                        data-gfname="{{ $std->gr_fname }}"
                                                        data-glname="{{ $std->gr_lname }}"
                                                        data-gphone="{{ $std->gr_phone }}"
                                                        data-ggender="{{ $std->gr_gender }}"
                                                        data-registerdate="{{ $std->st_registerdate }}"
                                                        data-status="{{ $std->st_status }}"
                                                        data-major="{{ @$std->major->ma_name }}"
                                                        data-dept="{{ @$std->major->department->dept_name }}"
                                                        data-degree="{{ @$std->degree->degree }} {{ @$std->degree->course->name }} ({{ @$std->degree->program }})"
                                                        data-last-update="{{ Carbon\Carbon::parse($std->create_at)->format('d/m/Y H:m:s') }}"
                                                        >
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            </td>
                                            @permission('student-edit')
                                            <td class="text-center">
                                                <a href="{{ action('StudentController@edit', [$std->st_id, Request::getQueryString()] ) }}"
                                                   class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            </td>
                                            @endpermission
                                            @permission('student-delete')
                                            <td class="text-center">
                                                {!! Form::open(array('url' => 'student/' . $std->st_id, 'method' => 'delete', 'class' => 'delete_form')) !!}
                                                <button type="submit" class="btn btn-danger delete-btn"><i
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

    @permission('student-create')
    <!-- Import content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                

            </div>
        </div>
    </section>
    @endpermission

    {{-- Modal Bootstrap Alert --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </span>
                    <center>
                        <h4 style="font-family: 'Phetsarath_OT'; font-size:x-large" class="modal-title"
                            id="exampleModalLabel"></h4>
                    </center>
                </div>

                <div class="modal-body" style="margin-left: 15px; margin-right: 15px;">
                    <div class="panel panel-primary" id="show-note" style="padding: 15px">
                        <table class="panel-body" style="font-family: 'Phetsarath_OT'; ">
                            <tr><th>ລະຫັດນັກສຶກສາ: </th><td class="id"></td></tr>
                            <tr><th>ຊື່ ແລະ ນາມສະກຸນ: </th><td class="fullname"></td></tr>
                            <tr><th>(ເປັນພາສາອັງກິດ): </th><td class="fullname_eng"></td></tr>
                            <tr><th>ເພດ: </th><td class="gender"></td></tr>
                            <tr><th>ວັນເດືອນປີເກດ: </th><td class="birthday"></td></tr>
                            <tr><th>ບ້ານ: </th><td class="bvillage"></td></tr>
                            <tr><th>ເມືອງ: </th><td class="bdistrict"></td></tr>
                            <tr><th>ແຂວງ: </th><td class="bprovince"></td></tr>
                            <tr><th>ສັນຊາດ: </th><td class="nationality"></td></tr>
                            <tr><th>ສາດສະໜາ: </th><td class="region"></td></tr>
                            <tr><th>ທີ່ຢູ່ປະຈຸບັນ: </th><td class="pvillage"></td></tr>
                            <tr><th>ເມືອງ: </th><td class="pdistrict"></td></tr>
                            <tr><th>ແຂວງ: </th><td class="pprovince"></td></tr>
                            <tr><th>ເບີໂທ: </th><td class="phone"></td></tr>
                            <tr><th>ຊື່ຜູ້ປົກຄອງ: </th><td class="gfname"></td></tr>
                            <tr><th>ນາມສະກຸນ: </th><td class="glname"></td></tr>
                            <tr><th>ເພດ: </th><td class="ggender"></td></tr>
                            <tr><th>ຕິດຕໍ່: </th><td class="gphone"></td></tr>
                            <tr><th>ພາກວິຊາ: </th><td class="department"></td></tr>
                            <tr><th>ສາຂາຮຽນ: </th><td class="major"></td></tr>
                            <tr><th>ລະບົບ: </th><td class="degree"></td></tr>
                            <tr><th>ເຂົ້າຮຽນສົກປີ: </th><td class="registerdate"></td></tr>
                            <tr><th>ສະຖານະພາບນັກສຶກສາ: </th><td class="status"></td></tr>
                        </table>
                    </div>
                    <h5 style="font-family: 'Phetsarath_OT'">ແກ້ໄຂຂໍ້ມຸນຫຼ້າສຸດ: <span class="update"></span></h5>
                </div>

                <div class="modal-footer">
                    <a href="#" id="linkId" target="_blank"
                       class="btn bg-purple"><span class="glyphicon glyphicon-print"></span> Print</a>
                    <button type="button" class="btn bg-orange" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> ປິດ
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection



@section('status_alert')

    @include('.alert')

@endsection

@push('scripts')

    <script type="text/javascript">
        $('.show-btn').on('click', function () {
            var id = $(this).data('id');
            var firstname = $(this).data('firstname');
            var lastname = $(this).data('lastname');
            var firstname_eng = $(this).data('firstname_eng');
            var lastname_eng = $(this).data('lastname_eng');
            var gender = $(this).data('gender');
            var birthday = $(this).data('birthday');
            var bvillage = $(this).data('bvillage');
            var bdistrict = $(this).data('bdistrict');
            var bprovince = $(this).data('bprovince');
            var nationality = $(this).data('nationality');
            var region = $(this).data('region');
            var phone = $(this).data('phone');
            var pvillage = $(this).data('pvillage');
            var pdistrict = $(this).data('pdistrict');
            var pprovince = $(this).data('pprovince');
            var gfname = $(this).data('gfname');
            var glname = $(this).data('glname');
            var gphone = $(this).data('gphone');
            var ggender = $(this).data('ggender');
            var registerdate = $(this).data('registerdate');
            var status = $(this).data('status');
            var major = $(this).data('major');
            var degree = $(this).data('degree');
            var dept = $(this).data('dept');
            var update = $(this).data('last-update');

            if (status == 2) {
                status = "ພັກຮຽນຊົ່ວຖາວອນ"
            } else if (status == 1) {
                status = "ພັກຮຽນຊົ່ວຄາວ"
            } else {
                status = "ຮຽນປົກກະຕິ"
            }

            $('h4.modal-title').text('ສະແດງຂໍ້ມູນນັກສຶກສາ: ' + ((gender=='ຊາຍ')?'ທ. ':'ນ. ') + firstname + ' ' + lastname)
            $('td.id').text(id)
            $('td.fullname').text(firstname + ' ' + lastname)
            $('td.fullname_eng').text(firstname_eng + ' ' + lastname_eng)
            $('td.gender').text(gender)
            $('td.birthday').text(birthday)
            $('td.bvillage').text(bvillage)
            $('td.bdistrict').text(bdistrict)
            $('td.bprovince').text(bprovince)
            $('td.nationality').text(nationality)
            $('td.region').text(region)
            $('td.phone').text(phone)
            $('td.pvillage').text(pvillage)
            $('td.pdistrict').text(pdistrict)
            $('td.pprovince').text(pprovince)
            $('td.gfname').text(gfname)
            $('td.glname').text(glname)
            $('td.gphone').text(gphone)
            $('td.ggender').text(ggender)
            $('td.registerdate').text(registerdate)
            $('td.department').text(dept)
            $('td.major').text(major)
            $('td.degree').text(degree)
            $('td.status').text(status)
            $('span.update').text(update)
            $("#linkId").attr("href", "student/student_print/" + id);
        });
    </script>
    <script src="{{ asset('js/custom.js?1') }}"></script>
@endpush

