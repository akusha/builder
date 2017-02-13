<?php    
if (isset($_COOKIE['log'])){
    
      header("Location: cabinet.php");
      exit;
    
}
  

    if (isset($_POST['log'])){
            $log = $_POST["log"];
            $pass = md5($_POST["pass"]);
            include "conectSQL.php";
            $stmt = $mysqli->stmt_init();
            if(($stmt->prepare("SELECT * FROM users WHERE log=? AND pass=?") === FALSE)
                or ($stmt->bind_param('ss', $log, $pass) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
                                                die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
                                                }
            if($result->num_rows==0) echo "Логин или пароль неверный.";
            else {
                    $row = $result->fetch_assoc();                   
                    setcookie("log", $row["log"]);
                    header("Location: cabinet.php");
                    exit;
            }            
            $result->close();
            $mysqli->close();
    }
        ?>    
<!DOCTYPE html>
<html>
    <head>
        <title>вход</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="login.css">
        <meta charset="utf-8">    
    </head>
    <body>
    <div id="login">
        <form method="POST">
            <fieldset class="clearfix">
                <p><span class="fontawesome-user"></span><input type="text" name="log" value="Логин" onBlur="if(this.value == '') this.value = 'Логин'" onFocus="if(this.value == 'Логин') this.value = ''" required></p> 
                <p><span class="fontawesome-lock"></span><input type="password" name="pass"  value="Пароль" onBlur="if(this.value == '') this.value = 'Пароль'" onFocus="if(this.value == 'Пароль') this.value = ''" required></p> 
                <p><input type="submit" value="ВОЙТИ"></p>
            </fieldset>
        </form>
        <p>Нет аккаунта? &nbsp;&nbsp;<a href="check_in.php">Регистрация</a><span class="fontawesome-arrow-right"></span></p>
    </div>
</body>
</html>
