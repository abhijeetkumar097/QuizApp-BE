<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require "connectdp.php"; // Make sure this file connects to the database correctly

// Decode the JSON input data
$data = json_decode(file_get_contents("php://input"), true);
$response = ["success" => false];

if (!empty($data['ids'])) {
    // Escape values to prevent SQL injection
    $escaped_ids = array_map(function($ids) use ($conn) {
        return mysqli_real_escape_string($conn, $ids);
    }, $data['ids']);
    
    // Convert array of regnos to a string for SQL IN clause
    $ids = implode("','", $escaped_ids);
    $sql = "DELETE FROM marks WHERE id IN ('$ids')";

    // Execute the query and set response success if successful
    if (mysqli_query($conn, $sql)) {
        $response["success"] = true;
    } else {
        error_log("SQL Error: " . mysqli_error($conn)); // Log SQL error if any
    }
}

echo json_encode($response); // Send JSON response back to the client

mysqli_close($conn); // Close database connection
?>
