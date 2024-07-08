<?php

include_once('dbh.php');

$sql = "SELECT * FROM rooms";

$api = [];

$res = $conn->query($sql);

if ($res->num_rows > 0){
    while($row = $res->fetch_assoc()){
        $api[] = $row;
    }
}

$jsonAPI = json_encode($api);
echo $jsonAPI;

?>