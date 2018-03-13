$(document).ready(function(){
//Route to lookup and removeInd
    $('#arusername').keyup(function(){
        var name = $('#arusername').val();
        $.post('lookup.php', { name: name}, function(data){
            $('#result').html(data);
            $('.removeIndBtn').click(function(){
                var removeIndValue = $(this).parent().find("input[name = 'removeIndValue']").val();
                var removeIndName = $(this).parent().find("input[name = 'removeIndName']").val();
                $.post('removeInd.php', {removeIndName: removeIndName, removeIndValue: removeIndValue},
                function(){
                    var name = $('#arusername').val();
                    //$('#result').html(data);
                    $.post('lookup.php', {name: name}, function(data){
                        $('#result').html(data);
                    });
                });
            });
            
        });
    });
//Route to add
    $('#add').click(function(){
        var arusername = $('#arusername').val();
        var age = $('#age').val();
        var email = $('#email').val();
        $.post('add.php', {arusername: arusername, age: age, email: email}, function(data){
            if(typeof data !== "undefined" && data.length){
            alert(data);
            }
            var name = $('#arusername').val();
            $.post('lookup.php', {name: name}, function(data){
                $('#result').html(data);
            });
        });
    });
});