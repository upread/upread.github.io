<?php
header('Access-Control-Allow-Origin: https://upread.github.io');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');

$conn = new mysqli("localhost", "user", "pass", "baza");
if ($conn->connect_error) {die("Ошибка: невозможно подключиться: " . $conn->connect_error);}

$keyUser = preg_replace('/[^a-zA-Z0-9]/', '', $_POST['keyUser']);
$result_user = $conn->query("SELECT * FROM `gt_users` WHERE `keyUser` = '$keyUser' ");
if ($row_user = $result_user->fetch_assoc()) {
$igra = $row_user['igra'];
}

else {
$igra = 1;
$query = "INSERT INTO `gt_users` (`id` ,`keyUser` ,`igra` ,`name`) VALUES (NULL, '".$keyUser."','1','');";
mysqli_query($conn, $query) or die (mysqli_error($conn));
}



$result = $conn->query("SELECT * FROM `gt_igra` WHERE `id` = '$igra' ");
if ($row = $result->fetch_assoc()) {
	
$id_question = $row['id_question'];
$id_answer_1 = $row['id_answer_1'];
$id_answer_2 = $row['id_answer_2'];
$id_answer_3 = $row['id_answer_3'];
$id_answer_4 = $row['id_answer_4'];

$result_question = $conn->query("SELECT * FROM `gt_question` WHERE `id` = '$id_question' ");	
$row_question = $result_question->fetch_assoc();

$str = '<div id="question" data-value="'.$id_question.'">'.$row_question["txt"].'</div><br />';
	
$result_answer = $conn->query("SELECT * FROM `gt_answer` WHERE `id` = '$id_answer_1'");
$row_answer  = $result_answer ->fetch_assoc();
$str .= '<input type="radio" name="answer" value="'.$row_answer['id'].'" class="perek" checked><div>'.$row_answer['txt'].'</div><br />';

$result_answer = $conn->query("SELECT * FROM `gt_answer` WHERE `id` = '$id_answer_2'");
$row_answer  = $result_answer ->fetch_assoc();
$str .= '<input type="radio" name="answer" value="'.$row_answer['id'].'" class="perek"><div>'.$row_answer['txt'].'</div><br />';

$result_answer = $conn->query("SELECT * FROM `gt_answer` WHERE `id` = '$id_answer_3'");
$row_answer  = $result_answer ->fetch_assoc();
$str .= '<input type="radio" name="answer" value="'.$row_answer['id'].'" class="perek"><div>'.$row_answer['txt'].'</div><br />';

$result_answer = $conn->query("SELECT * FROM `gt_answer` WHERE `id` = '$id_answer_4'");
$row_answer  = $result_answer ->fetch_assoc();
$str .= '<input type="radio" name="answer" value="'.$row_answer['id'].'" class="perek"><div>'.$row_answer['txt'].'</div><br />';

echo $str;
}

else {
	echo "Поздравляем! Вы правильно ответили на все вопросы!";
}

$conn->close();
?>