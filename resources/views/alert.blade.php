@if(session()->has('status'))

    <script type="text/javascript">
        swal({
            title: "<?php echo session()->get('status'); ?>",
            text: "Result",
//                timer: 2000,
            type: 'success',
            confirmButtonColor: "#14DDDD",
            confirmButtonText : "OK",
            closeOnConfirm: false,
            showConfirmButton: true
        });
    </script>

@elseif(session()->has('statusW'))

    <script type="text/javascript">
        swal({
            title: "<?php echo session()->get('statusW'); ?>",
            text: "Result",
//                timer: 2000,
            type: 'warning',
            confirmButtonColor: "#14DDDD",
            confirmButtonText : "OK",
            closeOnConfirm: false,
            showConfirmButton: true
        });
    </script>

@elseif(session()->has('statusD'))

    <script type="text/javascript">
        swal({
            title: "<?php echo session()->get('statusD'); ?>",
            text: "Result",
//                timer: 2000,
            type: 'error',
            confirmButtonColor: "#14DDDD",
            confirmButtonText : "OK",
            closeOnConfirm: false,
            showConfirmButton: true
        });
    </script>

@elseif(session()->has('statusS'))

    <script type="text/javascript">
        swal({
            title: "<?php echo session()->get('statusS'); ?>",
            text: "Result",
            timer: 1500,
            type: 'success',
            confirmButtonColor: "#14DDDD",
            confirmButtonText : "OK",
            closeOnConfirm: false,
            showConfirmButton: true
        });
    </script>

@elseif(session()->has('statusI'))

    <script type="text/javascript">
        swal({
            title: "<?php echo session()->get('statusI'); ?>",
            text: "Result",
//            timer: 1500,
            type: 'info',
            confirmButtonColor: "#14DDDD",
            confirmButtonText : "OK",
            closeOnConfirm: false,
            showConfirmButton: true
        });
    </script>

@endif

{{-- Alert Before Delete DATAA --}}
<script type="text/javascript">
    $('button.delete-btn').on('click', function(e){
        e.preventDefault();
        var self = $(this);
        swal({
                title             : "ເຈົ້າຕ້ອງການລົບຂໍ້ມູນນີ້ແທ້ບໍ່ ?",
                text              : "Really ",
                type              : "warning",
                showCancelButton  : true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText : "ລົບຂໍ້ມູນ",
                cancelButtonText  : "ຍົກເລີກ",
                closeOnConfirm    : false,
                closeOnCancel     : false
            },
            function(isConfirm){
                if(isConfirm){
                    swal("ກຳລັງລົບຂໍ້ມູນ...!\n(ກວດສອບຂໍ້ມູນກ່ອນລົບ)","Result", "info");
                    setTimeout(function() {
                        self.parents(".delete_form").submit();
                    }, 2000); //2 second delay (2000 milliseconds = 2 seconds)
                }
                else{
                    swal("ຍົກເລີກການລົບຂໍ້ມູນແລ້ວ !","Result", "error");
                }
            });
    });
</script>