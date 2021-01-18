<?php

include 'conect.php';
$data = mysqli_query($koneksi, "select * from parameter ");
return json_encode($data);
?>
