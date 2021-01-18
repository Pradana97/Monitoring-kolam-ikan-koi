<?php
  require "koneksi.php";
  date_default_timezone_set("Asia/Jakarta");
  $date = date('h:i:s');
  $var1=$_GET['NIK1'];
  $var2=$_GET['NIK2'];
  $var3=$_GET['NIK3'];
  $var4=$_GET['NIK4'];
  $hari = date('Y-m-d');
  $query="INSERT INTO `parameter` SET ph='$var1', volume='$var2', ppm='$var3', suhu='$var4', waktu='$date', hari='$hari'";
  $result = mysqli_query($conn,$query) or die('Errorquery:'.mysqli_error($query));

?>
