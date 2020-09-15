<?php
require("common.php");
require("db.php");

	$idkpi = $_POST['inputCkpi'];
	if(!empty($idkpi)){
		$query_params = array(
		
    	':indicador_new' => $_POST['indicadornew'],
    	':id' => $idkpi);
		
		$query = "INSERT INTO tipo_kpi (nome_tipo_kpi, fk_tipo_kpi) VALUES (:indicador_new, :id)";
		try 
            { 
     
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params);
            } 
            catch(PDOException $ex) 
            { 
 
                die("Falha ao rodar a query: " . $ex->getMessage()); 
            }
		header("Location: Dashboard.Content.php"); 
         
        die("Redirecting to Dashboard.Content.php");
	}
	else{
		$query_params = array(
		':categoria' => $_POST['categoria']);
		
		$query = "INSERT INTO kpi (nome_kpi) VALUES (:categoria)";
		try 
            { 
     
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params);
				$lastId = $db->lastInsertId();
			if($result){
				$categoriaid=mysqli_insert_id($connection);
				$query_params2 = array(
				':fk_id' => $lastId,
				':indicador_new' => $_POST['indicadornew']);
				
				$query2 = "INSERT INTO tipo_kpi(nome_tipo_kpi, fk_tipo_kpi) VALUES (:indicador_new, :fk_id)";
				try 
            	{ 
     
                	$stmt = $db->prepare($query2); 
                	$result = $stmt->execute($query_params2);
            	} 
            	catch(PDOException $ex) 
            	{ 
 
                die("Falha ao rodar a query: " . $ex->getMessage()); 
            	}
			}else{
				header("Location: Dashboard.Content.php");
				die("Redirecting to Dashboard.Content.php");
			}
            } 
            catch(PDOException $ex) 
            { 
 
                die("Falha ao rodar a query: " . $ex->getMessage()); 
            }
		header("Location: Dashboard.Content.php");
        die("Redirecting to Dashboard.Content.php");
	}