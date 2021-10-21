<?php
    define('DB_SERVER', '127.0.0.1');
	define('DB_USERNAME', 'gianghoa');
	define('DB_PASSWORD', 'gianghoa123');
	define('DB_DATABASE', 'quanlydathang');

	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);


 function CloseCon($conn)
 {
 $conn -> close();
 }

 function firstStep(){
	if (session_id() === '') session_start();
	if (!isset($_SESSION["user"]))
		header("location:../index.php");
 }
?>