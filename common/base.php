<?php
	// Start a PHP session
	session_start();

	// Include site constants
	include_once "inc/constants.inc.php";

	if ( !isset($_SESSION['token']) || time()-$_SESSION['token_time']>=300 )
	{
		$_SESSION['token'] = md5(uniqid(rand(), TRUE));
		$_SESSION['token_time'] = time();
	}
	
	// Create a database object
	try {
		$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
		$db = new PDO($dsn, DB_USER, DB_PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
		exit;
	}
?>