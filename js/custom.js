
$("select[name='st_bprovince']").change( function(){
    var province_id = $(this).val();
    var bdistric = $("select[name='st_bdistrict']").empty();
    bdistric.append('<option value="">--ເມືອງເກີດ--</option>');
    if(province_id) {
        $.ajax({
            url: '/district/getby/'+province_id,
            method: 'GET',
            dataType:"json",
            success: function(data) {
                $.each(data, function(key, value){
                    bdistric.append('<option value="'+ key +'">' + value + '</option>');
                });
            }
        }); 
    } 
});

$("select[name='bprovince']").change( function(){
    var province_id = $(this).val();
    var bdistric = $("select[name='bdistrict']").empty();
    bdistric.append('<option value="">--ເມືອງເກີດ--</option>');
    if(province_id) {
        $.ajax({
            url: '/district/getby/'+province_id,
            method: 'GET',
            dataType:"json",
            success: function(data) {
                $.each(data, function(key, value){
                    bdistric.append('<option value="'+ key +'">' + value + '</option>');
                });
            }
        }); 
    } 
});

$("select[name='st_pprovince']").change( function(){
    var province_id = $(this).val();
    var pdistric = $("select[name='st_pdistrict']").empty();
    pdistric.append('<option value="">--ເມືອງຢູ່ປະຈຸບັນ--</option>');
    if(province_id) {
        $.ajax({
            url: '/district/getby/'+province_id,
            method: 'GET',
            dataType:"json",
            success: function(data) {
                $.each(data, function(key, value){
                    pdistric.append('<option value="'+ key +'">' + value + '</option>');
                });
            }
        }); 
    } 
});

$("select[name='department']").change( function(){
    var dept_id = $(this).val(); 
    var major = $("select[name='ma_id']").empty();
    major.append('<option value="">--ສາຂາວິຊາ--</option>');
    if(dept_id) { 
        $.ajax({
            url: '/major/getby/'+dept_id,
            method: 'GET',
            dataType:"json",
            success: function(data) {

                $.each(data, function(key, value){
                    major.append('<option value="'+ key +'">' + value + '</option>');
                });
            }
        }); 
    } 
});

$("select[name='ma_id']").change( function(){
    var ma_id= $(this).val(); 
    var de_id = $("select[name='de_id']").empty();
    if (de_id) {
        de_id.append('<option value="">--ລະບົບຮຽນ--</option>');
        if(ma_id) { 
            $.ajax({
                url: '/register/system/'+ma_id,
                method: 'GET',
                dataType:"json",
                success: function(data) { 
                    $.each(data, function(key, value){
                        de_id.append('<option value="'+ key +'">' + value + '</option>');
                    });
                }
            }); 
        }
    } 
});

$("select[name='de_id']").change( function(){
    var de_id= $(this).val(); 
    var year = $("select[name='studyyear']").empty();
    year.append('<option value="">--ເຂົ້າປີ--</option>');
    if(de_id) { 
        $.ajax({
            url: '/register/year/'+de_id,
            method: 'GET',
            dataType:"json",
            success: function(data) { 
                $.each(data, function(key, value){
                    year.append('<option value="'+ key +'">' + value + '</option>');
                });
            }
        }); 
    } 
});


