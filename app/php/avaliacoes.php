<?php
    include 'header.php';
    $id_prestador = $_GET['id_prestador'];
    $sql = "select foto_prestador from jobexpert.prestador where id_prestador = ".$id_prestador.";";
    $res = mysql_query($sql);
    $row = mysql_fetch_row($res);  

    $sql4 = "select nota, comentario, solicitacao_id from jobexpert.avaliacoes where prestador_id = ".$id_prestador.";";
    $res4 = mysql_query($sql4);
    
    for($i = 0 ; $i < mysql_num_rows($res4) ; $i ++){
        $row4 = mysql_fetch_row($res4);
        if($row4[0] == 3){
            $avaliacao = " 
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                        ";
        }else if($row4[0] == 3.5){
            $avaliacao = " 
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                        ";
        }else if($row4[0] == 4){
            $avaliacao = " 
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -5px;'>
                        ";
        }else if($row4[0] == 4.5){
            $avaliacao = " 
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                        ";
        }else if($row4[0] == 5){
            $avaliacao = " 
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -5px;'>
                            <img src='.\img\star_left.png' style='height: 13px;'>
                            <img src='.\img\star_right.png' style='height: 13px; margin-left: -4px;'>
                        ";
        }   

        $sql1 = "select nome_usuario from jobexpert.usuarios inner join jobexpert.solicitacao on jobexpert.usuarios.id_usuario =jobexpert.solicitacao.usuario_id where id_solicitacao = ".$row4[2].";";
        $res1 = mysql_query($sql1);
        $row1 = mysql_fetch_row($res1);

        $html .= "    
            <div style='
                padding: 25px;
                height: 125px;
                border-bottom: 1px solid rgba(255,255,255,.1);
            '>
                <img src=".$row[0]." style='
                    border-radius: 50%;
                    margin: 0px;
                    width: 60px;
                    height: 60px;
                    outline: none;
                    float: left;
                '>
                <div style='
                    height: 30px;
                    line-height: 30px;
                    outline: none;
                    color: #FFF;
                    font-size: 16px;
                    font-family: \"Open Sans\";
                    float: left;
                    text-align: left; 
                    margin-left: 5vw;
                    '>".utf8_encode($row1[0])."<br> <span style='font-size: 13px;'>".$avaliacao."</span>
                </div>
                <div style='
                    width: 90vw;
                    outline: none;
                    color: #FFF;
                    font-size: 13px;
                    font-family: \"Open Sans\";
                    float: left;
                    text-align: left; 
                    margin-top: 10px;
                    '>".$row4[1]."
                </div>
            </div>
        ";
    }
    echo $html;
?>