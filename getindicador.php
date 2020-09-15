<?php 

require("common.php");
require("db.php");

$indicid = $_POST['indicadorid'];

$query = "SELECT * FROM tipo_kpi WHERE fk_tipo_kpi= ".$indicid;

$result = mysqli_query($connection,$query);

$indicador_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $indid = $row['id_tipo_kpi'];
    $nome = $row['nome_tipo_kpi'];

    $indicador_arr[] = array("id_tipo_kpi" => $indid, "nome_tipo_kpi" => $nome);
}

// encoding array to json format
echo json_encode($indicador_arr);