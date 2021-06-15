<?php
session_start();
if(isset($_SESSION['name'])){
        $text = $_POST['text'];
        $textmsg = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>\n";
        file_put_contents("log.html", $textmsg, FILE_APPEND | LOCK_EX);
    }
?>