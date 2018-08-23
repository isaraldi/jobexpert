<?
	include "header.php";
	$dados = $_GET['dados'];
	$dados = json_decode($dados);
	$sql = "update jobexpert.usuarios set nome_usuario = '$dados->nome', email='$dados->email' where id_usuario = $dados->id_usuario";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo $sql;
	}
?>