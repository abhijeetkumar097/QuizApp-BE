<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require 'connectdp.php';

$data = json_decode(file_get_contents("php://input"), true);
$response = ['success' => false];

if(isset($data['username']) && isset($data['password'])) {
    $username = $data['username'];
    $password = $data['password'];

    $query1 = "SELECT * FROM students WHERE id = '$username'";
    $result = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result) > 0) {
        $response['message'] = "Username is already taken";
    }
    else {
        $query2 = "INSERT INTO students (id, password) VALUES ('$username', '$password')";
        if(mysqli_query($conn, $query2)) {
            $response['success'] = true;
            $response['message'] = "Registration successful";
        }
        else {
            $response['message'] = "Registration failed: " . mysqli_error($conn);
        }
    }
} else {
    $response['message'] = "Username or password not provided";
}

echo json_encode($response);

mysqli_close($conn);
?>
