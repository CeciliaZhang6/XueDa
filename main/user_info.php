<?php
//user_info.php
include_once("dbh.php");
$given_email = "casdasdc@de.com";
$given_password = "6666asdasd";
$sql = "SELECT * FROM users";
$res = $conn->query($sql);

$result = $conn-> query($sql);
$arr = [];
if ($result->num_rows>0) {
    while($row = $result->fetch_assoc()){
        $arr[] = $row;
    }
}

$conn->close();
$json_arr = json_encode($arr, true);
echo $json_arr;
echo"<br></br>";

$array_data = json_decode($json_arr, true);

foreach($array_data as $item) {
    echo $item['email'] . " " . $item['pass_word'];
    echo"<br></br>";

}




if($res->num_rows > 0){
    while($row = $res->fetch_assoc()){
        $email = $row['email'];
        $password = $row['pass_word'];
        if($email === $given_email){
            if($password === $given_password){
                $_SESSION['curr_user'] = $email;
                echo "email and password matches";
                die("should go to index");
            }else{
                die( "email is good, not password bad");
            }
        }
    }
    echo "User not exists...please sign up";
}
?>
