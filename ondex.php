
<?php

	define("db_host", "localhost");
	define("db_user", "abmbtour_ta");
	define("db_pass", "pradanapodcast123");
	define("db_name", "abmbtour_ta");
	
	$conect = mysqli_connect(db_host, db_user, db_pass, db_name);
	if (!$conect){
		die("Error!");
	}
	
	// mengambil nilai dari yang di input di form login
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// perintah untuk mendapatkan user dari db berdasarkan nama yang di input di form login
	$get_user = "SELECT * FROM login WHERE username = '$username'";
	$result = mysqli_query($conect,$get_user);
	$data = mysqli_fetch_array($result);
		if($username == $data['username']){
		    Header("Location: http://pradanapodcast.com/index1.php");
		   die();
		}else{
		    echo "salah";
		}
?>
