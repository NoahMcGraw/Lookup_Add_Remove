<?php
    require_once __DIR__ . "/pdoSetup.php";
    if (!empty($_POST['removeIndValue'])) {
        $removeInd = "DELETE FROM test_table WHERE id = :removeIndValue";
        $removeIndQuery = $pdo->prepare($removeInd);
        $removeIndQueryValues = array(
            ':removeIndValue'=>$_POST['removeIndValue']
        );
        $removeIndQuery->execute($removeIndQueryValues);
    }
    else{
        echo "Error: Post 'removeIndValue not set!'";
    }
?>