   <?php
    $con = mysqli_connect("localhost", "root", "", "kolamandi");

$sql_query = "Select * From monitor
where id_monitor = (select max(id_monitor) from monitor)";
$result = mysqli_query($con,$sql_query);
if(mysqli_num_rows($result)>0) {
//    $response['success'] =1;
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
    }

//    $response['data'] = $data;
}
echo json_encode($data);