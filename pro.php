<?php


require('config.php');
global $db;

$sql = "SELECT * FROM login";
$result = $db->query($sql);

echo "<script>alert("tejas")</script>";

while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $data[] = $row;
}


$results = ["sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data ];


echo json_encode($result);


?>