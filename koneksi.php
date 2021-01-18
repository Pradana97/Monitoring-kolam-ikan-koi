<?php
$host_name = "localhost";
$user_name = "root";
$password =  "";
$database =  "kolamandi";

$conn = mysqli_connect ($host_name, $user_name, $password);
if ($conn) {
	$buka = mysqli_select_db ($conn,$database);
	if (!$buka) {
	die ("Database tidak dapat dibuka");	
	}
} else {
	die ("Server MySQL tidak terhubung");	
}
