function mostrarConversasUsuario(){
	var conversas = chamaBanco("http://jobexpert.com.br/app/php/listar_conversas.php?id_usuario="+window.localStorage.getItem("usuario"));
	console.log("http://jobexpert.com.br/app/php/listar_conversas.php?id_usuario="+window.localStorage.getItem("usuario"));
	$("#conversas").html(conversas);
}

function mostrarConversasPrestador(){
	var conversas = chamaBanco("http://jobexpert.com.br/app/php/listar_conversas.php?id_prestador="+window.localStorage.getItem("usuario"));
	console.log("http://jobexpert.com.br/app/php/listar_conversas.php?id_prestador="+window.localStorage.getItem("usuario"));
	$("#conversas").html(conversas);
}

function mostrarMensagens(id){
	var mensagens = chamaBanco("http://jobexpert.com.br/app/php/listar_mensagens.php?id_conversa="+id+"&id_usuario="+window.localStorage.getItem("usuario"));
	console.log("http://jobexpert.com.br/app/php/listar_mensagens.php?id_conversa="+id+"&id_usuario="+window.localStorage.getItem("usuario"));
	$("#mensagens").html(mensagens);
}

function enviarMensagem(){
	if($("#mensagem").val() == ""){
		document.getElementById("mensagem").focus();
		return
	}
	var dados = {
		id_usuario : window.localStorage.getItem("usuario"),
		id_conversa : id,
		mensagem : $("#mensagem").val()
	};
	var resposta = chamaBanco("http://jobexpert.com.br/app/php/enviar_mensagem.php?dados="+JSON.stringify(dados));
	console.log("http://jobexpert.com.br/app/php/enviar_mensagem.php?dados="+JSON.stringify(dados)); 
	document.getElementById("mensagem").value = "";
    document.getElementById("mensagem").focus();
}