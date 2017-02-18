<?php

include "conectSQL.php";

if (isset($_POST['select'])) {

	$sql = "select 'kagent' as t, name,rec from kagent 
			union select 'acount' as t, name,rec from acount 
			union select 'state' as t, name,type from state";

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
    		if ($row['t'] == "kagent") $kagent .="<option>".$row['name']."</option>";
    		if ($row['t'] == "state") $state .="<option>".$row['name']."</option>";
    		if ($row['t'] == "acount") $acount .="<option>".$row['name']."</option>";                
        }       
        // $kagent .="<option>+</option>";
        // $state  .="<option>+</option>";
        // $acount .="<option>+</option>";

        echo $kagent.";".$state.";".$acount;
    }

}






?>