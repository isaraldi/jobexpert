<?php
    include "header.php";
	$id = mysql_real_escape_string($_REQUEST['id_usuario']);
    $sql = "SELECT * FROM jobexpert.prestador where id_prestador = ".$id.";";


    $res = mysql_query($sql);
    if(mysql_num_rows($res) > 0){
    	$row = mysql_fetch_row($res);
        $vet['nome'] = utf8_encode($row[1]);
        $vet['email'] = $row[3];
        $vet['senha'] = $row[4];

        $sql1 = "select servico_id from jobexpert.servico_prestador where prestador_id = $row[0];";
        $res1 = mysql_query($sql1);
        for($i = 0 ; $i < mysql_num_rows($res1) ; $i++){
            $row1 = mysql_fetch_row($res1);
            $servicos[$i] = $row1[0];
        }    
    }

    

    $aux = 0;


    $sql2 = "SELECT * FROM jobexpert.servico order by id_servico asc;";
    $res2 = mysql_query($sql2);
    $vet['html'] = "<option value=''>Selecione os serviços prestados</option>";
    for($i = 0 ; $i < mysql_num_rows($res2) ; $i++){
        $row2 = mysql_fetch_row($res2);
        //echo "tabela: ".$row2[0]."\n";
        //echo "auxiliar: ".$servicos[$aux]."\n";
        if($row2[0] == $servicos[$aux]){
            //echo "entrou";
            $vet['html'] .= "<option selected value=".$row2[0].">".utf8_encode($row2[1])."</option>";
            $aux++;
        }else{
            $vet['html'] .= "<option value=".$row2[0].">".utf8_encode($row2[1])."</option>"; 
        }
    }

    echo json_encode($vet);
    mysql_close();
?>