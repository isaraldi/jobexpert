function mostrarEnderecos(){
	var enderecos = chamaBanco("http://www.edgex.com.br/bigpizzagigante/app/php/enderecos_perfil.php?id_usuario="+window.localStorage.getItem("usuario"));	
	$("#mostrarEnderecos").html(enderecos);
}

function editarEndereco(idEndereco){
	var resposta = chamaBanco("http://www.edgex.com.br/bigpizzagigante/app/php/editar_endereco.php?id_endereco="+idEndereco);
	resposta = JSON.parse(resposta);
	window.open("editar_endereco.html?id_endereco="+resposta.id_endereco);
}

function excluirEndereco(idEndereco){
    function onConfirm(button) {
        switch ( button ) {
            case 1: 
				var resposta = chamaBanco("http://www.edgex.com.br/bigpizzagigante/app/php/excluir_endereco.php?id_endereco="+idEndereco);
			    if(resposta == 1){
			        navigator.notification.alert(
			            "Endereço excluído com sucesso",  // message
			            null,
			            'Exclusão feita',            // title
			            'Fechar'                  // buttonName
			        );
			        window.open("enderecos_perfil.html");
			    }else if(resposta == 0){
			        navigator.notification.alert(
			            "Ocorreu algo errado",  // message
			            null,
			            'Ops',            // title
			            'Fechar'                  // buttonName
			        );
			    }
                break;
            case 2:                
                break;            
        }
    }

    navigator.notification.confirm(
        'Realmente deseja excluir o endereço?', // message
         onConfirm,            // callback to invoke with index of button pressed
        'Confirme a exclusão',           // title
        ['Excluir', 'Cancelar']    // buttonLabels
    );
}