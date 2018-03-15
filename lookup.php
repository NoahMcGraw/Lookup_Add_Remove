<?php
    require_once __DIR__ . "/pdoSetup.php";
    if (isset($_POST['name'])){
        $lookup = "SELECT * FROM test_table WHERE name LIKE :name";
        $lookupQuery = $pdo->prepare($lookup);
        $lookupQueryValues = array(
        ':name'=>'%'.$_POST['name'].'%',
        );
        $lookupQuery->execute($lookupQueryValues);
        $lookupResult = $lookupQuery->fetchAll();
        if (!empty($lookupResult)){
           echo json_encode($lookupResult);
            // foreach ($lookupResult as $eachResult) {
            //     echo "Name: " . $eachResult['name'] . "<br>";
            //     echo "Age: " . $eachResult['age'] . "<br>";
            //     echo "Email: " . $eachResult['email'] . "<br>";
            //     echo
            //     "<div class='removeBtnDiv'>
            //     <input type='submit' class='removeIndBtn' name='removeIndBtn' value='Remove User' />
            //     <input type='submit' class='updateBtn' name='updateBtn' value='Update Info' />
            //     <input type='hidden' class='indValue' name='indValue' value='" . $eachResult['id'] . "' />
            //     <input type='hidden' class='indName' name='indName' value='" . $eachResult['name'] . "' />
            //     <input type='hidden' class='indAge' name='indAge' value='" . $eachResult['age'] . "' />
            //     <input type='hidden' class='indEmail' name='indEmail' value='" . $eachResult['email'] . "' />
            //     <br><br>
            //     </div>";
            // }
        }
    }
    else {
        echo "POST name or email not set";
    }
?>