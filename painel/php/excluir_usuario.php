<?php
	include "header.php";
	$id = $_GET['id_usuario'];
	$sql = "delete from jobexpert.usuarios where id_usuario = ".$id.";";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo 0;
	}
?>