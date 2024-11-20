<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require 'connectdp.php';

$response = ['success' => false];
$data = json_decode(file_get_contents('php://input'), true);

// if (isset($data['question'])) {
//     $question = $data['question'];
//     $a = $data['option_a'];
//     $b = $data['option_b'];
//     $c = $data['option_c'];
//     $d = $data['option_d'];
//     $answer = $data['answer'];
//     $subject = $data['subject'];
//     $username = $data['username'];

//     $query = "INSERT INTO question (ques, option_a, option_b, option_c, option_d, answer, subject, username) VALUES ('$question', '$a', '$b', '$c', '$d', '$answer', '$subject', '$username')";

//     if (mysqli_query($conn, $query)) {
//         $response['success'] = true;
//         $response['message'] = 'Question added successfully';
//     } else {
//         $response['message'] = 'Error adding question: '. mysqli_error($conn);
//     }
// } else {
//     $response['message'] = 'Incomplete data provided';
// }

if (isset($data['question'])) {
    $question = mysqli_real_escape_string($conn, $data['question']);
    $a = mysqli_real_escape_string($conn, $data['option_a']);
    $b = mysqli_real_escape_string($conn, $data['option_b']);
    $c = mysqli_real_escape_string($conn, $data['option_c']);
    $d = mysqli_real_escape_string($conn, $data['option_d']);
    $answer = mysqli_real_escape_string($conn, $data['answer']);
    $subject = mysqli_real_escape_string($conn, $data['subject']);
    $username = mysqli_real_escape_string($conn, $data['username']);

    $query = "INSERT INTO question (ques, option_a, option_b, option_c, option_d, answer, subject, username) 
              VALUES ('$question', '$a', '$b', '$c', '$d', '$answer', '$subject', '$username')";

    if (mysqli_query($conn, $query)) {
        $response['success'] = true;
        $response['message'] = 'Question added successfully';
    } else {
        $response['message'] = 'Error adding question: ' . mysqli_error($conn);
    }
} else {
    $response['message'] = 'Incomplete data provided';
}


echo json_encode($response);

mysqli_close($conn);
?>
