<?php

	require("db.php");
	require("common.php");
	

	$query = "SELECT COUNT(*) as count, where_ac from action_plan GROUP BY where_ac";
	
	try 
    	{ 
     
        	$stmt = $db->prepare($query); 
           	$stmt->execute();
			while($results = $stmt->fetch(PDO::FETCH_ASSOC)){
				$result[] = $results;
			}
        } 
    catch(PDOException $ex) 
        { 
 
         	die("Falha ao rodar a query: " . $ex->getMessage()); 
        } 
	echo json_encode($result);