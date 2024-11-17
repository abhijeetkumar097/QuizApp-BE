<?php
$severname = 'localhost';
$username  = 'root';
$password = '';
$dbname = 'project';
$conn = "";
try {
    $conn = mysqli_connect($severname, $username, $password, $dbname);
}catch(mysqli_sql_exception) {
    
}

?>