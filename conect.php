<?php
	// open koneksi ke database
	define("db_host", "localhost");
	define("db_user", "root");
	define("db_pass", "");
	define("db_name", "kolamandi");
	
	$conect = mysqli_connect(db_host, db_user, db_pass, db_name);
	if (!$conect){
		die("Error!");
	}
	
	// ===
?>