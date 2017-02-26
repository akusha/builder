<?php

include "conectSQL.php";




//=================== функция получения тега table из таблицы =====================//
function gettable($table,&$mysqli){

	$s = "<tr><th>";

	if ($table === "operation") $s .= "Дата</th><th>Значение</th><th>Контрагент</th><th>Статья</th><th>Счет";

	else $s .= "Наименовение</th><th>Значение";

	$s .= "</th><th><button name='add' class='bd'><span class='fontawesome-plus'></span></button></th><th>.</th></tr>";

	$sql = "SELECT * FROM ".$table;

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
function getrow($id,$table,&$mysqli){	

	$sql = "SELECT * FROM ".$table." WHERE id=".$id;	

    $stmt = $mysqli->stmt_init();

    if(($stmt->prepare($sql) === FALSE)
                or ($stmt->execute() === FALSE)      
                or (($result = $stmt->get_result()) === FALSE)
                or ($stmt->close() === FALSE)) {
        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    }

    return $result->fetch_row();
}


// ===============  функция получения тега tr из записи ==================//
function gettr(&$row){

	$s = "<tr>";
	if(count($row)>3) $n = 6; else $n = 3;
		    
    for($i=1; $i<$n; $i++) {  $s .= "<td>".$row[$i]."</td>";  }		        

    $s .= "<td><button name='bbb' class='bd'  value='$row[0]'><span class='fontawesome-pencil'></span></button></td>
    <td><button name='ddd' class='bd'  value='$row[0]'><span class='fontawesome-trash'></span></button></td></tr>";

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



//======================== Работа с таблицей operation: загрузка, добавление, изменение и удаление записей ==============//

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

		    $row =getrow($id,"operation",$mysqli); 

		    $tr = gettr($row);

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

				    $row = getrow($id,"operation_view",$mysqli);

				    $tr = gettr($row);

			        echo $id.";".$tr;
                } 
    }

    //============ GET ============//
    if ($operation == "get"){

  
    	if (isset($_POST['id'])){
		    
		    $id = $_POST['id'];

		    $row =getrow($id,"operation_view",$mysqli); 

	        echo join(';',$row);
	

		}else{

		    gettable("operation",$mysqli);
		}

    }

    // ======================= DELETE ================== //
    if ($operation == "delete"){

    	$id = $_POST['id'];

    	delete($id,"operation",$mysqli);

    }


}	//======================== Конец работы с таблицей operation ==============//


if (isset($_POST['table'])){

	$table = $_POST['table'];

	gettable($table,$mysqli);

}






?>