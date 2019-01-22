<!DOCTYPE html>
<html>
<head>
<body>
<?php 
require 'gvars.php';

$id = intval($_GET['id']); // user id
$rt0 = floatval($_GET['s0']); // ratings
$rt1 = floatval($_GET['s1']);
$rt2 = floatval($_GET['s2']);
$rt3 = floatval($_GET['s3']);
$rt4 = floatval($_GET['s4']);
$us0 = intval($_GET['r0']); // is prod. allready rated
$us1 = intval($_GET['r1']);
$us2 = intval($_GET['r2']);
$us3 = intval($_GET['r3']);
$us4 = intval($_GET['r4']);
$cr = floatval($_GET['cr']); // user credit

/*echo $s0 . '/' . $s1 . '<br>';
echo $r0 . '/' . $r1 . '<br>';
echo $id . "/" . $cr . '<br>';
echo 'shit son!!!';*/

if (isset($_GET['id'])) {
	// create db object
	$conn = new Connection($params);
	
	if ($id > 0 && $cr > 0) { // make sure user id and credit are valid
		$sql1 = "UPDATE users SET use1={$us1}, use2={$us2}, use3={$us3}, use4={$us4} WHERE id={$id}";
		$conn->runQuery($sql1, 0);
		$sql2 = "UPDATE users SET rt1={$rt1}, rt2={$rt2}, rt3={$rt3}, rt4={$rt4} WHERE id={$id}";
		$conn->runQuery($sql2, 0);
		$sql3 = "UPDATE users SET credit={$cr} WHERE id={$id}";
		$conn->runQuery($sql3, 0);
	}
	$conn = null; // clear the object
}

?>
</body>
</html>
