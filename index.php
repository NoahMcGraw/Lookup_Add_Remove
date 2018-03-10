<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="/jQuery.js"></script>
	</head>
	<body>
		<h1>Lookup a User!</h1>
		<form action="" method="POST">
	    	Name:  <input type="text" name="lookupusername" /><br/>
	    	<input type="submit" name="lookup" value="Lookup" />
		</form>
		<h1>Add/Remove a User!</h1>
		<p>Please fill out the <strong>Name, Age, and Email</strong> of the user and click <strong>ADD</strong> to add them to the database.
		<br>
		<strong>OR</strong>
		<br>
		Insert the <strong>Name</strong> of the user and click remove to remove them from the database.<p>
		<form action="" method="POST">
	    	Name:  <input type="text" name="arusername" /><br/>
	    	Age:   <input type="int" name="age" /><br/>
	    	Email: <input type="text" name="email" /><br/>
	    	Password: <input type="text" name="password" /><br/>
	    	<input type="submit" name="add" value="Add" />
	    	<input type="submit" name="remove" value="Remove" />
		</form>
		<div class="target"><p>this is not jQuery</p></div>
	<body>
</html>
<?php
	require_once __DIR__ . "/pdoSetup.php";
	require_once __DIR__ . "/personClass.php";
	//instructions for user lookup
	if (isset($_POST['lookup'])){
		$lookup = "SELECT * FROM test_table WHERE name LIKE :name";
		$lookupQuery = $pdo->prepare($lookup);
		$lookupQueryValues = array(
		':name'=>'%'.$_POST['lookupusername'].'%'
		);
		$lookupQuery->execute($lookupQueryValues);
		$lookupResult = $lookupQuery->fetchAll();
		if ($lookupResult){
			foreach ($lookupResult as $eachResult) {
			echo "Name: " . $eachResult['name'] . "<br>";
			echo "Age: " . $eachResult['age'] . "<br>";
			echo "Email: " . $eachResult['email'] . "<br>";
			echo
			"<form method='POST'>
				<input type='submit' value='Remove User' />
				<input type='hidden' name='id' value='" . $eachResult['id'] . "' />
			</form>";
			}
		}
		else {
			echo "No such Person<br>";
		}
	}

	if (isset($_POST['id'])) {
			$removeInd = "DELETE FROM test_table WHERE id Like :id";
			$removeIndQuery = $pdo->prepare($removeInd);
			$removeIndQueryValues = array(
				':id'=>$_POST['id']
			);
			$removeIndQuery->execute($removeIndQueryValues);
			echo "Deleted";	
		
	}

	//instructions for user add
	//$password = "bread";
	if (!empty($_POST['arusername']) && !empty($_POST['age']) && !empty($_POST['email']) && isset($_POST['add'])){
		$add = "INSERT INTO test_table (id, name, age, email) VALUES (NULL, :name, :age, :email)";
		$addQuery = $pdo->prepare($add);
	    $addQueryValues = array(
		':name'=>strToUpper($_POST['arusername']),
		':age'=>$_POST['age'],
		':email'=>$_POST['email']
		);
	    $addQuery->execute($addQueryValues);
		echo $_POST['arusername'] . " was added to the database!";
	}

	//instructions for user remove
	else if ((!empty($_POST['arusername']) || !empty($_POST['email'])) && isset($_POST['remove'])){
		$remove = "DELETE FROM test_table WHERE name LIKE :name OR email LIKE :email";
		$removeQuery = $pdo->prepare($remove);
		$removeQueryValues = array(
		':name'=>$_POST['arusername'],
		':email'=>$_POST['email']
		);
		$removeQuery->execute($removeQueryValues);
		echo strToUpper($_POST['arusername']) . ($_POST['email']) . " was removed from the database!";
	}

	else if ((empty($_POST['arusername']) || empty($_POST['age']) || empty($_POST['email'])) && isset($_POST['add'])){
		echo "Please fill out all of the fields to add a user";
	}

	else if ((empty($_POST['arusername']) && empty($_POST['email'])) && isset($_POST['remove'])){
		echo "Please fill out the required field to remove a user";
	}
?>

