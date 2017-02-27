<?php  

	include "conectSQL.php";

	$stmt = $mysqli->stmt_init();
	if(($stmt->prepare("SELECT * FROM content") === FALSE)
		or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
		or (($result = $stmt->get_result()) === FALSE)
		or ($stmt->close() === FALSE)) {
		die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
		}
	else {
		
		while ($row = $result->fetch_assoc()){
			switch ($row['name']){

				case 'title': $title = $row['value']; break;
				case 'tel': $tel = $row['value']; break;
				case 'log': $log = $row['value']; break;
				case 'leftmenu': $leftmenu[] = $row['value']; 
								$content[] = $row['href'];
					break;
				case 'topmenu': $topmenu[] = $row['value']; 
					break;
				

			} 
		}
	}



?>



<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="make_site.css">
        <meta charset="utf-8">    
    </head>
    <body>
    	<div class="logo">
<!--			<img src="image/logo.jpg">-->
			<div class ="log1">
				<span class="span"><?php echo $log; ?></span>
			</div>
			
			<div class="log2">
				<p>тел. <?php echo $content[0]; ?></p>
			</div>
    	</div>
    	
    	<div class="menu">
			<nav>
				<ul class = "topmenu">
                    <li id="new_item" class="fontawesome-reorder"></li>
<!--                    <li id="main" class="fontawesome-home"></li>-->
					<?php 
					 	for ($i=0;$i<count($topmenu);$i++){
							echo "<li><span>".$topmenu[$i]."</span></li>";
						}
					?>
					<li id="other" class="fontawesome-caret-down">
							<ul id="tables" class = "submenu">
								<li><span>разработка сайтов</span></li>
								<li><span>раскрутка инстаграмм</span></li>
								<li><span>реклама в интеренете</span></li>
								<li><span>привлечение клиентов</span></li>
								<li><span>маркетинг</span></li>
								<li><span>брендинг</span></li>
								<li><span>контакты</span></li>
							</ul>
						</li>
					
					
				</ul>
			</nav>
    	</div>
    	
    	<div class="conteiner">
			<h2 id="showScroll">  </h2>
            <p id="widhei"> 
             </p>
    	</div>



    	<div class="left_menu visib" id="visib">
			<ul class="leftmenu">
			<?php 
				for ($i=0;$i<count($leftmenu);$i++){
					echo "<li class='item' value2='".$content[$i]."'>".$leftmenu[$i]."</li>";
				}
			?>
			</ul>
    	</div>


        
       <script src="make_site.js"/></script>
    </body>
</html>