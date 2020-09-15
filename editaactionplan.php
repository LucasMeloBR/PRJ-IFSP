<?php
require("common.php");
require("db.php");
	
	$id=$_POST['id'];
	$query_params = array(
	':categoria_kpi' => $_POST["inputCkpi2"],
    ':indicador' => $_POST["indicador2"],
    ':description' => $_POST['description'],
    ':inputstatus' => $_POST['inputstatus'],
    ':whattext' => $_POST['whattext'],
    ':whotext' => $_POST['whotext'],
    ':whytext' => $_POST['whytext'],
    ':howtext' => $_POST['howtext'],
    ':wheretext' => $_POST['wheretext'],
	':howmuch' => $_POST['howmuch'],
	':benefitstext' => $_POST['benefitstext'],
	':dataini' => $_POST['dataini'],
	':datafim' => $_POST['datafim'],
	':focaltext' => $_POST['focaltext'],
	':ownertext' => $_POST['ownertext'],
	':managertext' => $_POST['managertext']);
	
	
			$query = "UPDATE action_plan SET nome_ac = :description, status =:inputstatus, what= :whattext, who=:whotext, why=:whytext, how= :howtext, where_ac= :wheretext, benefits= :benefitstext, how_much= :howmuch, start_up= :dataini, final_date= :datafim, focal_point= :focaltext, owner= :ownertext, manager= :managertext,fk_id_indicador= :indicador,fk_id_kpi= :categoria_kpi WHERE id_ac = $id";
    		
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