<?php
session_start();
if(isset($_SESSION['name'])){
    $command = $_POST['command'];
    // TO DO SWITCH COMMAND MESSAGE OUTPUT
    if ($command == '$hit'){
        $textmsg = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> Uses ".stripslashes(htmlspecialchars($command))." command! <img src='https://media.giphy.com/media/HmgnQQjEMbMz0oLpqn/giphy.gif'><br></div>\n";
        file_put_contents("log.html", $textmsg, FILE_APPEND | LOCK_EX);
    }
}
?>