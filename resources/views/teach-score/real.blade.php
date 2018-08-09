@extends('layouts.app')

@section('title', 'Class Enrollment')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຂໍ້ມູນຄະແນນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ຄະແນນນັກຮຽນຫ້ອງ {{ $class->cr_name }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/manage/class/?{{ Request::getQueryString() }}"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div style="float: left; margin-left: 30px">
                            <h3 class="box-title" style="font-family: 'Phetsarath_OT'; font-weight: bold;">ຫ້ອງ: {{ $class->cr_name }} , <span style="font-weight: normal; font-size: 14pt;">ປີ {{ $class->cr_year }}, ສົກປີ {{ $class->cr_ac_year }}, {{ $class->full_degree }}</span></h3>
                        </div>
                        <!--include content-->
                        <div class="row row-eq-height">
                            <div class="col-xs-6">
                                <div class="table-responsive box box-solid box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title" style="font-family: 'Phetsarath_OT'">ລາຍຊື່ນັກສຶກສາໃນຫ້ອງ:</h3>
                                    </div>
                                    <div class="box-body">
                                        <table id="enrolledable" class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center" colspan="2" >ລ/ດ</th>
                                                <th class="text-center">ລະຫັດນັກສຶກ</th>
                                                <th class="text-center">ຊື່ນັກສຶກສາ</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($st_enrolled as $student)
                                            <tr>
                                                <td class="text-center" style="width: 30px"><input type="checkbox" name="rg_id[]" value="{{ $student->rg_id }}"></td>
                                                <td class="text-center" style="width: 30px">{{ ++$i }}.</td>
                                                <td class="text-center">{{ $student->st_id }}</td>
                                                <td class="text-center">{{ $student->full_name }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            @if( $st_enrolled->count()>0) 
                                            <tr>
                                                <td colspan="9" style="text-align: left"> 
                                                    <a href="javascript:void(0)" class="checkedall"><i class="fa fa-check-square-o" aria-hidden="true"></i> ເລືອກທັງໝົດ</a>&nbsp;&nbsp;
                                                    <a href="javascript:void(0)"  class="uncheckall"><i class="fa fa-square-o" aria-hidden="true"></i> ບໍ່ເລືອກທັງໝົດ</a> <br>
                                                    <button type="submit" class="btn btn-danger" id="del" style="float: right"> ເອົາອອກຫ້ອງ <i class="fa fa-caret-square-o-right" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            @endif
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <!--include content-->
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
@push('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush