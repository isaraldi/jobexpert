<?php 
	include "header.php";
	$id = $_GET['id_prestador'];
	$sql = "select 
				* 
			from 
				jobexpert.prestador 
			inner join 
				jobexpert.servico_prestador
			on 
				jobexpert.servico_prestador.prestador_id = jobexpert.prestador.id_prestador
			inner join
				jobexpert.servico
			on
				jobexpert.servico.id_servico = jobexpert.servico_prestador.servico_id
			where 
				id_prestador = ".$id.";";
	$res = mysql_query($sql);
	
	$vet = array();
		for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
			$row = mysql_fetch_row($res);
			$vet[$i]["nome_prestador"] = $row[1];
			$vet[$i]["sexo"] = $row[5];
			$vet[$i]["cpf"] = $row[2];
			$vet[$i]["email_prestador"] = $row[3];
			$vet[$i]["cidade_id"] = $row[6];
			$vet[$i]["endereco"] = $row[7];
			$vet[$i]["cep"] = $row[8];
			$vet[$i]["senha"] = $row[4];
			$vet[$i]["servicos"] = $row[11];
		}

		

	echo json_encode($vet);
?>