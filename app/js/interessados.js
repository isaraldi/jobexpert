function mostrarInteressados(id){
	var interessados = chamaBanco("http://jobexpert.com.br/app/php/interessados.php?id_solicitacao="+id);
	window.localStorage.setItem("id_solicitacao", id);
	$("#interessados").html(interessados);
	console.log(interessados);
}

function mostrarPerfilPrestador(id){
	var perfilPrestador = chamaBanco("http://jobexpert.com.br/app/php/perfil_prestador.php?id_prestador="+id);
	$("#mostrarPerfilPrestador").html(perfilPrestador);
}

function mostrarAvaliacoes(){
	var avaliacoes = chamaBanco("http://jobexpert.com.br/app/php/avaliacoes.php?id_prestador="+window.localStorage.getItem("id_prestador"));
	$("#avaliacoes").html(avaliacoes);
}

function aceitarPrestador(id_prestador, id_solicitacao, id_usuario){
	var resposta = chamaBanco("http://jobexpert.com.br/app/php/aceitar_prestador.php?id_prestador="+id_prestador+"&id_usuario="+id_usuario+"&id_solicitacao="+id_solicitacao);
    console.log("http://jobexpert.com.br/app/php/aceitar_prestador.php?id_prestador="+id_prestador+"&id_usuario="+id_usuario+"&id_solicitacao="+id_solicitacao);
	if(resposta == 1){
		navigator.notification.alert(
            "Prestador aceito com sucesso",  // message
            null,
            'Sucesso',            // title
            'Fechar'                  // buttonName
        );
        mandarPush("Prestador escolhido", "O usuário o aceitou como prestador para o serviço solicitado, entre em contato pelo chat!", id_prestador);
        window.open("historico_usuario.html");
	}else{
		navigator.notification.alert(
            "Ocorreu algum erro!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
	}
}

function recusarPrestador(id_prestador, id_solicitacao){
    var resposta = chamaBanco("http://jobexpert.com.br/app/php/recusar_prestador.php?id_prestador="+id_prestador+"&id_solicitacao="+id_solicitacao);
    console.log("http://jobexpert.com.br/app/php/recusar_prestador.php?id_prestador="+id_prestador+"&id_solicitacao="+id_solicitacao);
    if(resposta == 1){
        navigator.notification.alert(
            "Prestador recusado com sucesso",  // message
            null,
            'Sucesso',            // title
            'Fechar'                  // buttonName
        );
        window.open("historico_usuario.html");
    }else{
        navigator.notification.alert(
            "Ocorreu algum erro!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }
}

function solicitarOutroPrestador(id_solicitacao){
	var resposta = chamaBanco("http://jobexpert.com.br/app/php/solicitar_outro_prestador.php?id_solicitacao="+id_solicitacao);
	if(resposta == 1){
		navigator.notification.alert(
            "Solicitação realizada com sucesso",  // message
            null,
            'Sucesso',            // title
            'Fechar'                  // buttonName
        );
        mandarPushSolicitacao("Nova solicitacao", "Há uma nova solicitação para que pode ser aceita!", id_solicitacao);
        window.open("historico_usuario.html");
	}else{
		navigator.notification.alert(
            "Ocorreu algum erro!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
	}
}
var avaliado = 0;
var id_solicitacao;

function finalizarServico(id){
    id_solicitacao = id;
	var resposta = chamaBanco("http://jobexpert.com.br/app/php/finalizar_servico.php?id_solicitacao="+id);
    console.log(resposta);
	if(resposta == 1){
        document.getElementById('avaliacao').style.display = "";
        $('.fundo').css('filter', 'blur(5px)');
        $('.fundo').css('pointer-events', 'none');
        $(".popup").css('animation','popup linear 0.5s');
		// navigator.notification.alert(
  //           "Serviço finalizado com sucesso",  // message
  //           null,
  //           'Sucesso',            // title
  //           'Fechar'                  // buttonName
  //       );
  //       window.open("historico_usuario.html");
	}else{
		navigator.notification.alert(
            "Ocorreu algum erro!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
	}
}

function cancelarServicoAceito(id_solicitacao){
    var resposta = chamaBanco("http://jobexpert.com.br/app/php/cancelar_servico_aceito.php?id_solicitacao="+id_solicitacao);
    if(resposta == 1){
        navigator.notification.alert(
            "Serviço cancelado com sucesso",  // message
            null,
            'Sucesso',            // title
            'Fechar'                  // buttonName
        );
        mandarPushSolicitacao("Nova solicitacao", "Há uma nova solicitação para que pode ser aceita!", id_solicitacao);
        window.open("historico_prestador.html");
    }else{
        navigator.notification.alert(
            "Ocorreu algum erro!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }
}

function cancelarServicoInteressado(id_solicitacao, id_prestador){
    var resposta = chamaBanco("http://jobexpert.com.br/app/php/cancelar_servico_interessado.php?id_solicitacao="+id_solicitacao+"&id_prestador="+id_prestador);
    if(resposta == 1){
        navigator.notification.alert(
            "Serviço cancelado com sucesso",  // message
            null,
            'Sucesso',            // title
            'Fechar'                  // buttonName
        );
        window.open("historico_prestador.html");
    }else{
        navigator.notification.alert(
            "Ocorreu algum erro!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }
}

function mostrarDadosPrestador(id){
    
    var dados = chamaBanco("http://jobexpert.com.br/app/php/dados_prestador_avaliacao.php?&id_solicitacao="+id);
    console.log(dados);
    $("#prestador").html(dados);
}

function avaliar(num){
    avaliado = num;
    switch(num){
        case 1:
            $("#estrela1").attr("src","img/star_full.png");
            $("#estrela2").attr("src","img/star_nocolor.png");
            $("#estrela3").attr("src","img/star_nocolor.png");
            $("#estrela4").attr("src","img/star_nocolor.png");
            $("#estrela5").attr("src","img/star_nocolor.png");
            break;
        case 2:
            $("#estrela1").attr("src","img/star_full.png");
            $("#estrela2").attr("src","img/star_full.png");
            $("#estrela3").attr("src","img/star_nocolor.png");
            $("#estrela4").attr("src","img/star_nocolor.png");
            $("#estrela5").attr("src","img/star_nocolor.png");
            break;
        case 3:
            $("#estrela1").attr("src","img/star_full.png");
            $("#estrela2").attr("src","img/star_full.png");
            $("#estrela3").attr("src","img/star_full.png");
            $("#estrela4").attr("src","img/star_nocolor.png");
            $("#estrela5").attr("src","img/star_nocolor.png");
            break;
        case 4:
            $("#estrela1").attr("src","img/star_full.png");
            $("#estrela2").attr("src","img/star_full.png");
            $("#estrela3").attr("src","img/star_full.png");
            $("#estrela4").attr("src","img/star_full.png");
            $("#estrela5").attr("src","img/star_nocolor.png");
            break;
        case 5:
            $("#estrela1").attr("src","img/star_full.png");
            $("#estrela2").attr("src","img/star_full.png");
            $("#estrela3").attr("src","img/star_full.png");
            $("#estrela4").attr("src","img/star_full.png");
            $("#estrela5").attr("src","img/star_full.png");
            break;
    }
}

function enviarAvaliacao(id_solicitacao){
    //alert(id_solicitacao);
    var status = window.localStorage.getItem("status");
    if(avaliado == 0){
        navigator.notification.alert(
            "É necessário dar uma nota para o avaliador!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        return;
    }else{
        var comentario = $("#comentario").val();
        resposta = chamaBanco("http://jobexpert.com.br/app/php/enviar_avaliacao.php?&id_solicitacao="+id_solicitacao+"&avaliacao="+avaliado+"&comentario="+comentario+"&status="+status);

        console.log("http://jobexpert.com.br/app/php/enviar_avaliacao.php?&id_solicitacao="+id_solicitacao+"&avaliacao="+avaliado+"&comentario="+comentario+"&status="+status);
        if(resposta == 1){
            navigator.notification.alert(
                "sua avaliação foi enviada com sucesso!",  // message
                null,
                'Obrigado',            // title
                'Fechar'                  // buttonName
            );
            if(status == 1){
                window.open("servicos.html");
            }else{
                window.open("solicitacoes.html");
            }
            
        }
    }
}

function mandarPush(titulo, mensagem, id){
    var push = chamaBanco("http://jobexpert.com.br/app/php/push.php??titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
    console.log("http://jobexpert.com.br/app/php/push.php??titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
}

function mandarPushSolicitacao(titulo, mensagem, id){   
    var push = chamaBanco("http://jobexpert.com.br/app/php/push_solicitacao.php??titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
    console.log("http://jobexpert.com.br/app/php/push_solicitacao.php??titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
}