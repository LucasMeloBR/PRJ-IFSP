<?php
require("common.php");

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
	
			
			$query = "INSERT INTO action_plan (nome_ac, status, what, who, why, how, where_ac, benefits, how_much, start_up, final_date, focal_point, owner, manager, fk_id_indicador,fk_id_kpi) VALUES (:description, :inputstatus, :whattext, :whotext, :whytext, :howtext, :wheretext, :benefitstext, :howmuch, :dataini, :datafim, :focaltext, :ownertext, :managertext, :indicador, :categoria_kpi)";
    		
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