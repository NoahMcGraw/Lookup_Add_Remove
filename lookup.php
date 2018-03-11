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
            foreach ($lookupResult as $eachResult) {
                echo "Name: " . $eachResult['name'] . "<br>";
                echo "Age: " . $eachResult['age'] . "<br>";
                echo "Email: " . $eachResult['email'] . "<br>";
                echo
                "<form action='/removeInd.php' method='POST'>
                    <input type='submit' id='removeIndBtn' name='removeIndBtn' value='" . $eachResult['id'] ."' />
                    <input type='hidden' id='removeIndValue' name='removeIndValue' value='" . $eachResult['id'] . "' />
                    <input type='hidden' id='removeIndName' name='removeIndName' value='" . $eachResult['name'] . "' />
                    <br><br>
                </form>";
            }
        }
        else {
            echo "No such Person<br>";
        }
    }
    else {
        echo "POST name or email not set";
    }
?>