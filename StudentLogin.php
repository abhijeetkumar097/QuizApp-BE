<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require 'connectdp.php';
$response = ['success' => false];
$data = json_decode(file_get_contents("php://input"), true);

// Debugging: Capture the data for inspection
$response['received_data'] = $data; // Add the data to the JSON response

// Check if 'uname' and 'password' exist in the received data
if (isset($data['uname']) && isset($data['pass'])) {
    $uname = $data['uname'];
    $password = $data['pass'];
    // Construct the query with quotes around the values
    $query = "SELECT * FROM students WHERE id = '$uname' AND password = '$password'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $response['success'] = true;
        $response['message'] = "User found.";
    } else {
        $response['message'] = "User not found or incorrect credentials.";
    }
} else {
    $response['message'] = "Username or password not provided.";
}

// Return JSON response
echo json_encode($response);

mysqli_close($conn);
?>
