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
        <!-- <link rel="stylesheet" href="cabinet.css">         -->
        <link rel="stylesheet" href="accaunting.css">        
    </head>

    <body>        
    <div id="fon" class="fon fonnone"></div>
   
        


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


<!--         <div class='login'><a href='cabinet.php'><?php echo $_COOKIE['log'];  ?></a>/
			<a href="index.php" onclick="dKuk()"> выход </a>
        </div> -->

		<div class="logo">
			<div class ="log1">
				<span class="span">hedbed.ru</span>
			</div>
			
			<div class="log2">
				<p>тел. 8(965)345-45-45</p>
			</div>
    	</div>

		<div class="menu">
			<nav>
				<ul class = "topmenu">
                    <li id="new_item" class="fontawesome-reorder"></li>
                    <li id="main" class="fontawesome-home"></li>
					<li id="other" class="fontawesome-caret-down"></li>
					
<!--
					<li>Наши проекты 
						<ul id="tables" class = "submenu">
							<li>Строительная фирма</li>
							<li>Рекламный сайт</li>
							<li>Финансовый учет</li>
						</ul>
					</li>
-->
					<li><span>разработка сайтов</span></li>
					<li><span>раскрутка инстаграмм</span></li>
					<li><span>реклама в интеренете</span></li>
					<li><span>привлечение клиентов</span></li>
					<li><span>маркетинг</span></li>
					<li><span>брендинг</span></li>
					<li><span>контакты</span></li>
					<li><span><a href='cabinet.php'><?php echo $_COOKIE['log'];  ?></a>/
								<a href="index.php" onclick="dKuk()"> выход </a></span></li>
					
					
				</ul>
			</nav>
    	</div>


    

            <div class="left_menu visib" id="visib">

				<ul class="leftmenu">
					<li id = "op">Операции</li>
					<li id = "st">Статьи</li>
					<li id = "ac">Счета</li>
					<li id = "ka">Контрагенты</li>
				</ul>
                
            </div>

            <div class="conteiner">
            	<h2></h2>
				<div id="table"> 

				</div>                
            </div>

        


	<script src="accaunting.js"/></script>
      
    </body>
</html>