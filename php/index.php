<?php 
$conn = new mysqli("localhost",  "логин", "пароль", "база");  
$conn ->set_charset("utf8");
if ($conn->connect_error) {die("Ошибка: невозможно подключиться: " . $conn->connect_error);}

$sear = preg_replace('/[^a-zA-Zа-яА-Я0-9]/ui', '',  $_POST['sear']);
$otv = "";

$result = $conn->query("SELECT * FROM `cms_content` WHERE  `title` LIKE '%$sear%' ORDER BY `id` DESC LIMIT 10");
while ($row = $result->fetch_assoc()) {
$otv = $otv . "<a class='position' href='http://сайт/".$row["seolink"].".html'>" .$row["title"]."</a>";
}

if ($otv!="") {
	echo $otv;
}
else {
	echo "no";
}
?>