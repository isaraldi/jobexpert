function chamadas(filtro){
	var chamadas = chamaBanco("php/chamadas.php?filtro="+filtro);	
	$("#chamadas").html(chamadas);
}

function buscarChamada(valor){
	var chamadas = chamaBanco("php/chamadas.php?filtro=id_solicitacao&busca="+valor);
	$("#chamadas").html(chamadas);	
}

function chamadasDetalhes(id_chamada){
	var chamadasDetalhes = chamaBanco("php/chamada_detalhes.php?id_chamada="+id_chamada);
	$("#chamadasDetalhes").html(chamadasDetalhes);
	$("#idChamada").html("Chamada #"+id_chamada);
}