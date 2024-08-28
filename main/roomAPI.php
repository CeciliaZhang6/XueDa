<?php

include_once('dbh.php');

$sql = "SELECT * FROM rooms ORDER BY id desc"; // 降序排列

$api = [];

$res = $conn->query($sql);

if ($res->num_rows > 0){
    while($row = $res->fetch_assoc()){
        $api[] = $row;
    }
}

$jsonAPI = json_encode($api);
echo $jsonAPI;

$conn->close();
?>