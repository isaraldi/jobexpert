<?php
	include "header.php";
    $id = $_GET['id'];
    $status = $_GET['status'];
    if($status == 1){
    	$sql = "delete from jobexpert.usuarios where id_usuario = $id";
    }else{
    	$sql = "delete from jobexpert.prestador where id_prestador = $id";
    }
    $res = mysql_query($sql);
    if($res == true){
    	echo 1;
    }else{
    	echo 0;
    }
?>