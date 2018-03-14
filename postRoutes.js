$(document).ready(function(){
    function lookupUser(){
        var name = $('#arusername').val();
        $.post('lookup.php', { name: name}, function(data){
            $('#result').html(data);
            $('.removeIndBtn').click(function(){
                var removeIndValue = $(this).parent().find("input[name = 'indValue']").val();
                var removeIndName = $(this).parent().find("input[name = 'indName']").val();
                $.post('removeInd.php', {removeIndName: removeIndName, removeIndValue: removeIndValue},
                function(){
                    lookupUser();
                });
            });
            $('.updateBtn').click(function(){
                var updateValue = $(this).parent().find("input[name = 'indValue']").val();
                var updateName = $(this).parent().find("input[name = 'indName']").val();
                var updateAge = $(this).parent().find("input[name = 'indAge']").val();
                var updateEmail = $(this).parent().find("input[name = 'indEmail']").val();
                $.post('updateForm.php', {updateValue: updateValue, updateName: updateName, updateAge: updateAge, updateEmail: updateEmail},
                function(updateData){
                    $('#result').html(updateData);
                    $('.updateSubmitBtn').click(function(){
                        var updateSubmitValue = $(this).parent().find("input[name = 'updateValue']").val();
                        var updateSubmitName = $(this).parent().find("input[name = 'updateName']").val();
                        var updateSubmitAge = $(this).parent().find("input[name = 'updateAge']").val();
                        var updateSubmitEmail = $(this).parent().find("input[name = 'updateEmail']").val();
                        $.post('updateSubmit.php', {updateSubmitValue: updateSubmitValue, updateSubmitName: updateSubmitName,
                        updateSubmitAge: updateSubmitAge, updateSubmitEmail: updateSubmitEmail}, function(){
                            lookupUser();
                        });
                    })
                })
            });
        });
    }
//Route to lookup and removeInd
    $('#arusername').keyup(function(){
        var name = $('#arusername').val();
        $.post('lookup.php', { name: name}, function(data){
            $('#result').html(data);
            $('.removeIndBtn').click(function(){
                var removeIndValue = $(this).parent().find("input[name = 'indValue']").val();
                var removeIndName = $(this).parent().find("input[name = 'indName']").val();
                $.post('removeInd.php', {removeIndName: removeIndName, removeIndValue: removeIndValue},
                function(){
                    lookupUser();
                });
            });
            $('.updateBtn').click(function(){
                var updateValue = $(this).parent().find("input[name = 'indValue']").val();
                var updateName = $(this).parent().find("input[name = 'indName']").val();
                var updateAge = $(this).parent().find("input[name = 'indAge']").val();
                var updateEmail = $(this).parent().find("input[name = 'indEmail']").val();
                $.post('updateForm.php', {updateValue: updateValue, updateName: updateName, updateAge: updateAge, updateEmail: updateEmail},
                function(updateData){
                    $('#result').html(updateData);
                    $('.updateSubmitBtn').click(function(){
                        var updateSubmitValue = $(this).parent().find("input[name = 'updateValue']").val();
                        var updateSubmitName = $(this).parent().find("input[name = 'updateName']").val();
                        var updateSubmitAge = $(this).parent().find("input[name = 'updateAge']").val();
                        var updateSubmitEmail = $(this).parent().find("input[name = 'updateEmail']").val();
                        $.post('updateSubmit.php', {updateSubmitValue: updateSubmitValue, updateSubmitName: updateSubmitName,
                        updateSubmitAge: updateSubmitAge, updateSubmitEmail: updateSubmitEmail}, function(){
                            lookupUser();
                        });
                    })
                })
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
            lookupUser();
        });
    });
});