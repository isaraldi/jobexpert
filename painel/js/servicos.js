function servicos(){
	var servicos = chamaBanco("php/servicos.php");	
	$("#servicos").html(servicos);
}

function servicosChamadas(id_servico){
	var servicosChamadas = chamaBanco("php/servicos_chamadas.php?id_servico="+id_servico);
	servicosChamadas = JSON.parse(servicosChamadas);
	$("#servicosChamadas").html(servicosChamadas.html);
	$("#nomeServico").html(servicosChamadas.nomeServico);
}

function servicosPrestadores(id_servico){
	var servicosPrestadores = chamaBanco("php/servicos_prestadores.php?id_servico="+id_servico);
	servicosPrestadores = JSON.parse(servicosPrestadores);
	$("#servicosPrestadores").html(servicosPrestadores.html);
	$("#nomeServico").html(servicosPrestadores.nomeServico);
}

function cadastrarServico(){
	var respostaCadastro = chamaBanco("php/cadastrar_servico.php?servico="+$("#servicoAdicionado").val());
	if(respostaCadastro == 1){
		alert("Cadastro realizado com sucesso");
		location.reload();
	}else{
		console.log(respostaCadastro);
	}
}

function excluirServico(id_servico){
	var respostaExclusao = chamaBanco("php/excluir_servico.php?id_servico="+id_servico);
	if(respostaExclusao == 1){
		alert("Excluído com sucesso");
		location.reload();
	}else{
		console.log(respostaExclusao);
	}
}