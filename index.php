<?php

            echo "<strong>Check out my SQL Database!</strong><br>";
            $host = "localhost";
            $dbname = "test_db1";
            $user = "secure_user";
            $password = "462nTxXb555MVnjD";


            $dsn = "mysql:host=". $host .";dbname=". $dbname;


            $pdo = new PDO($dsn, $user, $password);

	    class Person {

		public $isValid = true;
		public $name;
		public $age;
		public $email;

		public function __construct($name, $age, $email){

		$this->name = $name;
		$this->age = $age;
		$this->email = $email;
		}

		public function whoami() {

		echo "I am  " . $this->name . ", I am " . $this->age;
		echo " years old, and my email address is " . $this->email ;
		}
	    }

?>
<html>
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
</html>
<?php
//instructions for user lookup
if ($_POST['lookupusername'] && isset($_POST['lookup'])){
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
	}
	}
else {
	echo "No such Person<br>";
}
}

//instructions for user add
//$password = "bread";
if ($_POST['arusername'] && $_POST['age'] && $_POST['email'] && isset($_POST['add'])){
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
else if ($_POST['arusername'] && isset($_POST['remove'])){
	$remove = "DELETE FROM test_table WHERE name LIKE :name";
	$removeQuery = $pdo->prepare($remove);
	$removeQueryValues = array(
	':name'=>$_POST['arusername']
	);
	$removeQuery->execute($removeQueryValues);
	echo strToUpper($_POST['arusername']) . " was removed from the database!";
  }

else if ((!$_POST['arusername'] || !$_POST['age'] || !$_POST['email']) && isset($_POST['add'])){
echo "Please fill out all of the fields to add a user";
}

else if (!$_POST['arusername'] && isset($_POST['remove'])){
echo "Please fill out the required field to remove a user";
}
?>

