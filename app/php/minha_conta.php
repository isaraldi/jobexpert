<?php
	include "header.php";
	$id = $_GET['id_usuario'];
	$sql = "select nome_usuario,foto_usuario from jobexpert.usuarios where id_usuario = ".$id;
	$res = mysql_query($sql);

	$sql4 = "select avg(nota) from jobexpert.avaliacoes where usuario_id = ".$id.";";
    $res4 = mysql_query($sql4);
    $row4 = mysql_fetch_row($res4);

    if($row4[0] == null){
        $avaliacao = " 
                    <p>Nota: Sem avaliações</p>
                    <div>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                    </div>
                    ";
    }else if($row4[0] >= 0 && $row4[0] < 0.3){
    	$avaliacao = " 
                    <p>Nota: 0</p>
                    <div>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                        <img src='.\img\star_nocolor.png' style='height: 35px;'>
                    </div>
                    ";
    }else if($row4[0] >= 0.3 && $row4[0] < 0.8){
    	$avaliacao = " 
                    <p>Nota: 0.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else if($row4[0] >= 0.8 && $row4[0] < 1.3){
    	$avaliacao = " 
                    <p>Nota: 1</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                    </div>
                    ";
    }else  if($row4[0] >= 1.3 && $row4[0] < 1.8){
    	$avaliacao = " 
                    <p>Nota: 1.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else  if($row4[0] >= 1.8 && $row4[0] < 2.3){
    	$avaliacao = " 
                    <p>Nota: 2</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                    </div>
                    ";
     }else  if($row4[0] >= 2.3 && $row4[0] < 2.8){
    	$avaliacao = " 
                    <p>Nota: 2.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else  if($row4[0] >= 2.8 && $row4[0] < 3.3){
        $avaliacao = " 
                    <p>Nota: 3</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                    </div>
                    ";
    }else if($row4[0] >= 3.3 && $row4[0] < 3.8){
        $avaliacao = " 
                    <p>Nota: 3.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else if($row4[0] >= 3.8 && $row4[0] < 4.3){
        $avaliacao = " 
                    <p>Nota: 4</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                    </div>
                    ";
    }else if($row4[0] >= 4.3 && $row4[0] < 4.8){
        $avaliacao = " 
                    <p>Nota: 4.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else if($row4[0] >= 4.8 && $row4[0] <= 5){
        $avaliacao = " 
                    <p>Nota: 5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -6px;'>
                    </div>
                    ";
    }

	if($res == true && $res4 == true){	
		$row = mysql_fetch_row($res);
		$my = array("nome"=>utf8_encode($row[0]),"foto"=>(string)$row[1],"avaliacao"=>(string)$avaliacao);
	}	
	echo json_encode($my);
	mysql_close();
?>