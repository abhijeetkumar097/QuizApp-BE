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
$query = "SELECT * FROM question WHERE subject = '$subject' AND username = '$username'";

$result = mysqli_query($conn, $query);

$questions = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row;
    }
}

}

echo json_encode($questions);

mysqli_close($conn);
?>