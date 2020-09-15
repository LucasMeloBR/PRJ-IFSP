<?php

	require("db.php");
	require("common.php");
	

	$query = "SELECT COUNT(*) as count,k.nome_kpi, ap.Status FROM action_plan ap INNER JOIN tipo_kpi tk on ap.fk_id_indicador = tk.id_tipo_kpi INNER JOIN kpi k on tk.fk_tipo_kpi = k.id_kpi GROUP BY ap.Status";
	
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