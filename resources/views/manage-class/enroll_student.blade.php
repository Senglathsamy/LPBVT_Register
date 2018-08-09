{!! Form::open(['url'=> '/manage/class/enroll/'.$class->cr_id, 'method' => 'POST', 'id'=>'form1', 'class' => 'form-inline']) !!}
                        {!! Form::close() !!}
                        
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
                            <div class="col-xs-6">
                                <div class="table-responsive box box-solid box-default">
                                    <div class="box-header">
                                        <h3 class="box-title" style="font-family: 'Phetsarath_OT'">ລາຍຊື່ນັກສຶກສາທີ່ສາມາດກໍານົດໃສ່ຫ້ອງນີ້:</h3>
                                    </div>
                                    <div class="box-body">
                                        <table id="enrollable" class="table table-bordered table-striped table-hover">
                                            <thead>
                                            @if(count($st_enroll)>0)
                                            <tr>
                                                <th class="text-center" colspan="2" style="width: 40px">ລ/ດ</th>
                                                <th class="text-center" style="width: 120px">ລະຫັດນັກສຶກ</th>
                                                <th class="text-center">ຊື່ນັກສຶກສາ</th>
                                            </tr>
                                            @endif
                                            </thead>
                                            <tbody>
                                            @php($i=0)
                                            @foreach($st_enroll as $student)
                                            <tr>
                                                <td class="text-center" style="width: 30px"><input type="checkbox" name="rg_id[]" value="{{ $student->rg_id }}"></td>
                                                <td class="text-center" style="width: 30px">{{ ++$i }}.</td>
                                                <td class="text-center" style="width: 120px">{{ $student->st_id }}</td>
                                                <td class="text-center">{{ $student->full_name }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            @if( $st_enroll->count()>0) 
                                            <tr>
                                                <td colspan="9" style="text-align: left"> 
                                                    <a href="javascript:void(0)" class="checkedall"><i class="fa fa-check-square-o" aria-hidden="true"></i> ເລືອກທັງໝົດ</a>&nbsp;&nbsp;
                                                    <a href="javascript:void(0)"  class="uncheckall"><i class="fa fa-square-o" aria-hidden="true"></i> ບໍ່ເລືອກທັງໝົດ</a> <br>
                                                    <button type="submit" class="btn btn-success" id="add"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> ເພີ່ມເຂົ້າຫ້ອງ</button>
                                                </td>
                                            </tr>
                                            @endif
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

@push('scripts')
    <script type="text/javascript">
        
        $('.checkedall').on('click', function () {
            var parent = $(this).parents("table");
            parent.find('input[type="checkbox"]').iCheck('check');
        });

        $('.uncheckall').on('click', function () {
            var parent = $(this).parents("table");
            parent.find('input[type="checkbox"]').iCheck('uncheck');
        });

        $('button[type="submit"]').on('click', function(){

            var parent = $(this).parents("table");
            var child = parent.find('input[type="checkbox"]');
            if ( !$(child).is(':checked'))
                return false;

            var classno = $('#classno').val();
            var option = $(this).attr('id');
            var form = $('#form1');
            form.append("<input type='hidden' name='action' value='" + option + "''>");
            form.append(child.filter(":checked"));
            form.appendTo('body').submit().remove();
        });
    </script>
@endpush