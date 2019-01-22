<?php 
// login / register form

include 'dbs/gvars.php';

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// create db object
	$conn = new Connection($params);
	
	// username and password sent from form
	$rec_username = mysqli_real_escape_string($conn->getConn(), $_POST['username']);
	$rec_pass = mysqli_real_escape_string($conn->getConn(), $_POST['password']);
	
	$sql = "select id from users where user = '" . $rec_username . "' and 
		pass = '" . sha1($rec_pass) . "'";
	
//	$res = $conn->getConn()->query($sql);
	$res = $conn->runQuery($sql, 0); // sel_usr
	$row = $res->fetch_array(MYSQLI_ASSOC);
	
	$count = $res->num_rows;
	
	// if results matched, table row should be 1
	if ($count == 1) {
//		session_register('rec_username'); // deprecated
		$_SESSION['usr_login'] = $rec_username;
		
		header('Location: index.php');
	} else {
//		$error = "You username or password is invalid. u=$rec_username & p=$rec_pass"; // debug
		$error = "You username or password is invalid.";
	}
	
	$conn = null;

}

?>

<!DOCTYPE html>
<html>
<title>Login / Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script>
function reg()
{
	var user = document.getElementById("userb").value;
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;
	var str = 'u='+user+'&p1='+pass1+'&p2='+pass2;
	
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else { // older ie versions
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("info").innerHTML = this.responseText;
		}
	}
	
	xmlhttp.open("post", "dbs/reg.php", true);
	xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.send(str);
	
	return true;
}

function toggle(val)
{
	// default - login
	var var1 = 'block';
	var var2 = 'none';
	
	if (val && val.toUpperCase() == 'REG') { // register
		var buff = var2;
		var2 = var1;
		var1 = buff;
	}
	
	document.getElementById("log").style.display = var1;
	document.getElementById("reg").style.display = var2;
	// clear info div
	document.getElementById("info").innerHTML = "";
	// clear values in controls
	document.getElementById("user").value = "";
	document.getElementById("pass").value = "";
	document.getElementById("userb").value = "";
	document.getElementById("pass1").value = "";
	document.getElementById("pass2").value = "";
}
</script>
<body>

<div id='log' style="display:block;" class="w3-container w3-blue">
	<div class='w3-indigo w3-round' align='center'>
		<h1 style='color:CornflowerBlue;'>Login</h1>
	</div></br>
	<div>
		<form action="" method="post">
			<label>Username: </label><input id='user' type="text" name="username"></br></br>
			<label>Password: </label><input id='pass' type="password" name="password"></br></br>
			<input type="submit" class="w3-button w3-white w3-round" value="Login"/><br />
		</form>
	</div>
	<hr>
	<div><?php echo $error; ?></div>
	<hr>
	<div class='w3-teal w3-round w3-padding'>
		<label>Or, if you are not registered yet, </label>
		<button id='btnsign' class='w3-button w3-black w3-round' onclick='toggle("reg")' >Sign up</button>
	</div>
	</br>
</div>

<div id='reg' style="display:none;" class="w3-container w3-teal">
	<div class='w3-gray w3-round' align='center'>
		<h1 style='color:teal;'>Register</h1>
	</div></br>
	<div>
		<label>Enter username: </label><input id='userb' type="text" name="user"></br></br>
		<label>Enter password: </label><input id='pass1' type="password" name="pass1"></br></br>
		<label>Confirm password: </label><input id='pass2' type="password" name="pass2"></br></br>
		<button id='btnreg' class='w3-button w3-white w3-round' onclick='reg()' >Register</button>
	</div>
	<hr>
	<div id='info'></div>
	<hr>
	<div class='w3-blue w3-round w3-padding'>
		<label>Or, if you are allready registered, </label>
		<button id='btnsign' class='w3-button w3-black w3-round' onclick='toggle()' >Go to login</button>
	</div>
	</br></br>
</div>

</body>
</html> 
