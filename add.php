<?php
    require_once __DIR__ . "/pdoSetup.php";
    if (!empty($_POST['arusername']) && !empty($_POST['age']) && !empty($_POST['email'])) {
        $compare = "SELECT * FROM test_table WHERE name LIKE :name OR email LIKE :email";
        $compareQuery = $pdo->prepare($compare);
        $compareQueryValues = array(
        ':name'=>$_POST['arusername'],
        ':email'=>$_POST['email']
        );
        $compareQuery->execute($compareQueryValues);
        $compareResult = $compareQuery->fetchAll();
        if (empty($compareResult)) {
            $add = "INSERT INTO test_table (id, name, age, email) VALUES (NULL, :name, :age, :email)";
	        $addQuery = $pdo->prepare($add);
	        $addQueryValues = array(
	        ':name'=>strToUpper($_POST['arusername']),
	        ':age'=>$_POST['age'],
	        ':email'=>$_POST['email']
	        );
	        $addQuery->execute($addQueryValues);
        }
        else {
            foreach($compareResult as $result) {
                if ($result['name'] == strtoupper($_POST['arusername'])) {
                    echo strtoupper($_POST['arusername']) . " already exists in the database!";
                }
                else if (strtoupper($result['email']) == strtoupper($_POST['email'])) {
                    echo $_POST['email'] . " is already registered to another user!";
                }
                else {
                    echo "Error: var compareResult NOT EMPTY but matched user did not compare!";
                }
            }
        }
    }
    else {
        echo "Please fill out all of the fields to add a user";
    }
?>