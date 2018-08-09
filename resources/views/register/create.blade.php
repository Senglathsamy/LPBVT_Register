@extends('layouts.app')
@section('title', 'Confirm Student Registration')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold">
            <B>ລົງທະບຽນປະຈໍາປີ</B>
        </h1>
        <ol class="breadcrumb" style="font-size: 100%; font-weight: bold">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li><a href="{{ url('#') }}">ລົງທະບຽນປະຈໍາປີ</a></li>
            <li class="active">ຢືນຢັນການລົງທະບຽນປະຈໍາປີ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 pull-left">
                <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                           href="{{ URL::previous() }}"><i class="fa fa-reply"></i> ກັບຄືນ </a>
            </div>
        </div>

        <div class="box box-info" style="min-height: 400px !important">
            <div class="box-header">
                <h3 class="box-title" style="font-family: 'Phetsarath_OT'; font-weight: bold;">
                    {{ $department }}, {{ $major }}: ປີ {{$year}} {{ $system }}, ສົກຮຽນປີ: {{ $ac_year }}
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open(array('url' => 'register/array', 'method' => 'POST', 'class' => 'register_form')) !!}
                    {!! Form::hidden('year', $year) !!}
                    {!! Form::hidden('ac_year', $ac_year) !!}
                    {!! Form::hidden('dept_id', $dept_id) !!}
                    {!! Form::hidden('ma_id', $ma_id) !!}
                    {!! Form::hidden('de_id', $de_id) !!}
                    <div class="table-responsive">
                        <table id="registertable" class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 30px">ລ/ດ</th>
                                <th class="text-center" style="width: 100px">ລະຫັດນັກສຶກສາ</th>
                                <th class="text-center">ຊື່ ແລະ ນາມສະກຸນ</th>
                                <th class="text-center">ເລກທີໃບບິນ</th>
                                <th class="text-center">ວັນທີຈ່າຍ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student as $std)
                            <tr>
                                <td class="text-center">{{ ++$i }}.</td>
                                <td class="text-center">
                                    {!! Form::hidden('st_id[]', $std->st_id) !!}
                                    <span class="-badge -bg-blue">{{ $std->st_id}}</span></td>
                                <td> {{ $std->st_gender=="ຊາຍ"?"ທ.":"ນ." }} {{ $std->st_fname }} {{ $std->st_lname }}</</td>
                                <td class="text-center"><div class="col-md-8"><input name="reciept_no[{{ $std->st_id }}]" class="form-control" placeholder="ເລກທີໃບບິນ"></div></td>
                                <td class="text-center"><div class="col-md-8"><input name="paid_date[{{ $std->st_id }}]" class="form-control" placeholder="ວັນທີຈ່າຍ"></div></td>
                            </tr>
                            @endforeach
                            </tbody> 
                            <tfoot>
                            <tr>
                                <td colspan="7" style="text-align: right"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> ຢືນຢັນການລົງທະບຽນ</button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection

@section('status_alert')

    @include('.alert')

@endsection

@push('scripts')
@endpush