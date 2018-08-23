function prestadores(filtro){
	var prestadores = chamaBanco("php/prestadores.php?filtro="+filtro);	
	$("#prestadores").html(prestadores);
}

function buscarPrestador(valor){
	var prestadores = chamaBanco("php/prestadores.php?filtro=nome_prestador&busca="+valor);
	$("#prestadores").html(prestadores);	
}

function excluirPrestador(id_prestador){
	var respostaExclusao = chamaBanco("php/excluir_prestador.php?id_prestador="+id_prestador);
	console.log(respostaExclusao);
	if(respostaExclusao == 1){
		alert("Prestador excluído com sucesso!");
		location.reload();
	}
}

function prestadorDetalhes(id_prestador){
	var prestadorDetalhes = chamaBanco("php/prestador_detalhes.php?id_prestador="+id_prestador);
	$("#prestadorDetalhes").html(prestadorDetalhes);	
}


function prestadorEstado(id_prestador){
	var prestadorEstado = chamaBanco("php/prestador_estado.php?id_prestador="+id_prestador);
	$("#prestadorEstado").html(prestadorEstado);
}

function prestadorCidade(id_prestador){
	var prestadorCidade = chamaBanco("php/prestador_cidade.php?id_prestador="+id_prestador);
	$("#prestadorCidade").html(prestadorCidade);
}

function prestadorServicos(id_prestador){
	//alert(id_prestador);
	var prestadorServicos = chamaBanco("php/prestador_servicos.php?id_prestador="+id_prestador);
	$("#prestadorServicos").html(prestadorServicos);

}

function prestadorAvaliacoes(id_prestador){
	//alert(id_prestador);
	var prestadorAvaliacoes = chamaBanco("php/prestador_avaliacoes.php?id_prestador="+id_prestador);
	$("#prestadorAvaliacoes").html(prestadorAvaliacoes);
}

function verificarPrestador(id_prestador){
	var verificacao = chamaBanco("php/verificar_email.php?id_prestador="+id_prestador);
	if(verificacao == 1){
		alert("Prestador verificado com sucesso!");
		location.reload();
	}
}

function editarPrestador(id){
	var dados = {
		id_prestador : id,
		nome : $("#nome").val(),
		email : $("#email").val(),
		cpf : $("#cpf").val()
	};

	dados = JSON.stringify(dados);
	var resposta = chamaBanco("php/editar_prestador.php?dados="+dados);  
	console.log("php/editar_prestador.php?dados="+dados);                                                             
	if(resposta == 1){
		alert("Prestador editado com sucesso");
		location.reload();
	}
}



