<?php
	include "header.php";
	$id_prestador = $_GET['id_prestador'];
	$sql = "select * from jobexpert.estado_prestador where prestador_id = $id_prestador";
	$res = mysql_query($sql);
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);

		$sql1 = "select * from jobexpert.solicitacao where prestador_id = $row[0] and estado_id = $row[1]";
		$res1 = mysql_query($sql1);

		$sql2 = "select * from jobexpert.estados where id = $row[0]";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_row($res2);

		$html .= "
			<tr>
				<td class='v-align-middle semi-bold'>".utf8_encode($row2[1])."</td>
				<td class='v-align-middle semi-bold'>".mysql_num_rows($res1)."</td>
			</tr>
		";
	}
	echo $html;

?>