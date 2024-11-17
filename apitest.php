<?php
// Set CORS and Content-Type headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Your PHP logic here, such as connecting to the database and fetching data
$data = ["name" => "Product 1", "price" => 100];

// Send JSON response
echo json_encode($data);
?>