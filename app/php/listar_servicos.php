<?php
	include 'header.php';
    $id_usuario = $_GET['id_usuario'];
    $sql1 = "select cidade_id from jobexpert.usuarios where id_usuario = ".$id_usuario.";";
    echo $sql1;
    $res1 = mysql_query($sql1);
    $row1 = mysql_fetch_row($res1);

	$sql = "SELECT nome_servico FROM jobexpert.servico right join jobexpert.servico_prestador on jobexpert.servico.id_servico = jobexpert.servico_prestador.servico_id group by nome_servico order by nome_servico asc;";
	$res = mysql_query($sql);
	for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
		$row = mysql_fetch_row($res);
		$html .= "
			<div onclick='popup(".$row[0].")' style='
                box-sizing: border-box;
                -webkit-box-sizing:border-box;
                -moz-box-sizing: border-box;
                background-color: #d5dadc;
                color: #121b21;
                font-size: 15px;
                font-family: \"Open Sans\";
                margin: 0px;
                width: 90vw;
                height: 50px;
                line-height: 50px;
                outline: none;
                letter-spacing: 0px;
                border-radius: 8px;
                /*border: 1px solid rgba(255,255,255,.5);*/
                margin-bottom: 20px;
            '>".utf8_encode($row[1])."
            </div>
		";
	}
	echo $html;
?>
