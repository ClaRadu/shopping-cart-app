<!DOCTYPE html>
<html>
<head>
<body>

<?php
// export data from the db to xml using exportData class
require 'exportData.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	$toXml = new exportData($params); // create object

	// create or open xml file to store data
	$fname = "../data/Products.xml";
	$toXml->create($fname);

	// root
	$r1 = "Products";
	$toXml->setRoot($r1);

	// main node
	$node = 'product';
	$toXml->setNode($node);

	// elements to search for
	$elem = array('id', 'name', 'value');

	// export data from db to xml
	$sql = "SELECT * FROM " . $tables['shop'] . " WHERE id =" . $id;
	$toXml->export($sql, $elem);

	// release object from memory
	unset($toXml);
}
?>
</div>
</body>
</html>
