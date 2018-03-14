<?php
    if(isset($_POST['updateValue'])){
        echo "
        <br>
        <h3>Update info for: " . $_POST['updateName'] . "</h3>
        <div>
            <input type='hidden' class='updateValue' name='updateValue' value='" . $_POST['updateValue'] . "' />
            Name: <input type='text' class='updateName' name='updateName' value='" . $_POST['updateName'] . "' /><br>
            Age: <input type='number' class='updateAge' name='updateAge' value='" . $_POST['updateAge'] . "' /><br>
            Email: <input type='text' class='updateEmail' name='updateEmail' value='" . $_POST['updateEmail'] . "' /><br>
            <input type='submit' class='updateSubmitBtn' name='updateSubmitBtn' value='Submit' />
        </div>
        ";
    }
?>