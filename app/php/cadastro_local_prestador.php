<?php
	include "header.php";
	$prestador = $_GET['id_prestador'];
	$estado = $_GET['estado'];
	$cidades = $_GET['cidades']; 
	
	$sql = "insert into jobexpert.estado_prestador (prestador_id, estado_id) values (".$prestador.", ".$estado.");";
	$res = mysql_query($sql);
	
	$cidades = explode(",", $cidades);

	//echo $cidades[0];

	if($cidades[0] == ""){
		for($i = 1 ; $i < count($cidades) ; $i++){
			$sql1 = "insert into jobexpert.cidade_prestador (prestador_id, cidade_id) values (".$prestador.", ".$cidades[$i].");";
			$res1 = mysql_query($sql1);
		}
	}else{
		for($i = 0 ; $i < count($cidades) ; $i++){
			$sql1 = "insert into jobexpert.cidade_prestador (prestador_id, cidade_id) values (".$prestador.", ".$cidades[$i].");";
			$res1 = mysql_query($sql1);
		}
	}

	if($res == true && $res1 == true){
		echo 1;
	}else{
		echo $sql;
		echo $sql1;
	}
			
?>