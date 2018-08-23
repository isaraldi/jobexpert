function inicio(){
	var resposta = JSON.parse(chamaBanco("php/inicio.php"));
	$("#servicosMes").html(resposta.servicosMes);
	$("#servicosTotal").html(resposta.servicosTotal);
	$("#concluidosMes").html(resposta.concluidosMes);
	$("#concluidosTotal").html(resposta.concluidosTotal);
	$("#tipoServicoAtendido").html(resposta.tipoServicoAtendido);
	$("#tipoServicoTotal").html(resposta.tipoServicoTotal)
	$("#usuariosMes").html(resposta.usuariosMes);
	$("#usuariosTotal").html(resposta.usuariosTotal);
	$("#respostaMes").html(resposta.respostaMes);
	$("#respostaTotal").html(resposta.respostaTotal);
	$("#listaEstados").html(resposta.listaEstados);
	$("#estadosAtendidos").html(resposta.estadosAtendidos);
	$("#cidadesAtendidas").html(resposta.cidadesAtendidas);
	$("#prestadoresTotal").html(resposta.prestadoresTotal);
	$("#prestadoresMes").html(resposta.prestadoresMes);
}	


function prestadoresEstados(id_estado){
	var prestadoresEstados = chamaBanco("php/prestadores_estados.php?id_estado="+id_estado);
	$("#prestadoresEstados").html(prestadoresEstados);
}

function prestadoresCidades(id_cidade){
	var prestadoresCidades = chamaBanco("php/prestadores_cidades.php?id_cidade="+id_cidade);
	$("#prestadoresCidades").html(prestadoresCidades);
}