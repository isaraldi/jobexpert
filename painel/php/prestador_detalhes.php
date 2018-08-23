<?php
	include "header.php";
	$id_prestador = $_GET['id_prestador'];
	$sql = "select nome_prestador, email_prestador, cpf, DATE_FORMAT(data_cadastro, '%d/%m/%Y %H:%i'), verificado from jobexpert.prestador where id_prestador = $id_prestador";
	
	$res = mysql_query($sql);
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);

		if($row[4] == 0){
			$verificado = "<a href='javascript: verificarPrestador($id_prestador)' class='btn btn-tag'><i class='fs-14 fa fa-check'></i></a>";
		}else{
			$verificado = "<a class='btn-tag btn-tag-light' style='background-color=green;'><i class='fs-14 fa fa-check'></i></a>";
		}

		$html .= "
			<tr>
				<td class='v-align-middle semi-bold'>
					<input id='nome' value='".utf8_encode($row[0])."''></input>
				</td>
				<td class='v-align-middle'>
					<input id='email' value='".utf8_encode($row[1])."''></input>
				</td>
				<td class='v-align-middle semi-bold'>
					<input id='cpf' value='$row[2]''></input>
				</td>
				<td class='v-align-middle semi-bold'>$row[3]</td>
				<td class='v-align-middle'>
					$verificado
					<a href='javascript: editarPrestador($id_prestador)' class='btn btn-tag'><i class='fa fa-save'></i></a>
				</td>		
			</tr>
		";
	}
	echo $html;

?>