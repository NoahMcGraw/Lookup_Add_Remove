<?php
    require_once __DIR__ . "/pdoSetup.php";
    if(!empty($_POST['updateSubmitValue'])){
        $update =
        "UPDATE test_table
        SET name = :name, age = :age, email = :email
        WHERE id = :id";
        $updateQuery = $pdo->prepare($update);
        $updateQueryValues = array(
        ':id'=>$_POST['updateSubmitValue'],    
        ':name'=>$_POST['updateSubmitName'],
        ':age'=>$_POST['updateSubmitAge'],
        ':email'=>$_POST['updateSubmitEmail']
        );
        $updateQuery->execute($updateQueryValues);
    }
    else{
        echo "ID not set!";
    }
?>