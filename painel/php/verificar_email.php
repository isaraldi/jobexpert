<?php	
	include "header.php";
	$id_prestador = $_GET['id_prestador'];
	$id_usuario = $_GET['id_usuario'];

	if($id_usuario != ""){
		$sql = "update jobexpert.usuarios set verificado = 1 where id_usuario = $id_usuario;";
	}else if($id_prestador != ""){
		$sql = "update jobexpert.prestador set verificado = 1 where id_prestador = $id_prestador;";
	}

	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo $sql;
	}
?>