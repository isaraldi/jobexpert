<?php 
	include 'header.php';
	$login = $_GET['usuario'];
	$senha = $_GET['senha'];

	$sql = "SELECT * FROM jobexpert.usuarios WHERE email ='".$login."' and senha='".$senha."'";
	$res = mysql_query($sql);
	if(mysql_num_rows($res) > 0){
		echo 1;
	}else{
		echo 0;

	}
?>