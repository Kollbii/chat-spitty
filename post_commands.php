<?php
session_start();
if(isset($_SESSION['name'])){
    $command = $_POST['command'];
    // TO DO SWITCH COMMAND MESSAGE OUTPUT

    switch($command){
        case '$besos':
            $textmsg = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> Uses ".stripslashes(htmlspecialchars($command))." command!</div>
			<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> <img src='https://media.giphy.com/media/r4GoPRwcJU9Ak/giphy.gif'><br></div>\n";
            file_put_contents("log.html", $textmsg, FILE_APPEND | LOCK_EX);
            break;
        case '$hit':
            $textmsg = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> Uses ".stripslashes(htmlspecialchars($command))." command!</div>
            		<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION['name']."</b> <img src='https://media.giphy.com/media/HmgnQQjEMbMz0oLpqn/giphy.gif'><br></div>\n";
	    file_put_contents("log.html", $textmsg, FILE_APPEND | LOCK_EX);
            break;
    }
}
?>