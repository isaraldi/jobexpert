<?php
	include "header.php";
	$id = $_GET['id_prestador'];
	$sql = "delete from jobexpert.prestador where id_prestador = ".$id.";";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo 0;
	}
?>