<?php
$mysqli = @new mysqli('localhost', 'root', '0000', 'feedback_form');
//if ($mysqli) {
//    echo 'MySQL was connected';
//}else{
//    echo 'MySQL was not connected';
//}

//создание таблицы
$sql = "CREATE TABLE IF NOT EXISTS `feedbackValue` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `phone` int NOT NULL,
  `coll` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `specialist` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `date` DATE NOT NULL,
  `time` TIME NOT NULL,
  `creation_date` TIMESTAMP
)";

if ($mysqli->query($sql) == true){
    echo "yes";
}else{
    echo "no";
}

$mysqli->close();
?>
