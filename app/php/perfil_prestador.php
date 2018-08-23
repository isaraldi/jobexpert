<?php
    include 'header.php';
    $id_prestador = $_GET['id_prestador'];
    $sql = "select nome_prestador, foto_prestador from jobexpert.prestador where id_prestador = ".$id_prestador.";";
    $res = mysql_query($sql);
    $row = mysql_fetch_row($res);  


    $sql2 = "select nome_servico from jobexpert.servico_prestador inner join jobexpert.servico on jobexpert.servico_prestador.servico_id = jobexpert.servico.id_servico where prestador_id = ".$id_prestador.";";
    $res2 = mysql_query($sql2);
    for($i = 0 ; $i < mysql_num_rows($res2) ; $i ++){
        $row2 = mysql_fetch_row($res2);
        $servico .= utf8_encode($row2[0]);
    }

    $sql3 = "select * from jobexpert.solicitacao where prestador_id = ".$id_prestador." and concluido = 1;";
    $res3 = mysql_query($sql3);

    $sql4 = "select avg(nota) from jobexpert.avaliacoes where prestador_id = ".$id_prestador.";";
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
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                    </div>
                    ";
    }else  if($row4[0] >= 1.3 && $row4[0] < 1.8){
        $avaliacao = " 
                    <p>Nota: 1.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else  if($row4[0] >= 1.8 && $row4[0] < 2.3){
        $avaliacao = " 
                    <p>Nota: 2</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                    </div>
                    ";
     }else  if($row4[0] >= 2.3 && $row4[0] < 2.8){
        $avaliacao = " 
                    <p>Nota: 2.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else  if($row4[0] >= 2.8 && $row4[0] < 3.3){
        $avaliacao = " 
                    <p>Nota: 3</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                    </div>
                    ";
    }else if($row4[0] >= 3.3 && $row4[0] < 3.8){
        $avaliacao = " 
                    <p>Nota: 3.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else if($row4[0] >= 3.8 && $row4[0] < 4.3){
        $avaliacao = " 
                    <p>Nota: 4</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                    </div>
                    ";
    }else if($row4[0] >= 4.3 && $row4[0] < 4.8){
        $avaliacao = " 
                    <p>Nota: 4.5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                    </div>
                    ";
    }else if($row4[0] >= 4.8 && $row4[0] <= 5){
        $avaliacao = " 
                    <p>Nota: 5</p>
                    <div>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                        <img src='.\img\star_left.png' style='height: 35px;'>
                        <img src='.\img\star_right.png' style='height: 35px; margin-left: -7px;'>
                    </div>
                    ";
    }


    $html = "    
        <img src=".$row[1]." style='
            border-radius: 50%;
            margin: 0px;
            margin-top: 10vw;
            width: 150px;
            height: 150px;
            line-height: 30px;
            outline: none;
        '>
        <div style='
            margin-top: 10px;
            width: 94vw;
            height: 30px;
            line-height: 30px;
            outline: none;
            color: #FFF;
            font-size: 16px;
            font-family: \"Open Sans\";
            '>".utf8_encode($row[0])."
        </div>
        <div style='
            margin: 0px;
            width: 94vw;
            outline: none;
            color: #FFF;
            font-size: 16px;
            font-family: \"Open Sans\";
            '>".$avaliacao."</span>
        </div>
        <div style='
            margin: 0px;
            margin-top: 10px;
            width: 90vw;
            outline: none;
            color: #FFF;
            font-size: 16px;
            font-family: \"Open Sans\";
            '>Concluídos <br><span style='font-size: 13px;'>".mysql_num_rows($res3)."</span>
        </div>
    ";
    echo $html;
?>