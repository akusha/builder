<?php

include "conectSQL.php";




//=================== функция получения тега table из таблицы =====================//
function gettable($table,&$mysqli){

	$s = "<tr><th>";

	if ($table === "operation_view") $s .= "Дата</th><th>Значение</th><th>Контрагент</th><th>Статья</th><th>Счет";

	else $s .= "Наименовение</th><th>Значение";

	$s .= "</th><th><button name='add' class='bd'><span class='fontawesome-plus'></span></button></th><th>.</th></tr>";

	$sql = "SELECT * FROM ".$mysqli->real_escape_string($table);

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
function getrow($id,$table,&$mysqli){	

	$sql = "SELECT * FROM ".$mysqli->real_escape_string($table)." WHERE id=?";	

    $stmt = $mysqli->stmt_init();

    if(($stmt->prepare($sql) === FALSE)
    	 		or ($stmt->bind_param('s',$id) === FALSE)
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

//=======================  функция удаления записи  из таблицы =================//
function delete($id,$table,&$mysqli){

	$sql = "DELETE FROM ".$mysqli->real_escape_string($table)." WHERE id=?";

	$stmt = $mysqli->stmt_init();

    if(($stmt->prepare($sql) === FALSE) 
        or ($stmt->bind_param('s',$id) === FALSE)
        or ($stmt->execute() === FALSE)       
        or ($stmt->close() === FALSE)) {
        die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    }
    else echo "Удалено";  
}

// ========== Функция добавления и обновления записей. Если id = null то происходить добавление иначе обновление =========//

function insert($id,$table,&$mysqli,&$arg){

	$stmt = $mysqli->stmt_init(); 

	// Создаём массив для столбцов куда будем вставлять новое значение
	$columns = array(); 
	// Создаём массив для значений которые будем вставлять
	$values = array(); 

	$n = count($arg); 

	if ($id != null) $n+=1;

	$paramstype = str_repeat("s", $n);

	$values[] = $paramstype;

	// Разбираем массив с данными по столбцам. array('title' => '1223', 'content' => 'dadsd')
	foreach ($arg as $column => $value)
	{
		// Экранируем специальные символы в названии столбца
		$column = $mysqli->real_escape_string($column);

		// Добавляем каждый столбец в массив столбцов
		$columns[] = "`$column`";		

		// Записываем нулы пустых значений, чтобы длины значений и столбцов были равны
		if ($value === NULL)
		{
			// Добавляем значение в массив значений
			$values[] = "''";
		}
		else
		{
			// Добавляем каждое значение в массив значений		
			$values[] = $mysqli->real_escape_string($value);;
		}
	}

	if ($id == NULL)  {

	  $playsholders ="?".str_repeat(',?',count($arg)-1);

	  $sql = "INSERT INTO ".$mysqli->real_escape_string($table)." (".join(',',$columns).") VALUES (".$playsholders.")";

	}else {

	  $sql = "UPDATE ".$mysqli->real_escape_string($table)." SET ".join('=?,',$columns)."=? WHERE id=?";

	  $values[] = $id;

	}

	// bind_param('siiiii', $date, $kagent,$state,$acount,$count)

    if(($stmt->prepare($sql) === FALSE) 
    or (call_user_func_array(array($stmt,'bind_param'), refValues($values))  === FALSE)
    or ($stmt->execute() === FALSE)      
    or ($stmt->close() === FALSE)) {
    	die('Select Error (' . $stmt->errno . ') ' . $stmt->error);
    	return false;
    }
    else 
    	return true; 
}

function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}


// =============== Загрузка списков для формы из таблиц acount,kagent,state ====================//
if (isset($_POST['select'])) {

	$sql = "select * from kas";

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
	$table = $_POST['table'];
	$id = $_POST['id'];

	if(isset($_POST['date']))  $arg['date'] = $_POST['date'];
	if(isset($_POST['kagent'])) $arg['k_id'] = $_POST['kagent'];
	if(isset($_POST['acount'])) $arg['s_id'] = $_POST['acount'];
	if(isset($_POST['state'])) $arg['a_id'] = $_POST['state'];
	if(isset($_POST['count'])) $arg['value'] = $_POST['count'];

	if(isset($_POST['name'])) $arg['name'] = $_POST['name'];
	if(isset($_POST['rec'])) $arg['rec'] = $_POST['rec'];
	if(isset($_POST['type'])) $arg['type'] = $_POST['type'];


	$stmt = $mysqli->stmt_init(); 

	//============ INSERT ===========//
    if ($operation == "insert"){  		

		if (insert(null,$table,$mysqli,$arg)){

        	$id = $mysqli->insert_id;        	

		    $row =getrow($id,$table,$mysqli); 

		    $tr = gettr($row);

	        echo $id.";".$tr;
	    }

    }

    //========== UPDATE =============//
    if ($operation == "update")    {    	

    	if(insert($id,$table,$mysqli,$arg)){     

    		if ($table === "operation") $table = "operation_view";           	

		    $row = getrow($id,$table,$mysqli);

		    $tr = gettr($row);

	        echo $id.";".$tr;
        } 
    }

    //============ GET ============//
    if ($operation == "get"){

    	if ($table === "operation") $table = "operation_view";
  
    	if (isset($_POST['id'])){
		    
		    $id = $_POST['id'];

		    $row =getrow($id,$table,$mysqli); 

	        echo join(';',$row);	

		}else{

		    gettable($table,$mysqli);
		}

    }

    // ======================= DELETE ================== //
    if ($operation == "delete"){

    	delete($id,$table,$mysqli);

    }


}	//======================== Конец работы с таблицей operation ==============//
