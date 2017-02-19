<?php

include "conectSQL.php";

if (isset($_POST['select'])) {

	$sql = "select 'kagent' as t,id, name,rec from kagent 
			union select 'acount' as t,id, name,rec from acount 
			union select 'state' as t,id, name,type from state";

    $stmt = $mysqli->stmt_init();
    if(($stmt->prepare($sql) === FALSE)
               // or ($stmt->bind_param('s', $table) === FALSE)
                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);}
    else{
    	$kagent = "";
    	$state  = "";
    	$acount = "";
    	while ($row = $result->fetch_assoc()) {
    		if ($row['t'] == "kagent") $kagent .="<option value=".$row['id'].">".$row['name']."</option>";
    		if ($row['t'] == "state") $state .="<option value=".$row['id'].">".$row['name']."</option>";
    		if ($row['t'] == "acount") $acount .="<option value=".$row['id'].">".$row['name']."</option>";             
        }       
        // $kagent .="<option>+</option>";
        // $state  .="<option>+</option>";
        // $acount .="<option>+</option>";

        echo $kagent.";".$state.";".$acount;
    }

}


if (isset($_POST['operation'])){

	$operation = $_POST['operation'];	

	$date = $_POST['date'];
	$kagent = $_POST['kagent'];
	$acount = $_POST['acount'];
	$state = $_POST['state'];
	$count = $_POST['count'];
	$type = $_POST['type'];

	$stmt = $mysqli->stmt_init(); 

    if ($operation == "insert"){    	
	          
        if(($stmt->prepare("INSERT INTO operation (date,k_id,s_id,a_id,value,type) VALUES (?,?,?,?,?,?)") === FALSE) 
            or ($stmt->bind_param('siiiii', $date, $kagent,$state,$acount,$count,$type) === FALSE)
            or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
            or ($stmt->close() === FALSE)) {
            die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
            }
        else echo "Добавлено.";
    }

    if ($operation == "update")    {

    	$id = $_POST['id'];

    	if(($stmt->prepare("UPDATE  operation set date=? ,k_id=? , s_id=? , a_id=? , value=?,type =?  WHERE id=? ") === FALSE) 
                    or ($stmt->bind_param('siiiiii', $date, $kagent,$state,$acount,$count,$type,$id) === FALSE)
                    or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
                    or ($stmt->close() === FALSE)) {
                    die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
                }
                else echo "Изменено."; 
    }

    if ($operation == "get"){

  
    	if (isset($_POST['id'])){

		    $sql = "SELECT o.id,date,value,o.type,k.name,s.name,a.name,k.id,s.id,a.id  FROM operation as o
					JOIN kagent as k on o.k_id = k.id
					JOIN state as s on o.s_id = s.id
					JOIN acount as a on o.a_id = a.id
					WHERE o.id=".$_POST['id'];

		    $stmt = $mysqli->stmt_init();
		    if(($stmt->prepare($sql) === FALSE)
		               // or ($stmt->bind_param('s', $table) === FALSE)
		                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
		                or (($result = $stmt->get_result()) === FALSE)
		                or ($stmt->close() === FALSE)) {
		        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
		    }

		    $row = $result->fetch_row(); 

	        echo join(';',$row);

	

		}else{

		    $sql = "SELECT o.id,date,value,o.type,k.name,s.name,a.name,k.id,s.id,a.id  FROM operation as o
					JOIN kagent as k on o.k_id = k.id
					JOIN state as s on o.s_id = s.id
					JOIN acount as a on o.a_id = a.id";

		    $stmt = $mysqli->stmt_init();
		    if(($stmt->prepare($sql) === FALSE)
		               // or ($stmt->bind_param('s', $table) === FALSE)
		                or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
		                or (($result = $stmt->get_result()) === FALSE)
		                or ($stmt->close() === FALSE)) {
		        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
		    }
		    echo "<button name='add' class='bd'><span class='fontawesome-plus'></span></button>";   
		    echo "<table>";
		    echo "<tr><th>Дата</th><th>Значение</th><th>Тип</th><th>Контрагент</th><th>Статья</th><th>Счет</th><th>.</th><th>.</th></tr>";
		    while ($row = $result->fetch_row()) {
		        echo "<tr>";
		        for($i=1; $i<7; $i++){
		            echo "<td>".$row[$i]."</td>";
		        }
		        echo "<td><button name='bbb' class='bd'  value='$row[0]'><span class='fontawesome-pencil'></span></button></td>";
		        echo "<td><button name='ddd' class='bd'  value='$row[0]'><span class='fontawesome-trash'></span></button></td>";
		        echo "</tr>";
		    }
		    echo "</table>";
		}


    }


    if ($operation == "delete"){

    	$id = $_POST['id'];

    	$sql = "DELETE FROM operation WHERE id=".$id;

        if(($stmt->prepare($sql) === FALSE) 
            //or ($stmt->bind_param('s',$id) === FALSE)
            or ($stmt->execute() === FALSE)       // получение буферизированного результата в виде mysqli_result,
            or ($stmt->close() === FALSE)) {
            die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
	    }
	    else echo "Удалено.";  


    }


}






?>