$(document).ready(function(){
    function lookupUser(){
        var name = $('#arusername').val();
        $.post('lookup.php', { name: name}, function(data){
            var userResult = [];
            try {
                userResult = JSON.parse(data);
                console.log(userResult);
            }
            catch(error){
                console.error(data);
                console.error(error);
            }
            $('#result').html('');
            for(var i = 0; i < userResult.length; i++){
                var resultHtmlName = "<br/><div class='wholeResult'><div class='lookupResult'>Name: " + userResult[i].name + "<br>";
                resultHtmlName += "Age: " + userResult[i].age + "<br>";
                resultHtmlName += "Email: " + userResult[i].email + "</div><br>";
                resultHtmlName += "<div class='removeBtnDiv'>";
                resultHtmlName += "<input type='submit' class='removeIndBtn' name='removeIndBtn' value='Remove User' />";
                resultHtmlName += "<input type='submit' class='updateBtn' name='updateBtn' value='Update Info' />";
                resultHtmlName += "<span class='label'><h3>Update Info for: " + userResult[i].name + "</h3></span>";
                resultHtmlName += "<input type='hidden' class='indValue' name='indValue' value='" + userResult[i].id + "' />";
                resultHtmlName += "<span class='label'>Name: </span><input type='hidden' class='indName' name='indName' value='" + userResult[i].name + "' /><br>";
                resultHtmlName += "<span class='label'>Age: </span><input type='hidden' class='indAge' name='indAge' value='" + userResult[i].age + "' /><br>";
                resultHtmlName += "<span class='label'>Email: </span><input type='hidden' class='indEmail' name='indEmail' value='" + userResult[i].email + "' /><br>";
                resultHtmlName += "<input type='hidden' class='updateSubmitBtn' name='updateSubmitBtn' value='Submit' />";
                resultHtmlName += "<br/>";
                resultHtmlName += "</div></div>";
                $('#result').append(resultHtmlName);
                $('.label').hide();
            
                $('.removeIndBtn').click(function(){
                    var removeIndValue = $(this).parent().find("input[name = 'indValue']").val();
                    var removeIndName = $(this).parent().find("input[name = 'indName']").val();
                    $.post('removeInd.php', {removeIndName: removeIndName, removeIndValue: removeIndValue},
                    function(){
                        lookupUser();
                    });
                });
                $('.updateBtn').click(function(){
                    $(this).parent().parent().find("div[class = 'lookupResult']").hide();
                    $(this).parent().find("input[name = 'indName']").prop('type', 'text');
                    $(this).parent().find("input[name = 'indAge']").prop('type', 'number');
                    $(this).parent().find("input[name = 'indEmail']").prop('type', 'text');
                    $(this).parent().find("input[name = 'removeIndBtn']").prop('type', 'hidden');
                    $(this).parent().find("input[name = 'updateBtn']").prop('type', 'hidden');
                    $(this).parent().find("input[name = 'updateSubmitBtn']").prop('type', 'submit');
                    $(this).parent().find("span[class = 'label']").show();
                    // var updateValue = $(this).parent().find("input[name = 'indValue']").val();
                    // var updateName = $(this).parent().find("input[name = 'indName']").val();
                    // var updateAge = $(this).parent().find("input[name = 'indAge']").val();
                    // var updateEmail = $(this).parent().find("input[name = 'indEmail']").val();
                    // $.post('updateForm.php', {updateValue: updateValue, updateName: updateName, updateAge: updateAge, updateEmail: updateEmail},
                    // function(updateData){
                    //     $('#result').html(updateData);
                        $('.updateSubmitBtn').click(function(){
                            var updateSubmitValue = $(this).parent().find("input[name = 'indValue']").val();
                            var updateSubmitName = $(this).parent().find("input[name = 'indName']").val();
                            var updateSubmitAge = $(this).parent().find("input[name = 'indAge']").val();
                            var updateSubmitEmail = $(this).parent().find("input[name = 'indEmail']").val();
                            $.post('updateSubmit.php', {id: updateSubmitValue, name: updateSubmitName,
                            age: updateSubmitAge, email: updateSubmitEmail}, function(){
                                lookupUser();
                            });
                        })
                    // })
                });
            }
        });
    }
//Route to lookup and removeInd
    $('#arusername').keyup(function(){
        lookupUser();
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