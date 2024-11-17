<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require 'connectdp.php';

$data = json_decode(file_get_contents("php://input"), true);
//data: {ans: '6/6'}
$require = ['success' => false];

if(isset($data['ans']) && isset($data['subject']) && isset($data['username']) && isset($data['admin'])) {
    $username = $data['username'];
    $subject = $data['subject'];
    $score = $data['ans'];
    $admin = $data['admin'];
    $query1 = "SELECT * FROM marks WHERE username = '$username' AND subject = '$subject' AND admin='$admin'";
    $result = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result) > 0) {
        $query2 = "UPDATE marks SET score = '$score' WHERE username = '$username' AND subject = '$subject' AND admin='$admin'";
        if(mysqli_query($conn, $query2))
        $require['success'] = true;
    }
    else {
    $query = "INSERT INTO marks (username, subject, score, admin) VALUES('$username', '$subject', '$score', '$admin')";
    if(mysqli_query($conn, $query)) {
        $require['success'] = true;
    }}
}
echo json_encode($require);
mysqli_close($conn);

?>