<?php
	include "conectSQL.php";




//=================== функция получения тега table из таблицы =====================//
function gettable($name1,&$mysqli){

	$s = "<tr><th>";

	$s .= "Наименовение</th>";

	$s .= "<th><button name='add' class='bd' onclick='add()'><span class='fontawesome-plus'></span></button></th><th>.</th></tr>";

	$sql = "SELECT id,value FROM content WHERE name='".$name1."'";
	
	echo $sql;

    $stmt = $mysqli->stmt_init();

    if(($stmt->prepare($sql) === FALSE)
                or ($stmt->execute() === FALSE)       
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    }

    echo "<table><thead>".$s."</thead><tbody>";
    while ($row = $result->fetch_row()) {
        echo gettr($row);
    }
    echo "</tbody></table>";
}



// =================  функция получения записи из таблицы  ========================//
//function getrow($id,&$mysqli){	
//
//	$sql = "SELECT * FROM ".$table." WHERE id=".$id;	
//
//    $stmt = $mysqli->stmt_init();
//
//    if(($stmt->prepare($sql) === FALSE)
//                or ($stmt->execute() === FALSE)      
//                or (($result = $stmt->get_result()) === FALSE)
//                or ($stmt->close() === FALSE)) {
//        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
//    }
//
//    return $result->fetch_row();
//}


// ===============  функция получения тега tr из записи ==================//
function gettr(&$row){

	$s = "<tr>";
	$s .= "<td><input type='text'  value='".$row[1]."'></td>";  		        

    $s .= "<td><button name='bbb' class='bd' onclick='update()'  value='$row[0]'><span class='fontawesome-pencil'></span></button></td>
    <td><button name='ddd' class='bd' onclick='del()' value='$row[0]'><span class='fontawesome-trash'></span></button></td></tr>";

    return $s;

}

//=======================  фуникция удаления записи  из таблицы =================//
function delete($id,$table,&$mysqli){

	$sql = "DELETE FROM ".$table." WHERE id=".$id;

	$stmt = $mysqli->stmt_init();

    if(($stmt->prepare($sql) === FALSE) 
        //or ($stmt->bind_param('s',$id) === FALSE)
        or ($stmt->execute() === FALSE)       
        or ($stmt->close() === FALSE)) {
        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    }
    else echo "Удалено";  
}


function insert($table,&$mysqli){

	$date = $_POST['date'];
	$kagent = $_POST['kagent'];
	$acount = $_POST['acount'];
	$state = $_POST['state'];
	$count = $_POST['count'];

	$stmt = $mysqli->stmt_init(); 

    if(($stmt->prepare("INSERT INTO operation (date,k_id,s_id,a_id,value) VALUES (?,?,?,?,?)") === FALSE) 
        or ($stmt->bind_param('siiiii', $date, $kagent,$state,$acount,$count) === FALSE)
        or ($stmt->execute() === FALSE)      
        or ($stmt->close() === FALSE)) {
        	die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
        	return false;
        }
    else 
    	return true;   

}

function update($id,$table,&$mysqli){

	$date = $_POST['date'];
	$kagent = $_POST['kagent'];
	$acount = $_POST['acount'];
	$state = $_POST['state'];
	$count = $_POST['count'];

	$stmt = $mysqli->stmt_init(); 

	if(($stmt->prepare("UPDATE  operation set date=? ,k_id=? , s_id=? , a_id=? , value=?  WHERE id=? ") === FALSE) 
        or ($stmt->bind_param('siiiii', $date, $kagent,$state,$acount,$count,$id) === FALSE)
        or ($stmt->execute() === FALSE)      
        or ($stmt->close() === FALSE)) {
        	die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    		return false;
    }
    else 
    	return true;
}
if (isset($_POST['operation'])){
	
	$operation = $_POST['operation'];
	$name = $_POST['name'];
	switch ($operation){
		case "get": gettable($name,$mysqli); break;
		case "del": delete($mysqli); break;
		case "add": insert($mysqli); break;
		
	}
	
	
	exit;
	
}




?>


<!DOCTYPE html>
<html>
    <head>
        <title>администратор</title>
        <link rel="shortcut icon" href="image/logo_100_100.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="make_site.css">
        <meta charset="utf-8">    
    </head>
    <body>
    	<div class="logo">
<!--			<img src="image/logo.jpg">-->
			<div class ="log1">
				<span class="span">Администрирование</span>
			</div>
			
			<div class="log2">
				<p></p>
			</div>
    	</div>
    	
    	<div class="menu">
			<nav>
				<ul class = "topmenu">
                    <li id="new_item" class="fontawesome-reorder"></li>
<!--                    <li id="main" class="fontawesome-home"></li>-->
					<li><span>разработка сайтов</span></li>
<!--
					<li><span>раскрутка инстаграмм</span></li>
					<li><span>реклама в интеренете</span></li>
					<li><span>привлечение клиентов</span></li>
					<li><span>маркетинг</span></li>
					<li><span>брендинг</span></li>
					<li><span>контакты</span></li>
-->
<!--
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
-->
						</li>
					
					
				</ul>
			</nav>
    	</div>
    	
    	<div class="conteiner">
			
			<div id = "header" class="invisible">
				<form method="post">					 
				<input type="text" name="title" placeholder="title">
				<input type="text" name="tel" placeholder="tel">
				<input type="text" name="logo" placeholder="logo">
				<input type="submit" name="header" value="Сохранить">					
				</form>
			</div>
			<div id = "topmenu" class="invisible">
				 
			</div>
			
			
			
			
			
			
    	</div>



    	<div class="left_menu visib" id="visib">
			<ul class="leftmenu">
				<li onclick="header()">Заголовки</li>
				<li onclick="getTable()">Горизонтальное меню</li>
				<li>Боковое меню</li>
				<li>Контент</li>
			</ul>
			
    	</div>
	
   <script>
	   
	   
	   
	
	  function header(){
		  
		  document.getElementById('header').className ="";
		  
	  }
	
	
	   
	function getXmlHttp(){		// Что то ajax-совское. 
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
	   var httpreq = getXmlHttp();
	   
	   
	   
	function getTable(){
		

	var table = document.getElementById('topmenu'),
		body = "operation=get&name=topmenu";
		
		
		table.className = "";

	execute(body,function(){

 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
 				table.innerHTML = httpreq.responseText;          
 			}

 		} 	

	});

}
	   
	   function execute(body,callback){					//======= ajax ========//

	httpreq.open('post','make_site_admin.php',true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
 	httpreq.onreadystatechange = callback;
 	httpreq.send(body);

}
	   
	 	function add(){
			var tbody = document.getElementsByTagName('tbody')[0];
			var tr = document.createElement("tr");
			tr.innerHTML = "<td><input type='text'></td><td><button name='bbb' class='bd' onclick='inset()'><span class='fontawesome-pencil'></span></button></td><td><button name='ddd' class='bd' onclick='del()'><span class='fontawesome-trash'></span></button></td>";
			tbody.appendChild(tr);
			
		}
	   
	    function update(){
			var id = this.value; 
			execute("operation=get&id="+id,function(){

 				if (httpreq.readyState == 4) {
 					if(httpreq.status == 200) {
		 				var s = httpreq.responseText; 
 					}
 				} 	 

 			})
			
		}
	    function del(){
			var id = this.value; 					
			execute("operation=delete&id="+id,function(){

 				if (httpreq.readyState == 4) {
 					if(httpreq.status == 200) {
		 				var s = httpreq.responseText;   
		 				if (s=="Удалено"){       
		 					getTable();
		 				}	
 					}
 				} 	 				

 			});
		}
	   
	</script>
    </body>
</html>