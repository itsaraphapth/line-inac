$(function(){
    var compcode = $('#compcode');
    var memberID = $('#member');
    // on change province
    compcode.on('change', function(){
        var compID = $(this).val();
 
        memberID.html('<option value="">เลือกชื่อ</option>');
 
        $.get('get_member.php?compcode=' + compID, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                memberID.append(
                    $('<option></option>').val(item.m_code).html(item.m_name)
                );
            });
        });
    });



    console.log('ddddd');
});