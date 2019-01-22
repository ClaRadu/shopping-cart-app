<?php 
// contains information about how to logout from the login session
// thanks to: https://www.tutorialspoint.com/php/php_mysql_login.htm

session_start();

if (session_destroy()) { header('location: ../login.php'); }

?>
