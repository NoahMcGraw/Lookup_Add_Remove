<?php
    require_once __DIR__ . "/pdoSetup.php";
    if (isset($_POST['name']){
        $lookup = "SELECT * FROM test_table WHERE name LIKE :name";
        $lookupQuery = $pdo->prepare($lookup);
        $lookupQueryValues = array(
        ':name'=>'%'.$_POST['name'].'%'
        );
        $lookupQuery->execute($lookupQueryValues);
        $lookupResult = $lookupQuery->fetchAll();
        if ($lookupResult){
            foreach ($lookupResult as $eachResult) {
                echo "Name: " . $eachResult['name'] . "<br>";
                echo "Age: " . $eachResult['age'] . "<br>";
                echo "Email: " . $eachResult['email'] . "<br>";
                //echo
                //"<form method='POST'>
                //    <input type='submit' value='Remove User' />
                //    <input type='hidden' name='id' value='" . $eachResult['id'] . "' />
                //</form>";
            }
        }
        else {
            echo "No such Person<br>";
        }
    }
    else {
        echo "$_POST['name'] not set";
    }
?>