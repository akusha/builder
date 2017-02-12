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
            $pass = $_POST["pass"];
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
        <link rel="stylesheet" href="check_in.css">
        <meta charset="utf-8">    
    </head>
    <body>
        <div id="login">
        <form method="POST">
            <fieldset class="clearfix">
                <p><span class="fontawesome-user"></span><input type="text" name="log" value="Логин" onBlur="if(this.value == '') this.value = 'Логин'" onFocus="if(this.value == 'Логин') this.value = ''" required></p> 
                <p><span class="fontawesome-lock"></span><input type="password" name="pass"  value="Пароль" onBlur="if(this.value == '') this.value = 'Пароль'" onFocus="if(this.value == 'Пароль') this.value = ''" required></p> 
                <p><span class="fontawesome-lock"></span><input type="password" value="Повторить пароль" onBlur="if(this.value == '') this.value = 'Повторить пароль'" onFocus="if(this.value == 'Повторить пароль') this.value = ''" required></p>
                <p><span class="fontawesome-user"></span><input type="text" name="nic" value="Ваш ник" onBlur="if(this.value == '') this.value = 'Ваш ник'" onFocus="if(this.value == 'Ваш ник') this.value = ''" required></p>
                <p><span class="fontawesome-envelope"></span><input type="mail" name="mail" value="Эл.адрес" onBlur="if(this.value == '') this.value = 'Эл.адрес'" onFocus="if(this.value == 'Эл.адрес') this.value = ''" required></p>
                <p><input type="submit" value="РЕГИСТРАЦИЯ"></p>
            </fieldset>
        </form>
        <p>&nbsp;&nbsp;<a href="login.php">Войти в аккаунт</a><span class="fontawesome-arrow-right"></span></p>
    </div>
        
<script>
    
    function getXmlHttp(){
		var xmlhttp;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
    }
    
	var ajax = getXmlHttp();
    
    var submit = document.getElementById("submit");
    
	
	document.getElementById("log").oninput = change;
        
        function change(event){
        
        var value = this.value;
            
        var body = "ajax=ajax&log=" + value;
        
        sendData(body);        
        
    };
    
    
    function sendData(body){    	
		ajax.open('POST', "check_in.php", true);
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4) {
				if(ajax.status == 200) {
					                    
					var result = ajax.responseText;
                    
                    if (result==0)                         
                        submit.classList.remove("invisible");
                    else
                        submit.classList.add("invisible");
					
				}
			}
		}
		ajax.send(body);
	}

    
        
</script>
        
        
        
    </body>
</html>
