<?php
    include "header.php";
	$id = mysql_real_escape_string($_REQUEST['id_usuario']);
    $sql = "SELECT * FROM jobexpert.usuarios where id_usuario = ".$id.";";

    $res = mysql_query($sql);
    if(mysql_num_rows($res) > 0){
    	$row = mysql_fetch_row($res);
    	$vet['nome'] = $row[1];
    	$vet['email'] = $row[2];
        $vet['senha'] = $row[3];
    }
    echo json_encode($vet);
    mysql_close();
?>