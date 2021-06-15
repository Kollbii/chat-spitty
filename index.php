<?php
session_start();

if(isset($_GET['logout'])){
    $logoutmsg = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> apparently don't want to hit more anyone.</span><br></div>\n";
    file_put_contents("log.html", $logoutmsg, FILE_APPEND | LOCK_EX);

    session_destroy();
    header("Location: ./");
    echo '<span class="error"> Password does not match user!</span>';
}

function loginForm(){
    echo 
    '<div id="loginform">
        <p>Type name and password to join spitty-chat!</p>
        <form action="login.php" method="POST">
            <label for="name">Name </label>
            <input type="text" name="name" id="name"/>
            <label for="passwd">Password </label>
            <input type="password" name="passwd" id="passwd"/>
            <input type="submit" name="enter" id="enter" value="Enter"/>
        </form> 
    </div>';
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "utf-8">
    <title> Spitty Chat </title>
    <meta name="description" content="spityty tityti">
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
        if(!isset($_SESSION['name'])){
            $pass = loginForm();
        } else {
    ?>
    <div id="wrapper">
        <div id="menu">
            <p class="start">Wana hit someone <b><?php echo $_SESSION['name']; ?></b>?</p>
            <p class="logout"><a id="exit" href="#">Exit</a></p>
        </div>

        <div id="chatbox">
            <?php
                if(file_exists("log.html") && filesize("log.html") > 0){
                    $contents = file_get_contents("log.html");         
                    echo $contents;
                }
            ?>
        </div>

        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg"/>
            <input name="sendmsg" type="submit" id="sendmsg" value="Send"/>
        </form>
    </div>
    <script type="text/javascript">window.onload = function (){document.getElementById("usermsg").focus();}</script>
    <script tpye="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/js/sendmsg-jQuery.js"></script>
</body>
</html>
<?php
    }
?>