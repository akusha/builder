<?php  

if (isset($_COOKIE['log'])){
    
      header("Location: cabinet.php");
      exit;
    
}

    include "conectSQL.php";

    if(isset($_POST['ajax'])){
        
        $log = $_POST['log'];
        
         $stmt = $mysqli->stmt_init();
            if(($stmt->prepare("SELECT * FROM users WHERE log=?") === FALSE)
                or ($stmt->bind_param('s', $log) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
                                                die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
                                                }
            if($result->num_rows==0) echo "0";
            else echo "1";
            $result->close();
            $mysqli->close();  
        exit;
        
    }

    if (isset($_POST["log"])){
        
            $log = $_POST["log"];
            $pass = md5($_POST["pass"]);
            $nic = $_POST["nic"];
            $mail = $_POST["mail"];            
            $stmt = $mysqli->stmt_init();       
            if(($stmt->prepare("INSERT INTO users (log,pass,nic,mail) VALUES (?,?,?,?)") === FALSE) 
                or ($stmt->bind_param('ssss', $log, $pass,$nic,$mail) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or ($stmt->close() === FALSE)) {
                                                die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
            }
            else{
                setcookie("log", $log);
                    header("Location: cabinet.php");
                    exit;
            }
            $mysqli->close();
    }
           
        ?>    

<!DOCTYPE html>
<html>
    <head>
        <title>регистрация</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="check_in.css">
        <meta charset="utf-8">    
    </head>
    <body>
        <div id="login">
            <form method="POST">
                <fieldset class="clearfix">
                    <span class="fontawesome-user"></span>
					<input type="text" name="log" placeholder="логин" oninput="verifyLog()">
					<span class="fontawesome-lock"></span>
					<input type="password" name="pass" placeholder="пароль" oninput="verifyPass()"> 
                    <span class="fontawesome-lock"></span>
					<input type="password" name="pass" placeholder="повторить пароль" oninput="verifyPass1()" disabled>
                    <span class="fontawesome-user"></span>
					<input type="text" name="nic" placeholder="Ваш ник" oninput="verifyNic()">
                    <span class="fontawesome-envelope"></span>
					<input type="email" name="mail" placeholder="адресс эл. почты" oninput="verifyMail()">
					
                    <p><input type="submit" name="submit" value="РЕГИСТРАЦИЯ" disabled ></p>
                </fieldset>
            </form>
            <p>&nbsp;&nbsp;<a href="login.php">Войти в аккаунт</a><span class="fontawesome-arrow-right"></span></p>
        </div>
        <script src="check_in.js"/></script>
    </body>
</html>
