<?php

require('db.php');


$sql = "SELECT * FROM action_plan";
$result = mysqli_query($connection,$sql);


while($row = mysqli_fetch_array($result)){
  $data[] = $row;
}


$results = ["sEcho" => 1,
        	"iTotalRecords" => count($data),
        	"iTotalDisplayRecords" => count($data),
        	"aaData" => $data ];


echo json_encode($results);

 
?>