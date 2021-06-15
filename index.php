<?php
    session_start();

    if(isset($_GET['logout'])){
        $logoutmsg = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['name'] ."</b> apparently don't want to hit more anyone.</span><br></div>\n";
        file_put_contents("log.html", $logoutmsg, FILE_APPEND | LOCK_EX);

        session_destroy();
        header("Location: ./");
        echo '<span class="error"> Password does not match user!</span>';
    }

    if(isset($_POST['enter'])){
        if($_POST['name'] != "" && $_POST['passwd'] != ""){
            $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
            $pass_hash = hash_hmac("md5", $_POST['passwd'], "cllFlag{n0T_S0_s3cr3T_k3y5_1n_crypT0}", false);
            
            $sql_check_in_db = "SELECT users, password_hashes FROM `users` WHERE users.users = '{$_POST['name']}'";

            $con = getCon();

            $result = $con->query($sql_check_in_db);
            // var_dump($result);
            $row = $result->fetch_array();
            // var_dump($row);
            if ($row){
                if ($row['password_hashes'] == $pass_hash){
                    echo '<span class="succes"> Login succes!</span>';
                }else{
                    echo '<span class="error"> Password does not match user!</span>';
                    header("Location: index.php?logout=true");
                }
            } else {
                $sql_insert_in_db = "INSERT INTO `users` (`id`, `users`, `password_hashes`) VALUES (NULL, '{$_POST['name']}', '{$pass_hash}');";
                $con->query($sql_insert_in_db);
                echo '<span class="succes"> First login! User added in DB</span>';
            }


        }else{
            echo '<span class="error"> Type your name and password correctly!</span>';
        }
    }

    function getCon(){
        $con = new mysqli('localhost', 'root','','kollbek');
        if($con->connect_errno != 0){return null;}
        $con->query("SET NAMES UTF-8");
        return $con;
    }

    function loginForm(){
        echo 
        '<div id="loginform">
            <p>Type name and password to join spitty-chat!</p>
            <form action="index.php" method="POST">
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
            // while(!$pass){
            //     $pass = loginForm();
            // };
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