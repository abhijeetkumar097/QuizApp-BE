<?php
$server_port = $_SERVER['SERVER_PORT'];
echo "Server is running on port: " . $server_port;
$client_port = $_SERVER['REMOTE_PORT'];
echo "Request was sent from port: " . $client_port;
?>
