<?php 
// verifies the session, if there is no session it will redirect to the login page
// thanks to: https://www.tutorialspoint.com/php/php_mysql_login.htm

include 'gvars.php';

session_start();

if (!isset($_SESSION['usr_login'])) { header('location: login.php'); }
else {
	$usr = $_SESSION['usr_login'];

	$conn = new Connection($params);

	$sql = "select * from users where user = '$usr'";
	//$s_res = $conn->getConn()->query($sql);
	$s_res = $conn->runQuery($sql, 0); // select_ses
	$s_row = $s_res->fetch_array(MYSQLI_ASSOC); // associative array

	$login_session = $s_row['user']; // user
	
	// get the rest of the data
	$id = $s_row['id'];
	$credit = $s_row['credit'];
	$use1 = $s_row['use1'];
	$rt1 = $s_row['rt1'];
	$use2 = $s_row['use2'];
	$rt2 = $s_row['rt2'];
	$use3 = $s_row['use3'];
	$rt3 = $s_row['rt3'];
	$use4 = $s_row['use4'];
	$rt4 = $s_row['rt4'];

	$conn = null;
}

?>
