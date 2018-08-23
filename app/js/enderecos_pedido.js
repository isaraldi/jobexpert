function mostrarEnderecos(){
	var enderecos = chamaBanco("http://www.edgex.com.br/bigpizzagigante/app/php/enderecos_pedido.php?id_usuario="+window.localStorage.getItem("usuario"));	
	$("#mostrarEnderecos").html(enderecos);
}

function editarEndereco(idEndereco){
	var resposta = chamaBanco("http://www.edgex.com.br/bigpizzagigante/app/php/editar_endereco.php?id_endereco="+idEndereco);
	resposta = JSON.parse(resposta);
	window.open("editar_endereco.html?id_endereco="+resposta.id_endereco);
}

function escolherEndereco(idEndereco, nome){
	alert(nome);
    window.localStorage.setItem("id_endereco", idEndereco);
    window.localStorage.setItem("nome_endereco", nome);
    window.open("revisar_pedido.html");
}