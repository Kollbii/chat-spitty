<?php
session_start();
if($_POST['delete'] == true){
    $text = file_get_contents("log.html");
    $text_new = substr($text, strpos($text, "\n") + 1);
    file_put_contents("log.html", $text_new);
}
?>