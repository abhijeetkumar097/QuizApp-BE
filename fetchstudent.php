<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require 'connectdp.php';

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['subject']) && isset($data['username'])) {

$subject = $data['subject'];
$username = $data['username'];
$query = "SELECT * FROM marks WHERE subject='$subject' && admin='$username'";
$result = mysqli_query($conn, $query);
$students = [];
if (mysqli_num_rows($result) > 0) {
    
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }
}
}
echo json_encode($students);

mysqli_close($conn);
?>