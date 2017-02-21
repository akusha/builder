<?php  
    if(!isset($_COOKIE['log'])) {               // если не был выполнен вход то перенаправляем на страницу входа.
        header("Location: login.php");
        exit; 
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Личняя бухгалтерия</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link rel="stylesheet" href="cabinet.css">        
        <link rel="stylesheet" href="accaunting.css">        
    </head>

    <body>        
    <div id="fon" class="fon fonnone"></div>
   
        <header class="header">
            <a href="http://localhost"><img src="image/logo_100_100.png" class="logo"/></a>    
            <nav>
            <ul class = "topmenu">               
               <!--  <li><a href="accaunting.php">Бухгалтерия</a></li> -->
                <li><a href="cabinet.php">Кабинет</a></li>

            </ul>
        </nav>       
        </header>


        <div class="forms invisible" id="form_op">
            <form method="post">                
				<label for="date">Дата</label><input type="date" name="date" autofocus>   
                <label for="state">Статья</label>	 <select name="state"></select> 
                <label for="state">Счет</label>		 <select name="acount"></select>
                <label for="state">Контрагент</label><select name="kagent"></select>
               	<label for="count">Сумма</label><input type="number" name="count">
               	<label for="type">Вид</label><select name="type"> <option value="1">приход</option> <option value="-1">расход</option></select>
                <input type="hidden" name="id">
                <input type="hidden" name="operation">
                <input type="button" value="сохранить" id="insert">
                <input type="button" value="закрыть" id="close">
            </form>
        </div>


        <div class='login'><a href='cabinet.php'><?php echo $_COOKIE['log'];  ?></a>/
			<a href="index.php" onclick="dKuk()"> выход </a>
        </div>

        <div class="container">
            <div class="leftcol">

				<ul class="leftmenu">
					<li id = "op">Операции</li>
					<li id = "st">Статьи</li>
					<li id = "ac">Счета</li>
					<li id = "ka">Контрагенты</li>
				</ul>
                
            </div>
            <div class="rightcol" > 
            	<h2></h2>
				<div id="table"> 

				</div>                
            </div>
        </div>
        <footer>
        <div>
            <a href="mailto:akusha260@gmail.com?subject=вопрос к администратору">&#9993 вопрос к админ.</a>
            Магомедов Магомед Кадиевич.
        </div>
			
        </footer>

	<script src="accaunting.js"/></script>
      
    </body>
</html>