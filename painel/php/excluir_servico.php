<?php
	include "header.php";
	$id_servico = $_GET["id_servico"];

	$sql = "delete from jobexpert.servico where id_servico = $id_servico;";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo $sql;
	}
?>