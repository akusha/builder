<?php

include "conectSQL.php";


// =============== Загрузка списков для формы из таблиц acount,kagent,state ====================//
if (isset($_POST['select'])) {

	$sql = "select 'kagent' as t,id, name,rec from kagent 
			union select 'acount' as t,id, name,rec from acount 
			union select 'state' as t,id, name,type from state";

    $stmt = $mysqli->stmt_init();
    if(($stmt->prepare($sql) === FALSE)
               // or ($stmt->bind_param('s', $table) === FALSE)
                or ($stmt->execute() === FALSE)       
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

}	//=========== Конец заугрзки списков ==================================//



//======================== Работа с таблицей operation: загрузка, добавление, изменени и удаление записей ==============//

if (isset($_POST['operation'])){

	$operation = $_POST['operation'];	

	$date = $_POST['date'];
	$kagent = $_POST['kagent'];
	$acount = $_POST['acount'];
	$state = $_POST['state'];
	$count = $_POST['count'];

	$stmt = $mysqli->stmt_init(); 

	//============ INSERT ===========//
    if ($operation == "insert"){    	
	          
        if(($stmt->prepare("INSERT INTO operation (date,k_id,s_id,a_id,value) VALUES (?,?,?,?,?)") === FALSE) 
            or ($stmt->bind_param('siiiii', $date, $kagent,$state,$acount,$count) === FALSE)
            or ($stmt->execute() === FALSE)      
            or ($stmt->close() === FALSE)) {
            die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
            }
        else {
        	$id = $mysqli->insert_id;

        	$sql = "SELECT o.id,date,value,k.name,s.name,a.name,k.id,s.id,a.id  FROM operation as o
					JOIN kagent as k on o.k_id = k.id
					JOIN state as s on o.s_id = s.id
					JOIN acount as a on o.a_id = a.id
					WHERE o.id=".$id;

		    $stmt = $mysqli->stmt_init();
		    if(($stmt->prepare($sql) === FALSE)
		               // or ($stmt->bind_param('s', $table) === FALSE)
		                or ($stmt->execute() === FALSE)      
		                or (($result = $stmt->get_result()) === FALSE)
		                or ($stmt->close() === FALSE)) {
		        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
		    }

		    $row = $result->fetch_row();

		    $tr = "<tr>";
		    
	        for($i=1; $i<7; $i++){
	            $tr .= "<td>".$row[$i]."</td>";
	        }		        
	        $tr .= "<td><button name='bbb' class='bd'  value='$row[0]'><span class='fontawesome-pencil'></span></button></td>
	        <td><button name='ddd' class='bd'  value='$row[0]'><span class='fontawesome-trash'></span></button></td></tr>";

	        echo $id.";".$tr;

        }
    }

    //========== UPDATE =============//
    if ($operation == "update")    {

    	$id = $_POST['id'];

    	if(($stmt->prepare("UPDATE  operation set date=? ,k_id=? , s_id=? , a_id=? , value=?  WHERE id=? ") === FALSE) 
                    or ($stmt->bind_param('siiiii', $date, $kagent,$state,$acount,$count,$id) === FALSE)
                    or ($stmt->execute() === FALSE)      
                    or ($stmt->close() === FALSE)) {
                    die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
                }
                else {

                	$sql = "SELECT o.id,date,value,k.name,s.name,a.name,k.id,s.id,a.id  FROM operation as o
					JOIN kagent as k on o.k_id = k.id
					JOIN state as s on o.s_id = s.id
					JOIN acount as a on o.a_id = a.id
					WHERE o.id=".$id;

				    $stmt = $mysqli->stmt_init();
				    if(($stmt->prepare($sql) === FALSE)
				               // or ($stmt->bind_param('s', $table) === FALSE)
				                or ($stmt->execute() === FALSE)      
				                or (($result = $stmt->get_result()) === FALSE)
				                or ($stmt->close() === FALSE)) {
				        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
				    }

				    $row = $result->fetch_row();

				    $tr = "<tr>";
				    
			        for($i=1; $i<6; $i++){
			            $tr .= "<td>".$row[$i]."</td>";
			        }		        
			        $tr .= "<td><button name='bbb' class='bd'  value='$row[0]'><span class='fontawesome-pencil'></span></button></td>
			        <td><button name='ddd' class='bd'  value='$row[0]'><span class='fontawesome-trash'></span></button></td></tr>";

			        echo $id.";".$tr;

                } 
    }

    //============ GET ============//
    if ($operation == "get"){

  
    	if (isset($_POST['id'])){

		    $sql = "SELECT o.id,date,value,k.name,s.name,a.name,k.id,s.id,a.id  FROM operation as o
					JOIN kagent as k on o.k_id = k.id
					JOIN state as s on o.s_id = s.id
					JOIN acount as a on o.a_id = a.id
					WHERE o.id=".$_POST['id'];

		    $stmt = $mysqli->stmt_init();
		    if(($stmt->prepare($sql) === FALSE)
		               // or ($stmt->bind_param('s', $table) === FALSE)
		                or ($stmt->execute() === FALSE)      
		                or (($result = $stmt->get_result()) === FALSE)
		                or ($stmt->close() === FALSE)) {
		        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
		    }

		    $row = $result->fetch_row(); 

	        echo join(';',$row);

	

		}else{

		    $sql = "SELECT o.id,date,value,k.name,s.name,a.name,k.id,s.id,a.id  FROM operation as o
					JOIN kagent as k on o.k_id = k.id
					JOIN state as s on o.s_id = s.id
					JOIN acount as a on o.a_id = a.id";

		    $stmt = $mysqli->stmt_init();
		    if(($stmt->prepare($sql) === FALSE)
		               // or ($stmt->bind_param('s', $table) === FALSE)
		                or ($stmt->execute() === FALSE)       
		                or (($result = $stmt->get_result()) === FALSE)
		                or ($stmt->close() === FALSE)) {
		        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
		    }
		    // echo "<button name='add' class='bd'><span class='fontawesome-plus'></span></button>";   
		    echo "<table><thead>";
		    echo "<tr><th>Дата</th><th>Значение</th><th>Контрагент</th><th>Статья</th><th>Счет</th><th><button name='add' class='bd'><span class='fontawesome-plus'></span></button></th><th>.</th></tr></thead><tbody>";
		    while ($row = $result->fetch_row()) {
		        echo "<tr>";
		        for($i=1; $i<6; $i++){
		            echo "<td>".$row[$i]."</td>";
		        }		        
		        echo "<td><button name='bbb' class='bd'  value='$row[0]'><span class='fontawesome-pencil'></span></button></td>";
		        echo "<td><button name='ddd' class='bd'  value='$row[0]'><span class='fontawesome-trash'></span></button></td>";
		        echo "</tr>";
		    }
		    echo "</tbody></table>";
		}

    }

    // ======================= DELETE ================== //
    if ($operation == "delete"){

    	$id = $_POST['id'];

    	$sql = "DELETE FROM operation WHERE id=".$id;

        if(($stmt->prepare($sql) === FALSE) 
            //or ($stmt->bind_param('s',$id) === FALSE)
            or ($stmt->execute() === FALSE)       
            or ($stmt->close() === FALSE)) {
            die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
	    }
	    else echo "Удалено";  


    }


}	//======================== Конец работы с таблицей operation ==============//


if (isset($_POST['table'])){

	$table = $_POST['table'];

	$stmt = $mysqli->stmt_init(); 

	$sql = "SELECT * FROM ".$table;
	echo $sql;

	if(($stmt->prepare($sql) === FALSE)
		               // or ($stmt->bind_param('s', $table) === FALSE)
		                or ($stmt->execute() === FALSE)       
		                or (($result = $stmt->get_result()) === FALSE)
		                or ($stmt->close() === FALSE)) {
		        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
		    }

    echo "<table>";
    echo "<tr><th>Наименовение</th><th>Значение</th><th><button name='add' class='bd'><span class='fontawesome-plus'></span></button></th><th>.</th></tr>";
    while ($row = $result->fetch_row()) {
        echo "<tr>";
        for($i=1; $i<3; $i++){
            echo "<td>".$row[$i]."</td>";
        }		        
        echo "<td><button name='bbb' class='bd'  value='$row[0]'><span class='fontawesome-pencil'></span></button></td>";
        echo "<td><button name='ddd' class='bd'  value='$row[0]'><span class='fontawesome-trash'></span></button></td>";
        echo "</tr>";
    }
    echo "</table>";


}






?>