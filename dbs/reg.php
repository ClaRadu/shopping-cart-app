<!DOCTYPE html>
<html>
<head>
<body>

<?php
require 'gvars.php';

$u = strval($_POST['u']);
$p1 = strval($_POST['p1']);
$p2 = strval($_POST['p2']);

// default values
$use1 = 0;
$rt1 = 3.5;
$use2 = 0;
$rt2 = 2.5;
$use3 = 0;
$rt3 = 4;
$use4 = 0;
$rt4 = 1.2;
$credit = 100;

//error_reporting(0);

// no point continuing if passwords don't match
if ($p1 == $p2)
{
	// create db object
	$conn = new Connection($params);
	
	$sql = "SELECT * FROM " . $tables['user'] . " WHERE user ='" . $u . "'";
	$result = $conn->runQuery($sql, 0); // sel_usr

	if ($result && $result->num_rows > 0)
		echo "User allready exists. Please select another username.";
	else
	{
		if ($u != "") {
			$sqli = "INSERT INTO users (user, pass, use1, rt1, use2, rt2, use3, rt3, use4, rt4, credit) 
				VALUES ('$u', sha1('$p1'), $use1, $rt1, $use2, $rt2, $use3, $rt3, $use4, $rt4, $credit)";
			$resi = $conn->runQuery($sqli, 0);

			if ($resi === TRUE) // new user created
			{
				// check if user wants to login with the newly created usename and pass
				echo "<form name='loginfrm' action='login.php' method='post'>";
				echo "<input type='hidden' name='username' value='" . $u . "'>";
				echo "<input type='hidden' name='password' value='" . $p1 . "'>";
				echo "Hello " . $u . ", proceed to main page: ";
				echo "<input type='submit' class='w3-button w3-blue w3-border w3-round' value='Continue'>";
				echo "</form>";
			}
//			else echo "Error: " . $sqli . "<br>" . $conn->error;
		} else {
//			echo "Username not valid!";
		}
	}	
}
else
	echo "Passwords are not the same.";

?>

</body>
</html>
