<?php
session_start();

if(isset($_POST['enter'])){
    if($_POST['name'] != "" && $_POST['passwd'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
        $pass_hash = hash_hmac("md5", $_POST['passwd'], "cllFlag{n0T_S0_s3cr3T_k3y5_1n_crypT0}", false);
        $sql_check_in_db = "SELECT user, password_hash FROM `users` WHERE users.user = '{$_POST['name']}'";
        $con = getCon();
        $result = $con->query($sql_check_in_db);
        $row = $result->fetch_array();
        if ($row){
            if ($row['password_hash'] == $pass_hash){
                header("Location: ./");
            }else{
                header("Location: index.php?logout=true");
            }
        } else {
            $sql_insert_in_db = "INSERT INTO `users` (`id`, `user`, `password_hash`) VALUES (NULL, '{$_POST['name']}', '{$pass_hash}');";
            $con->query($sql_insert_in_db);
            header("Location: ./");
            echo '<span class="succes"> First login! User added in DB</span>';
        }
    }else{
        echo '<span class="error"> Type your name and password correctly!</span>';
        header("Location: ./");
    }
}

function getCon(){
    $con = new mysqli('localhost', 'root','','kollbek');
    if($con->connect_errno != 0){return null;}
    $con->query("SET NAMES UTF-8");
    return $con;
}
?>