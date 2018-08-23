<?
	include "header.php";
	$dados = $_GET['dados'];
	$dados = json_decode($dados);
	$sql = "update jobexpert.prestador set nome_prestador = '$dados->nome', email_prestador='$dados->email', cpf='$dados->cpf' where id_prestador = $dados->id_prestador";
	$res = mysql_query($sql);
	if($res == true){
		echo 1;
	}else{
		echo $sql;
	}
?>