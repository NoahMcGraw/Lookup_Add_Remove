$(document).ready(function(){
//Route to lookup
    $('.lookupusername').keyup(function(){
        var name = $('.lookupusername').val();
        $.post('lookup.php', { name: name}, function(data){
            $('#result').html(data);
        });
    });
//Route to removeInd
    $(document).on('click', '#removeIndBtn', function(){
        //var removeIndValue = $('#removeIndValue').val();
        //var removeIndName = $('#removeIndName').val();
        $.post('removeInd.php', function(data){
            $('#result').html(data);
        });
    });
//Route to add
    $('#add').click(function(){
        var arusername = $('#arusername').val();
        var age = $('#age').val();
        var email = $('#email').val();
        $.post('add.php', {arusername: arusername, age: age, email: email}, function(data){
            $('#result').html(data);
        });
    });
});