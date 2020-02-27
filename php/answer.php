<?php
header('Access-Control-Allow-Origin: https://upread.github.io');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');

$answer = preg_replace('/[^0-9]/', '', $_POST['answer']);
$keyUser = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['keyUser']);


if (isset($_POST['answer'])){ 
$conn = new mysqli("localhost", "user", "pass", "baza");
if ($conn->connect_error) {die("Ошибка: невозможно подключиться: " . $conn->connect_error);}
$result_user = $conn->query("SELECT * FROM `gt_users` WHERE `keyUser` = '$keyUser' ");
if ($row_user = $result_user->fetch_assoc()) {
$igra = $row_user['igra'];
}

else die();


$result = $conn->query("SELECT * FROM `gt_igra` WHERE `id` = '$igra' AND `id_answer_true` = '$answer'");
if ($row = $result->fetch_assoc()) {
$query = "UPDATE `gt_users` SET `igra` = `igra` + 1 WHERE `keyUser`='$keyUser'";
mysqli_query($conn, $query) or die (mysqli_error($conn)); 	
echo "Ответ верный!";
}
else echo "Ответ неверный!";


$conn->close();
}
?>