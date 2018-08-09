
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive box box-solid box-default">
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr style="background-color: #cccccc">
                                                <th class="text-center" style="width: 60px">ລ/ດ</th>
                                                <th class="text-center" style="width: 80px">ລະຫັດວິຊາ</th>
                                                <th class="text-center" style="width: 300px">ຊື່ວິຊາ</th>
                                                <th class="text-center" style="width: 80px">ໜ່ວຍກິດ</th>
                                                <th class="text-center">ອາຈານສອນ</th>
                                                @permission('manage-classroom')
                                                <th class="text-center" style="width: 80px">ແກ້ໄຂ</th>
                                                @endpermission
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="6" style="font-family: 'Phetsarath_OT'; font-weight: bold; background-color: #d2d6de">
                                                    ວິຊາຮຽນ ພາກຮຽນ 1:
                                                </td>
                                            </tr>
                                            @foreach($t1_enroll as $subj)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}.</td>
                                                <td class="text-center">{{ $subj->sub_id }}</td>
                                                <td>{{ $subj->sub_name }}</td>
                                                <td class="text-center">{{ $subj->sub_credit }}</td>
                                                <td>
                                                    @if($subj->te_firstname)
                                                    <span class="badge bg-teal-active" style="padding-top: 5px; padding-bottom: 5px; padding-left: 8px; padding-right: 8px; margin-top: 5px; margin-bottom: 5px; font-size: 13px;">
                                                        {{ $subj->te_init }} {{ @StaticArray::$short_degree[$subj->te_degree]?StaticArray::$short_degree[$subj->te_degree]:'' }} {{ $subj->te_firstname }} {{ $subj->te_lastname }}
                                                    </span>
                                                    @endif
                                                </td>
                                                @permission('manage-classroom')
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success show-btn"
                                                    data-toggle="modal" data-target="#myModal"
                                                    data-subject="{{ $subj->sub_name }}"
                                                    data-subb_id="{{ $subj->subb_id }}"
                                                    data-te_id="{{ $subj->te_id }}"
                                                    ><i class="fa fa-edit"></i></button>
                                                </td>
                                                @endpermission
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="6" style="font-family: 'Phetsarath_OT'; font-weight: bold; background-color: #d2d6de">
                                                    ວິຊາຮຽນ ພາກຮຽນ 2:
                                                </td>
                                            </tr>
                                            @php($i=0)
                                            @foreach($t2_enroll as $subj)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}.</td>
                                                <td class="text-center">{{ $subj->sub_id }}</td>
                                                <td>{{ $subj->sub_name }}</td>
                                                <td class="text-center">{{ $subj->sub_credit }}</td>
                                                <td>
                                                    @if($subj->te_firstname)
                                                    <span class="badge bg-teal-active" style="padding-top: 5px; padding-bottom: 5px; padding-left: 8px; padding-right: 8px; margin-top: 5px; margin-bottom: 5px; font-size: 13px;">
                                                        {{ $subj->te_init }} {{ @StaticArray::$short_degree[$subj->te_degree]?StaticArray::$short_degree[$subj->te_degree]:'' }} {{ $subj->te_firstname }} {{ $subj->te_lastname }}
                                                    </span>
                                                    @endif
                                                </td>
                                                @permission('manage-classroom')
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success show-btn"
                                                    data-toggle="modal" data-target="#myModal"
                                                    data-subject="{{ $subj->sub_name }}"
                                                    data-subb_id="{{ $subj->subb_id }}"
                                                    data-te_id="{{ $subj->te_id }}"
                                                    ><i class="fa fa-edit"></i></button>
                                                </td>
                                                @endpermission
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                            id="exampleModalLabel">ບັນທຶກການສໍາລະຄ່າລົງທະບຽນ</h4>
                    </center>
                </div>
                {!! Form::open(['url'=> 'manage/class/teach', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    <div class="modal-body" style="margin-left: 15px; margin-right: 15px;">
                        <div class="panel panel-primary" id="show-note" style="padding: 15px;">
                            <center>
                                <input type="hidden" name="class_id" value="{{ $class->cr_id }}">
                                <input type="hidden" name="subb_id" value="">
                                <table class="panel-body" style="font-family: 'Phetsarath_OT'; ">
                                    <tr><th>ຊື່ວິຊາ: </th><td class="sub_name" style="padding: 3px;"><input name="sub_name" readonly></td></tr>
                                    <tr><th>ອາຈານສອນ: </th><td class="teacher" style="padding: 3px;"><select name="teacher" style="width: 184px"></select></td></tr>  
                                    <tr><th></th><td class="notice" style="padding: 5px;"></td></tr>         
                                </table>
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ຍົກເລີກ</button>
                        <button type="submit" class="btn bg-primary">
                            <i class="fa fa-floppy-o"></i> ບັນທືກ
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@push('scripts')
<script type="text/javascript">

    $('.show-btn').on('click', function () {
        var sub_name = $(this).data('subject');
        var subb_id = $(this).data('subb_id');
        var te_id = $(this).data('te_id');

        $("input[name='sub_name']").val(sub_name);
        $("input[name='subb_id']").val(subb_id);

        if(subb_id) { 
            $.ajax({
                url: '/manage/class/sub/'+subb_id,
                method: 'GET',
                dataType: "json",
                success: function(data) { 
                    var teacher = $("select[name='teacher']").empty();
                    if(data=='') {
                        teacher.append('<option value="">--ບໍ່ມີອາຈານວິຊານີ້--</option>');
                        $("td.notice").html('<p><a href="/teacher_subject/' + subb_id + '/edit"> ເພີ່ນຂໍ້ມູນອາຈານສອນ-ວິຊາ</a></p>');
                    } else {
                        teacher.append('<option value="">--ເລືອກອາຈານປະຈໍາວິຊາ--</option>');
                    }

                    $.each(data, function(key, value){
                        var selected = (te_id==key)?'selected':''; 
                        teacher.append('<option value="'+ key +'" ' + selected + '>' + value + '</option>');
                    });
                }
            }); 
        }
    });
</script>
@endpush