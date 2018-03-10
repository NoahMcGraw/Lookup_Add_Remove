$('#lookupusername').keyup(function(){
    var name = $('#lookupusername').val();
    $.post('/lookup.php', { name: name}, function(data){
        $("#result").html(data);
    });
});