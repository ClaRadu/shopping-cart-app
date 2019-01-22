<!DOCTYPE html>
<html>
<head>
<body>

<?php
require 'gvars.php';

$con = new Connection($params);

$sql = "select * from " . $tables['shop'];
$res = $con->runQuery($sql, 0);

if ($res->num_rows > 0) {
	echo "<option value='0#0' selected>Select a product:</option>";
	while($rowtab = $res->fetch_assoc()) {
		echo "<option value=" . $rowtab["id"] . "#" . $rowtab['value'] . ">";
		echo $rowtab["name"] . "</option>";
	}
} else {
	echo 'No results found.';
}

unset($con); // destroy the object
?>

</body>
</html>
