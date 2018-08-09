@extends('layouts.app')

@section('title', 'View Teacher')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ຂໍ້ມູນອາຈານສອນ</B>
        </h1>
        <ol class="breadcrumb" class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="#">ຂໍ້ມູນອາຈານສອນ</a></li>
            <li class="active">ສະແດງຂໍ້ມູນອາຈານສອນ</li>
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
                        @permission('teacher-create')
                        <a href="{{ url('/teacher/create') }}" class="btn bg-blue btn-lg"
                           style="font-weight: bold;"><i class="fa fa-plus"></i> <b>ເພີ່ມຂໍ້ມູນອາຈານ</b></a>
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
                                    <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                    <th class="text-center">ເພດ</th>
                                    <th class="text-center">ເບີໂທ</th>
                                    <th class="text-center">ສັງກັດຢູ່ພາກ</th>
                                    <th class="text-center">ສະຖານະ</th>
                                    <th class="text-center">ສະແດງ</th>
                                    @permission('teacher-create')
                                    <th class="text-center">ແກ້ໄຂ</th>
                                    @endpermission
                                    @permission('teacher-create')
                                    <th class="text-center">ລົບ</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teacher as $teach)
                                    <tr class="{{ $teach->te_status == 1?'':'warning' }}">
                                        <td class="text-center">{{ ++$i }}.</td>
                                        <td>{{ $teach->te_init }} {{ @StaticArray::$short_degree[$teach->te_degree]?StaticArray::$short_degree[$teach->te_degree]:'' }} {{ $teach->te_firstname }} {{ $teach->te_lastname }}</td>
                                        <td class="text-center">{{ $teach->te_gender }}</td>
                                        <td>{{ $teach->te_phone }}</td>
                                        <td>{{ $teach->department->dept_name }}</td>
                                        <td>{{ $teach->status->status }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn bg-teal show-btn"
                                                    data-toggle="modal" data-target="#myModal"
                                                    data-fullname="{{ $teach->te_init }} {{ @StaticArray::$short_degree[$teach->te_degree]?StaticArray::$short_degree[$teach->te_degree]:'' }} {{ $teach->te_firstname }} {{ $teach->te_lastname }}"
                                                    data-gender="{{ $teach->te_gender }}"
                                                    data-bdate="{{ $teach->te_bdate }}"
                                                    data-bvillage="{{ $teach->te_bvillage }}"
                                                    data-bdistrict="{{ $teach->district->district_name_lo }}"
                                                    data-bprovince="{{ $teach->district->province->province_name_lo }}"
                                                    data-nationality="{{ $teach->te_nationality }}"
                                                    data-region="{{ $teach->te_region }}"
                                                    data-phone="{{ $teach->te_phone }}"
                                                    data-education="{{ $teach->te_education }}"
                                                    data-major="{{ $teach->te_major }}"
                                                    data-degree="{{ $teach->te_degree }}"
                                                    data-startwork="{{ $teach->startwork }}"
                                                    data-position="{{ $teach->te_position }}"
                                                    data-party_position="{{ $teach->te_party_position }}"
                                                    data-date_to_party1="{{ $teach->date_to_party1 }}"
                                                    data-date_to_party2="{{ $teach->date_to_party2 }}"
                                                    data-politic_level="{{ $teach->politic_level }}"
                                                    data-dept="{{ $teach->department->dept_name }}"
                                                    data-photo="{{ $teach->te_photo }}"
                                                    data-status="{{ $teach->status->status }}"
                                                    data-last-update="{{ Carbon\Carbon::parse($teach->create_at)->format('d/m/Y H:m:s') }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                        @permission('teacher-edit')
                                        <td class="text-center">
                                            <a href="{{ action('TeacherController@edit', [$teach->id]) }}"
                                               class="btn bg-green"><i class="fa fa-edit"></i></a>
                                        </td>
                                        @endpermission
                                        @permission('teacher-delete')
                                        <td class="text-center">
                                            {!! Form::open(array('url' => 'teacher/' . $teach->id, 'method' => 'delete', 'class' => 'delete_form')) !!}
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


    {{-- Modal Bootstrap Alert --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </span>
                    <center>
                        <h4 style="font-family: 'Phetsarath_OT'; font-weight: bold;" class="modal-title"
                            id="exampleModalLabel"></h4>
                    </center>
                </div>

                <div class="modal-body" style="margin-left: 15px; margin-right: 15px;">
                    <div class="panel panel-primary" id="show-note" style="padding:15px;">
                        <table class="panel-body" style="font-family: 'Phetsarath_OT'; ">
                            <tr><th>ຊື່ ແລະ ນາມສະກຸນ:</th><td class="fullname"></td></tr>
                            <tr><th>ເພດ:</th><td class="gender"></td></tr>
                            <tr><th>ວັນເດືອນປີເກີດ:</th><td class="bdate"></td></tr>
                            <tr><th>ບ້ານເກີດ:</th><td class="bvillage"></td></tr>
                            <tr><th>ເມືອງເກີດ:</th><td class="bdistrict"></td></tr>
                            <tr><th>ແຂວງເກີດ:</th><td class="bprovince"></td></tr>
                            <tr><th>ສັນຊາດ:</th><td class="nationality"></td></tr>
                            <tr><th>ສາດສະໜາ:</th><td class="region"></td></tr>
                            <tr><th>ເບີໂທ:</th><td class="phone"></td></tr>
                            <tr><th>ລະດັບວັນທະນະທໍາ:</th><td class="education"></td></tr>
                            <tr><th>ລະດັບການສຶກສາ:</th><td class="degree"></td></tr>
                            <tr><th>ຈົບສາຂາ:</th><td class="major"></td></tr>
                            <tr><th>ວັນເດືອນປີເຂົ້າສັງກັດລັດ:</th><td class="startwork"></td></tr>
                            <tr><th>ຕໍາແໜ່ງລັດ:</th><td class="position"></td></tr>
                            <tr><th>ຕໍາແໜ່ງພັກ:</th><td class="party_position"></td></tr>
                            <tr><th>ວັນເດືອນປີເຂົ້າພັກສົມສໍາຮອງ:</th><td class="date_to_party1"></td></tr>
                            <tr><th>ວັນເດືອນປີເຂົ້າພັກບູນ:</th><td class="date_to_party2"></td></tr>
                            <tr><th>ລັບດັບທິດສະດີ:</th><td class="politic_level"></td></tr>
                            <tr><th>ສັງກັດພາກວິຊາ:</th><td class="dept"></td></tr>
                            <tr><th>ສະຖານະພາບ:</th><td class="status"></td></tr>
                        </table>
                    </div>
                    <h5 class="last-update" style="font-family: 'Phetsarath_OT'; "></h5>
                </div>

                <div class="modal-footer">
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
        $('button.show-btn').on('click', function () {
            var fullname = $(this).data('fullname');
            var gender = $(this).data('gender');
            var bdate = $(this).data('bdate');
            var bvillage = $(this).data('bvillage');
            var bdistrict = $(this).data('bdistrict');
            var bprovince = $(this).data('bprovince');
            var nationality = $(this).data('nationality');
            var region = $(this).data('region');
            var phone = $(this).data('phone');
            var education = $(this).data('education');
            var major = $(this).data('major');
            var degree = $(this).data('degree');
            var startwork = $(this).data('startwork');
            var position = $(this).data('position');
            var party_position = $(this).data('party_position');
            var date_to_party1 = $(this).data('date_to_party1');
            var date_to_party2 = $(this).data('date_to_party2');
            var politic_level = $(this).data('politic_level');
            var dept = $(this).data('dept');
            var status = $(this).data('status');
            var update = $(this).data('last-update');

            $('h4.modal-title').text('ສະແດງຂໍ້ມູນອາຈານ: ' + fullname)
            $('td.fullname').text(fullname)
            $('td.gender').text(gender)
            $('td.bdate').text(bdate)
            $('td.bvillage').text(bvillage)
            $('td.bdistrict').text(bdistrict);
            $('td.bprovince').text(bprovince);
            $('td.nationality').text(nationality)
            $('td.region').text(region)
            $('td.phone').text(phone)
            $('td.education').text(education)
            $('td.major').text(major)
            $('td.degree').text(degree)
            $('td.startwork').text(startwork)
            $('td.position').text(position);
            $('td.party_position').text(party_position);
            $('td.date_to_party1').text(date_to_party1);
            $('td.date_to_party2').text(date_to_party2);
            $('td.politic_level').text(politic_level);
            $('td.dept').text(dept)
            $('td.status').text(status)
            $('h5.last-update').text('ປ່ຽນແປງຫຼ້າສຸດ: ' + update)
        });
    </script>

@endpush

