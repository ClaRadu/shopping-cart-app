<!DOCTYPE html>
<html>
<head>
<title>Create app's dbs and tables</title>
<body>
<?php 
// create the database and tables required by this app and populate them with test data
require 'dbs/gvars.php';

// default values
$cr_db = 1; // create database
$cr_tab = 2; // create both tables
$cr_tab1 = 21; // create 1st table
$cr_tab2 = 22; // create 2nd table
$add_tab = 3; // add test data in both tables
$add_tab1 = 31; // add test data in 1st table
$add_tab2 = 32; // add test data in 2nd table
$enc = 0; // ( 1=true / 0=false ) encode passwords in 'users' table

?>

<form name='createfrm' action='create.php' method='post'>
<u>Select an option:</u>
<p><?php echo $cr_db; ?>. Create db</p>
<p><?php echo $cr_tab; ?>. Create both tables <?php echo "( $cr_tab1. Create only 1st table / $cr_tab2. Create only 2nd table )"; ?></p>
<p><?php echo $add_tab; ?>. Add test data to both tables <?php echo "( $add_tab1. Add only to 1st table / $add_tab2. Add only to 2nd table )"; ?></p>
<input type='text' name='selopt' placeholder=" write option here..">
<input type='submit' value='OK'>
</form>


<?php 
// check if valid input from user received
$selopt = 0;
if (isset($_POST['selopt']) && !empty($_POST['selopt'])) { $selopt = $_POST['selopt']; }

// create db object
$conn = new Connection($params);

// encode data, if it was requested
if ($enc > 0) encodePass($conn->getConn(), $tables['user'], 1, 3);

// this is where all the magic happens
// check if db exists
echo '<ul>';
if ($conn->exists($params['dbs'], 'databases')) {
	echo '<li>Database `' . $params['dbs'] . '` found.</li>';
	
	// check if 1st table exists
	if ($conn->exists($tables['shop'], 'tables')) {
		echo '<li>Table `' . $tables['shop'] . '` found;</li><ul><li>';
		// check if table is populated
		if ($conn->isEmpty($tables['shop'])) {
			echo 'Table is empty. Add test data.</ul></li>';
			// check first
			if ($selopt == $add_tab || $selopt == $add_tab1) { // then add
				$sqli = array();
				// sql command(s) to insert data into the table
				$sqli[] = "INSERT INTO service (name, value) VALUES ('apple', 0.3)";
				$sqli[] = "INSERT INTO service (name, value) VALUES ('beer', 2)";
				$sqli[] = "INSERT INTO service (name, value) VALUES ('cheese', 3.74)";
				$sqli[] = "INSERT INTO service (name, value) VALUES ('water', 1)";
				foreach ($sqli as $x) {
					$conn->runQuery($x, 'insert_t1'); // insert data into the table
				}
			}
		} else {
			echo 'Data found in table.</ul></li>';
		}
	} else { // check if user wants to create it
		if ($selopt == $cr_tab || $selopt == $cr_tab1) { // if yes, create the table
			$sql1 = "CREATE TABLE {$tables['shop']} (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				name VARCHAR(30) NOT NULL,
				value DOUBLE(3,2))";
			$conn->runQuery($sql1, 'create_t1'); // create 1st table
		}
	} // end t1
	
	// check if 2nd table exists
	if ($conn->exists($tables['user'], 'tables')) {
		echo '<li>Table `' . $tables['user'] . '` found;</li><ul><li>';
		// check if table is populated
		if ($conn->isEmpty($tables['user'])) {
			echo 'Table is empty. Add test data.</ul></li>';
			// check first
			if ($selopt == $add_tab || $selopt == $add_tab2) { // then add
				$sqli = array();
				// sql command(s) to insert data into the table
				$sqli[] = "INSERT INTO users (user, pass, use1, rt1, use2, rt2, use3, rt3, use4, rt4, credit) VALUES ('admin', sha1('0000'), 0, 3.5, 0, 2.5, 0, 4, 0, 1.2, 100)";
				$sqli[] = "INSERT INTO users (user, pass, use1, rt1, use2, rt2, use3, rt3, use4, rt4, credit) VALUES ('user', sha1('1234'), 0, 3.5, 0, 2.5, 0, 4, 0, 1.2, 100)";
				$sqli[] = "INSERT INTO users (user, pass, use1, rt1, use2, rt2, use3, rt3, use4, rt4, credit) VALUES ('cla', sha1('0001'), 0, 3.5, 0, 2.5, 0, 4, 0, 1.2, 100)";
				foreach ($sqli as $x) {
					$conn->runQuery($x, 'insert_t2'); // insert data into the table
				}
			}
		} else {
			echo 'Data found in table.</ul></li>';
		}
	} else { // check if user wants to create it
		if ($selopt == $cr_tab || $selopt == $cr_tab2) { // if yes, create the table
			$sql3 = "CREATE TABLE {$tables['user']} (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				user VARCHAR(15) NOT NULL,
				pass VARCHAR(255) NOT NULL,
				use1 INT(1),
				rt1 DOUBLE(3,2),
				use2 INT(1),
				rt2 DOUBLE(3,2),
				use3 INT(1),
				rt3 DOUBLE(3,2),
				use4 INT(1),
				rt4 DOUBLE(3,2),
				credit DOUBLE(5,2))";
			$conn->runQuery($sql3, 'create_t2'); // create 2nd table
		}
	} // end t2

} else { // check if user wants to create it
	echo "<li>Database not found. Please create it.</li>";
	if ($selopt == $cr_db) { // if yes, create the database
		$sql = "CREATE DATABASE {$params['dbs']}";
		$conn->runQuery($sql, 'create_db');
	}
} // end db
echo '</ul>';
echo "<a href='create.php'>Refresh</a>";

// relese obj. from memory
unset($conn); // should be released automatically, but anyway..

// encode passwords
function encodePass($conn, $table, $idstart, $idstop)
{
	$n = $idstart;
	$max = $idstop;
	while ($n <= $max)
	{
		$sqln = "UPDATE $table SET pass=sha1(pass) WHERE id={$n}";
		if ($conn->query($sqln) === TRUE) {
			echo "<br/> id $n updated successfully";
		} else {
			echo "<br/> Error updating table on id $n: " . $conn->error;
		}
		$n++;
	} 
}

?>

</body>
</html>
