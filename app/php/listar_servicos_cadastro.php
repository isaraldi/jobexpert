<?php
	include 'header.php';
	$sql = "SELECT * FROM jobexpert.servico order by nome_servico asc;";
	$res = mysql_query($sql);
    $html .= "<option value=''>Selecione os serviços prestados</option>";
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$html .= "<option value=".$row[0].">".utf8_encode($row[1])."</option>";
	}
	echo $html;
?>