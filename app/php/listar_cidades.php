<?php
	include 'header.php';
	$estado = $_GET['estado'];
	$sql = "SELECT * FROM jobexpert.cidades where estado_id = ".$estado." order by nome asc;";
	$res = mysql_query($sql);
    $html = "<option value=''>Cidade</option>";
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$html .= "
                <option value=".$row[0].">".utf8_encode($row[1])."</option>
		";
	}
	echo $html;
?>
