<?php
require("common.php");
require("db.php");

$query_params = array(
	':id' => $_POST['id']);
$query = "DELETE FROM action_plan WHERE id_ac = :id";
    		
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