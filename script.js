$(function(){
    var compcode = $('#compcode');
    var memberID = $('#member');
    var syncs = $('#syncs');
    // on change province
    compcode.on('change', function(){
        var compID = $(this).val();
        console.log(compID);
        memberID.html('<option value="">เลือกชื่อ</option>');
 
        $.get('get_member.php?comp_code=' + compID, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                memberID.append(
                    $('<option></option>').val(item.m_code).html(item.m_name)
                );
            });
        });
    });
   
    syncs.on('click', function(){
        var memberID =  $('#member').val();
        var userID =  $('#userID').val();
        console.log(compID);
 
        $.get('sync.php?memberID=' + memberID + '&userID' + userID, function(data){
            var result = JSON.parse(data);
            console.log(data);
            $.each(result, function(index, item){
                memberID.append(
                    $('<option></option>').val(item.m_code).html(item.m_name)
                );
            });
        });
    });



    console.log('ddddd');
});