<?php
$mysqli = @new mysqli('localhost', 'root', '0000', 'feedback_form');
if ($mysqli) {
    echo 'MySQL was connected';
}else{
    echo 'MySQL was not connected';
}
$mysqli->close();
?>
