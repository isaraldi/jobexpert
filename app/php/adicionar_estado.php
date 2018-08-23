<?php	
	$i = $_GET['aux'];
	include 'header.php';
	$sql = "SELECT * FROM jobexpert.estados;";
	$res = mysql_query($sql);
	$aux = $_GET['aux'];
    
	$html = "
		<div  style='
            width: 70vw;
            float: left;

        '>
            <select onChange='listarCidades(this.options[this.selectedIndex].value, $i)' id='estadosPrestador$aux' style='
                background-color: rgba(0,0,0,0);
                font-size: 12px;
                font-family: \"Open Sans\";
                margin: 0px;
                padding: 4vw;
                width: 80vw;
                height: 50px;
                border: 0px;
                color: #fff;
                outline: none;
                margin-left: 15px;
                box-sizing: border-box;
                -webkit-box-sizing:border-box;
                -moz-box-sizing: border-box;
                border-bottom:1px solid rgba(255,255,255,.5);
            '>";

            $html .= "<option value=''>Estado</option>";
			for($i = 0 ; $i < mysql_num_rows($res) ; $i++){
				$row = mysql_fetch_row($res);
				$html .= "
		                <option value=".$row[0].">".utf8_encode($row[1])."</option>
				";
			}

    $html .=     
            "</select>
            <select multiple id='cidadesPrestador$aux' style='
                background-color: rgba(0,0,0,0);
                font-size: 12px;
                font-family: \"Open Sans\";
                margin: 0px;
                padding: 4vw;
                width: 80vw;
                height: 50px;
                border: 0px;
                color: #fff;
                outline: none;
                margin-left: 15px;
                box-sizing: border-box;
                -webkit-box-sizing:border-box;
                -moz-box-sizing: border-box;
                border-bottom:1px solid rgba(255,255,255,.5);
            '>
                <option value='' selected>Cidade</option>
            </select>
        </div>
        <div style='
        	width: 30vw;
        	float: right;
        '>
        	<div onclick='adicionarEstado()' style='
                box-sizing: border-box;
                -webkit-box-sizing:border-box;
                -moz-box-sizing: border-box;
                margin-left: 50px;
                margin-top: 35px;
                line-height: 30px;
                width: 30px;
                height: 30px;
                border-radius: 8px;
                /*border: 1px solid rgba(255,255,255,.5);*/
                background-color: #d5dadc;
                outline: none;
            '>+</div>
        </div>
        <div id='adicionarEstado".($aux+1)."'></div>
	";
	echo $html;
?>