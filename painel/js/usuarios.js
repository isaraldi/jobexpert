function usuarios(filtro){
	var usuarios = chamaBanco("php/usuarios.php?filtro="+filtro);	
	$("#usuarios").html(usuarios);
}

function buscarUsuario(valor){
	var usuarios = chamaBanco("php/usuarios.php?filtro=nome_usuario&busca="+valor);
	$("#usuarios").html(usuarios);	
}

function excluirUsuario(id_usuario){
	var respostaExclusao = chamaBanco("php/excluir_usuario.php?id_usuario="+id_usuario);
	console.log(respostaExclusao);
	if(respostaExclusao == 1){
		alert("Usuário excluído com sucesso!");
		location.reload();
	}
}

function usuarioChamadas(id_usuario){
	//alert(id_usuario);
	var usuarioChamadas = chamaBanco("php/usuario_chamadas.php?id_usuario="+id_usuario);
	$("#usuarioChamadas").html(usuarioChamadas);
}

function usuarioAvaliacoes(id_usuario){
	//alert(id_usuario);
	var usuarioAvaliacoes = chamaBanco("php/usuario_avaliacoes.php?id_usuario="+id_usuario);
	$("#usuarioAvaliacoes").html(usuarioAvaliacoes);
}

function excluirAvaliacao(id_avaliacao){
	alert(id_avaliacao);
	var respostaExclusao = chamaBanco("php/excluir_avaliacao.php?id_avaliacao="+id_avaliacao);
	console.log(respostaExclusao);
	if(respostaExclusao == 1){
		alert("Avaliação excluída com sucesso!");
		location.reload();
	}
}

function verificarUsuario(id_usuario){
	var verificacao = chamaBanco("php/verificar_email.php?id_usuario="+id_usuario);
	if(verificacao == 1){
		alert("Usuário verificado com sucesso!");
		location.reload();
	}
	
}

function editarUsuario(id){
	var dados = {
		id_usuario : id,
		nome : $("#nome").val(),
		email : $("#email").val()
	};

	dados = JSON.stringify(dados);
	var resposta = chamaBanco("php/editar_usuario.php?dados="+dados);  
	console.log("php/editar_usuario.php?dados="+dados);                                                             
	if(resposta == 1){
		alert("Usuário editado com sucesso");
		location.reload();
	}
}