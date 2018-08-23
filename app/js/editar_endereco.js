var id_endereco;
function mostrarInformacoes(id){
    id_endereco = id;
	var resposta = chamaBanco("http://www.edgex.com.br/bigpizzagigante/app/php/editar_endereco.php?id_endereco="+id);
	resposta = JSON.parse(resposta);
	$("#nomeEndereco").val(resposta.nome_endereco);
    $("#rua").val(resposta.rua);
	$("#numero").val(resposta.numero);
	$("#complemento").val(resposta.complemento);
	$("#cep").val(resposta.cep);
	$("#bairro").val(resposta.bairro);
	$("#telefone").val(resposta.telefone);
	$("#cidade").val(resposta.cidade);
	$("#referencia").val(resposta.ponto_referencia);
}

function validarDados() {
    var endereco = {
        nomeEndereco: $("#nomeEndereco").val(),
        rua: $("#rua").val(),
        numero: $("#numero").val(),
        complemento: $("#complemento").val(),
        cep: $("#cep").val(),
        bairro: $("#bairro").val(),
        telefone: $("#telefone").val(),
        cidade: $("#cidade").val(),
        referencia: $("#referencia").val(),
        id_end: id_endereco,
        id_usuario: window.localStorage.getItem("usuario")
    };

    if(endereco.nomeEndereco == ""){
        $("#nomeEndereco").css("border", "1px solid");
        $("#nomeEndereco").css("border-color", "red");
        $("#nomeEndereco").focus();

        $("#rua").css("border", "0px");
        $("#numero").css("border", "0px");
        $("#complemento").css("border", "0px");
        $("#cep").css("border", "0px");
        $("#bairo").css("border", "0px");
        $("#telefone").css("border", "0px");
        $("#cidade").css("border", "0px");
    }else if(endereco.rua == ""){        
        $("#rua").css("border", "1px solid");
        $("#rua").css("border-color", "red");
        $("#rua").focus();

        $("#nomeEndereco").css("border", "0px");
        $("#numero").css("border", "0px");
        $("#complemento").css("border", "0px");
        $("#cep").css("border", "0px");
        $("#bairo").css("border", "0px");
        $("#telefone").css("border", "0px");
        $("#cidade").css("border", "0px");
    }else if(endereco.numero == ""){
        $("#numero").css("border", "1px solid");
        $("#numero").css("border-color", "red");
        $("#numero").focus();

        $("#nomeEndereco").css("border", "0px");
        $("#rua").css("border", "0px");
        $("#complemento").css("border", "0px");
        $("#cep").css("border", "0px");
        $("#bairo").css("border", "0px");
        $("#telefone").css("border", "0px");
        $("#cidade").css("border", "0px");
    }else if(endereco.complemento == ""){
        $("#complemento").css("border", "1px solid");
        $("#complemento").css("border-color", "red");
        $("#complemento").focus();

        $("#nomeEndereco").css("border", "0px");
        $("#rua").css("border", "0px");
        $("#numero").css("border", "0px");
        $("#cep").css("border", "0px");
        $("#bairo").css("border", "0px");
        $("#telefone").css("border", "0px");
        $("#cidade").css("border", "0px");
    }else if(endereco.cep == ""){
        $("#cep").css("border", "1px solid");
        $("#cep").css("border-color", "red");
        $("#cep").focus();

        $("#nomeEndereco").css("border", "0px");
        $("#rua").css("border", "0px");
        $("#numero").css("border", "0px");
        $("#complemento").css("border", "0px");
        $("#bairo").css("border", "0px");
        $("#telefone").css("border", "0px");
        $("#cidade").css("border", "0px");
    }else if(endereco.bairro == ""){
        $("#bairro").css("border", "1px solid");
        $("#bairo").css("border-color", "red");
        $("#bairro").focus();

        $("#nomeEndereco").css("border", "0px");
        $("#rua").css("border", "0px");
        $("#numero").css("border", "0px");
        $("#complemento").css("border", "0px");
        $("#cep").css("border", "0px");
        $("#telefone").css("border", "0px");
        $("#cidade").css("border", "0px");
    }else if(endereco.telefone == ""){
        $("#telefone").css("border", "1px solid");
        $("#telefone").css("border-color", "red");
        $("#telefone").focus();

        $("#nomeEndereco").css("border", "0px");
        $("#rua").css("border", "0px");
        $("#numero").css("border", "0px");
        $("#complemento").css("border", "0px");
        $("#cep").css("border", "0px");
        $("#bairro").css("border", "0px");
        $("#cidade").css("border", "0px");
    }else if(endereco.cidade == ""){
        $("#cidade").css("border", "1px solid");
        $("#cidade").css("border-color", "red");
        $("#cidade").focus();

        $("#nomeEndereco").css("border", "0px");
        $("#rua").css("border", "0px");
        $("#numero").css("border", "0px");
        $("#complemento").css("border", "0px");
        $("#cep").css("border", "0px");
        $("#bairro").css("border", "0px");
        $("#telefone").css("border", "0px");
    }else{
        atualizarEndereco(endereco);
    }
}

function atualizarEndereco(endereco){
    var json = JSON.stringify(endereco);
    var banco = chamaBanco("http://www.edgex.com.br/bigpizzagigante/app/php/atualizar_endereco.php?dados="+json);
    if(banco == 1){
        navigator.notification.alert(
            "Endereço atualizado com sucesso",  // message
            null,
            'Parabéns',            // title
            'Fechar'                  // buttonName
        );
        window.open("enderecos_perfil.html");
    }else if(banco == 0){
        navigator.notification.alert(
            "Ocorreu algo errado",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }
}