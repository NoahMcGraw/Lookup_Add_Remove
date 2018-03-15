<?php
    require_once __DIR__ . "/pdoSetup.php";
    if(!empty($_POST['id'])){
        $update =
        "UPDATE test_table
        SET name = :name, age = :age, email = :email
        WHERE id = :id";
        $updateQuery = $pdo->prepare($update);
        $updateQueryValues = array(
        ':id'=>$_POST['id'],    
        ':name'=>strtoupper($_POST['name']),
        ':age'=>$_POST['age'],
        ':email'=>$_POST['email']
        );
        $updateQuery->execute($updateQueryValues);
    }
    else{
        echo "ID not set!";
    }
?>