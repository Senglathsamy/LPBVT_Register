@extends('layouts.app')

@section('title', 'Class Enrollment')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Phetsarath_OT'; font-weight: bold;">
            <B>ຈັດຫ້ອງຮຽນ</B>
        </h1>
        <ol class="breadcrumb" style="font-weight: bold; font-size: 100%;">
            <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> ໜ້າຫຼັກ</a></li>
            <li class="active">ຂໍ້ມູນຫ້ອງຮຽນ {{ $class->cr_name }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <br>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    @php($uri = preg_replace('/[\&]tab\=[0-9]?/', '', Request::getQueryString()))
                    <a class="btn bg-orange btn-lg" style="font-family: 'Phetsarath_OT'; font-weight: 600;"
                       href="/manage/class/?{{ Request::getQueryString() }}"><i class="fa fa-reply"></i> ກັບຄືນ</a>
                    <a href="/manage/class/{{ $class->cr_id }}?{{ $uri }}" class="btn btn-lg {{@!$_GET['tab']?'bg-aqua':'bg-blue'}}"
                           style="font-weight: bold;"><i class="fa fa-graduation-cap"></i> ນັກຮຽນ</a>
                    <a href="/manage/class/{{ $class->cr_id }}?tab=1&{{ $uri }}" class="btn btn-lg {{@$_GET['tab']==1?'bg-aqua':'bg-blue'}}"
                           style="font-weight: bold;"><i class="fa fa-user-circle-o"></i> ອາຈານສອນ</a>
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
                        @if (@$_GET['tab']==1)
                            @include("manage-class/enroll_teacher")
                        @else
                            @include("manage-class/enroll_student")
                        @endif
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