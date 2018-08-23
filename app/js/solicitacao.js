var id_solicitacao;
var id_servico;

function popup(id){
	document.getElementById('primeira').style.display = "";
	document.getElementById('segunda').style.display = "none";
	document.getElementById('terceira').style.display = "none";
	$('.fundo').css('filter', 'blur(5px)');
	$('.fundo').css('pointer-events', 'none');
	$(".popup").css('animation','popup linear 0.5s');
	var id_soli = chamaBanco("http://jobexpert.com.br/app/php/solicitar_servico.php?id_servico="+id);
	console.log(id_soli);
	window.localStorage.setItem("id_solicitacao", id_soli);
	id_servico = id;
	id_solicitacao = id_soli;
	listarEstadosSolicitacao(id);
}

function popup2(){
	if($("#cidades").val() == "" || $("#estados").val() == ""){
		navigator.notification.alert(
            "É necessário selecionar um estado e uma cidade",  // messag
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        return;
	}else{
		var cidade = $("#cidades").val();
		var estado = $("#estados").val();
		var resposta = chamaBanco("http://jobexpert.com.br/app/php/adicionar_local.php?cidade="+cidade+"&estado="+estado+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
		console.log(resposta);

		document.getElementById('primeira').style.display = "none";
		document.getElementById('segunda').style.display = "";
		document.getElementById('terceira').style.display = "none";
		$('.fundo').css('pointer-events', 'none');
		$(".popup").css('animation','popup linear 0.5s');		
	}
}

function popup3(){
	if($("#rua").val() == "" || $("#numero").val() == ""){
		navigator.notification.alert(
            "É necessário informar a rua e o numero do seu endereco",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        return;
	}else{
		var rua = $("#rua").val();
		var numero = $("#numero").val();
		var complemento = $("#complemento").val();
		var resposta = chamaBanco("http://jobexpert.com.br/app/php/adicionar_endereco.php?rua="+rua+"&numero="+numero+"&complemento="+complemento+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
		console.log(resposta);

		document.getElementById('primeira').style.display = "none";
		document.getElementById('segunda').style.display = "none";
		document.getElementById('terceira').style.display = "";
		$('.fundo').css('pointer-events', 'none');
		$(".popup").css('animation','popup linear 0.5s');		
	}
}

function popup4(controle){
	document.getElementById('primeira').style.display = "none";
	document.getElementById('segunda').style.display = "none";
	document.getElementById('terceira').style.display = "none";
	if(controle == 0){
		document.getElementById('login-solicitacao').style.display = "none";
	}
	$('.fundo').css('filter', 'blur(0px)');
	$('.fundo').css('pointer-events', '');
	var respostaCancelar = chamaBanco("http://jobexpert.com.br/app/php/cancelar_solicitacao.php?id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
	console.log("http://jobexpert.com.br/app/php/cancelar_solicitacao.php?id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
	console.log(respostaCancelar);
	if(controle == 1){
		window.open("servicos.html");
	}else{
		window.open("index.html");
	}
	
}

function popup5(id_solicitacao, id_servico, id_cidade, controle){
	document.getElementById('terceira').style.display = "";
	$('.fundo').css('filter', 'blur(5px)');
	$('.fundo').css('pointer-events', 'none');
	$(".popup").css('animation','popup linear 0.5s');
	if(controle == 1){
		var resposta = JSON.parse(chamaBanco("http://jobexpert.com.br/app/php/detalhes_historico_usuario.php?id_solicitacao="+id_solicitacao+"&id_servico="+id_servico+"&id_cidade="+id_cidade));
		console.log(resposta);
		$("#servico").html(resposta.servico);
		$("#cidade").html(resposta.cidade);
		var endereco = "Rua "+resposta.rua+", n "+resposta.numero+", "+resposta.complemento
		$("#endereco").html(endereco);
		var descricao = resposta.descricao;
		$("#descricao").html(descricao);
	}else{
		console.log("http://jobexpert.com.br/app/php/detalhes_historico_prestador.php?id_solicitacao="+id_solicitacao+"&id_servico="+id_servico+"&id_cidade="+id_cidade);
		var resposta = JSON.parse(chamaBanco("http://jobexpert.com.br/app/php/detalhes_historico_prestador.php?id_solicitacao="+id_solicitacao+"&id_servico="+id_servico+"&id_cidade="+id_cidade));
		console.log(resposta);
		$("#servico").html(resposta.servico);
		$("#cidade").html(resposta.cidade);
		var endereco = "Rua "+resposta.rua+", n "+resposta.numero+", "+resposta.complemento
		$("#endereco").html(endereco);
		var descricao = resposta.descricao;
		$("#descricao").html(descricao);
	}
}

function popup6(){
	document.getElementById('terceira').style.display = "none";
	$('.fundo').css('filter', 'blur(0px)');
	$('.fundo').css('pointer-events', '');

}

function popup8(){
	document.getElementById('cadastro').style.display = "none";
	document.getElementById('cadastroPrestador').style.display = "";
	$('.fundo').css('filter', 'blur(5px)');
	$('.fundo').css('pointer-events', 'none');
	$(".popup").css('animation','popup linear 0.5s');
}

function popup9(){
	document.getElementById('cadastroPrestador').style.display = "none";
	$('.fundo').css('filter', 'blur(0px)');
	$('.fundo').css('pointer-events', '');
}

function popup10(){
	document.getElementById('cadastroPrestador').style.display = "none";
	$('.fundo').css('filter', 'blur(0px)');
	$('.fundo').css('pointer-events', '');
	var dados = {
		nome : $("#nomePrestador").val(),
		email : $("#emailPrestador").val(),
		doc : $("#cpfPrestador").val(),
		senha : $("#senhaCadastroPrestador").val(),
		confirma : $("#confirmarSenhaPrestador").val(),
		estado : $("estadosPrestador").val(),
		cidade : $("#cidadesPrestador").val(),
		servicos : $("#servicosCadastro").val()
	};
	console.log(JSON.stringify(dados));
}

function popup7(){
	if($("#descricao").val() == ""){
		navigator.notification.alert(
            "É necessário informar o seu descricao",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        return;
	}else{
		var descricao = $("#descricao").val();
		var resposta = chamaBanco("http://jobexpert.com.br/app/php/adicionar_descricao.php?descricao="+descricao+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
		console.log(resposta);

		document.getElementById('login-solicitacao').style.display = "";
		document.getElementById('terceira').style.display = "none";
		$('.fundo').css('filter', 'blur(5px)');
		$('.fundo').css('pointer-events', 'none');
		$(".popup").css('animation','popup linear 0.5s');
	}
}

function cancelarSolicitacao(id){
	function onConfirm(buttonIndex) {
		if(buttonIndex == 2){			
			var respostaCancelar = chamaBanco("http://jobexpert.com.br/app/php/cancelar_solicitacao.php?id_solicitacao="+id);
			console.log("http://jobexpert.com.br/app/php/cancelar_solicitacao.php?id_solicitacao="+id);
			if(respostaCancelar == 1){
				navigator.notification.alert(
		            "solicitação cancelada com sucesso",  // message
		            null,
		            'Cancelada',            // title
		            'Fechar'                  // buttonName
		        );
		        location.reload();
			}	
		}
	}
	navigator.notification.confirm(
	    'Realmente deseja cancelar a solicitação?', // message
	     onConfirm,            // callback to invoke with index of button pressed
	    'Confirmar',           // title
	    ['Cancelar','Confirmar']     // buttonLabels
	);

	
}

function confirmarSolicitacao(){
	var descricao = $("#descricao").val();
	var resposta = chamaBanco("http://jobexpert.com.br/app/php/adicionar_descricao.php?descricao="+descricao+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
	console.log(resposta);
	var respostaConfirmação = chamaBanco("http://jobexpert.com.br/app/php/adicionar_usuario.php?id_solicitacao="+window.localStorage.getItem("id_solicitacao")+"&usuario="+window.localStorage.getItem("usuario"));
	console.log(respostaConfirmação);
	if(respostaConfirmação == 1){
		mandarPushSolicitacao("Nova solicitacao", "Há uma nova solicitação que pode ser aceita!", window.localStorage.getItem("id_solicitacao"));
		navigator.notification.alert(
            "Solicitação realizada com sucesso, quando houver um prestador diponível, você receberá uma notificação",  // message
            null,
            'Parabéns',            // title
            'Fechar'                  // buttonName
        );
    	window.location.href='historico_usuario.html'; 
    }
}

function loginSolicitacao(){
    var login = {
        email: $("#emailSolicitacao").val(),
        senha: $("#senhaSolicitacao").val(),
        gcm: localStorage.getItem('registrationId')
    };    

    var id_usuario = JSON.parse(chamaBanco("http://jobexpert.com.br/app/php/login.php?email="+login.email+"&senha="+login.senha+"&gcm="+login.gcm));
    console.log(id_usuario);
    
    if(id_usuario.id == -1){
    	navigator.notification.alert(
            'Você ainda não verificou o seu e-mail!',  // message
            null,         // callback
            'Ops!',            // title
            'Fechar'                  // buttonName
        );
        return;
    }else if(id_usuario.id!=0){
        window.localStorage.setItem("usuario", id_usuario.id);
        window.localStorage.setItem("status", 1);        
        var resposta = chamaBanco("http://jobexpert.com.br/app/php/adicionar_usuario.php?usuario="+id_usuario.id+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
		console.log(resposta);
		if(resposta == 1){
			 mandarPushSolicitacao("Nova solicitacao", "Há uma nova solicitação que pode ser aceita!", window.localStorage.getItem("id_solicitacao"));
			navigator.notification.alert(
	            "Solicitação realizada com sucesso, quando houver um prestador diponível, você receberá uma notificação",  // message
	            null,
	            'Parabéns',            // title
	            'Fechar'                  // buttonName
	        );
	        
	    	window.location.href='historico_usuario.html'; 
		}
    }else{
        navigator.notification.alert(
            'Usuário ou senha incorretos',  // message
            null,         // callback
            'Ops!',            // title
            'Fechar'                  // buttonName
        );

    }
}

function login(){
    var email = $("#email").val();
   	var senha = $("#senha").val(); 
   	var gcm = localStorage.getItem('registrationId');   

    var id_usuario = JSON.parse(chamaBanco("http://jobexpert.com.br/app/php/login.php?email="+email+"&senha="+senha+"&gcm="+gcm));
    console.log("http://jobexpert.com.br/app/php/login.php?email="+email+"&senha="+senha+"&gcm="+gcm);
    console.log(id_usuario);
    
    if(id_usuario.id == -1){
    	navigator.notification.alert(
            'Você ainda não verificou o seu e-mail!',  // message
            null,         // callback
            'Ops!',            // title
            'Fechar'                  // buttonName
        );
        return;
    }else if(id_usuario.id != 0){
        window.localStorage.setItem("usuario", id_usuario.id);
        window.localStorage.setItem("status", id_usuario.status);
        if(id_usuario.status == 1){
        	window.location.href='servicos.html';
    	}else{
    		window.location.href='solicitacoes.html';
    	}
    }else{
        navigator.notification.alert(
            'Usuário ou senha incorretos',  // message
            null,         // callback
            'Ops!',            // title
            'Fechar'                  // buttonName
        );

    }
}



var menu = true;
function popupAnimation(id){
	if (menu) {
		$(".popup").css('animation','popup linear 0.5s');
		document.getElementById(id).style.display = '';
		$('.fundo').css('filter', 'blur(5px)');
		$('.fundo').css('pointer-events', 'none');
		menu = false;
	}else{
		$(".popup").css('animation','popupSair linear 0.2s');
		$('.fundo').css('filter', 'blur(0px)');
		$('.fundo').css('pointer-events', '');
		 setTimeout(
            function() {
                document.getElementById(id).style.display = 'none';
            },
            200);
		menu = true;
	}
}

function popupCadastro(){
	document.getElementById('cadastro-solicitacao').style.display = "";
	document.getElementById('login-solicitacao').style.display = "none";
	$('.fundo').css('filter', 'blur(5px)');
	$('.fundo').css('pointer-events', 'none');
	$(".popup").css('animation','popup linear 0.5s');
}

function popupCancelarCadastro(){
	$(".popup").css('animation','popupSair linear 0.2s');
	$('.fundo').css('filter', 'blur(0px)');
	$('.fundo').css('pointer-events', '');
	setTimeout(
        function() {
            document.getElementById("cadastro-solicitacao").style.display = 'none';
        },
    200);
    var respostaCancelar = chamaBanco("http://jobexpert.com.br/app/php/cancelar_solicitacao.php?id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
	console.log("http://jobexpert.com.br/app/php/cancelar_solicitacao.php?id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
	console.log(respostaCancelar);
}

function mostrarSolicitacoes(){
	var listaSolicitacoes = chamaBanco("http://jobexpert.com.br/app/php/solicitacoes.php?id_usuario="+window.localStorage.getItem("usuario"));
	//console.log(listaSolicitacoes);
    $("#listaSolicitacoes").html(listaSolicitacoes);
}

function aceitarSolicitacao(id){
	var resposta = chamaBanco("http://jobexpert.com.br/app/php/aceitar_solicitacao.php?id_solicitacao="+id+"&id_usuario="+window.localStorage.getItem("usuario"));
	console.log(resposta);
	if(resposta == 1){
		navigator.notification.alert(
            'Serviço aceito com sucesso',  // message
            null,         // callback
            'Aceito!',            // title
            'Fechar'                  // buttonName
        );
        mandarPushInteressado("Novo interessado", "Há um novo prestador interessado no serviço! Abra o aplicativo e clique em Ver Interessados para saber quem é, se quiser poderá aceita-lo!", id);
        window.location.href='historico_prestador.html';
	}	
}

function cancelarServico(id){
	function onConfirm(buttonIndex) {
		if(buttonIndex == 2){			
			var respostaCancelar = chamaBanco("http://jobexpert.com.br/app/php/cancelar_servico.php?id_solicitacao="+id);
			console.log(respostaCancelar);
			if(respostaCancelar == 1){
				navigator.notification.alert(
		            'Serviço cancelado com sucesso',  // message
		            null,         // callback
		            'Cancelado!',            // title
		            'Fechar'                  // buttonName
		        );
		        window.location.href='historico_prestador.html';
			}
		}
	}
	navigator.notification.confirm(
	    'Realmente deseja cancelar o serviço?', // message
	     onConfirm,            // callback to invoke with index of button pressed
	    'Cancelar serviço',           // title
	    ['Cancelar','Confirmar']     // buttonLabels
	);
	
}

function listarServicos(){
    var listaServicos = chamaBanco("http://jobexpert.com.br/app/php/listar_servicos_index.php");
    $("#servicos").html(listaServicos);
}

function listarServicosCadastro(){
    var listaServicos = chamaBanco("http://jobexpert.com.br/app/php/listar_servicos_cadastro.php");;
    $("#servicosCadastro").html(listaServicos);
}

function listarEstados(){
    var listaEstados = chamaBanco("http://jobexpert.com.br/app/php/listar_estados.php");
    $("#estados").html(listaEstados);
    $("#estadosPrestador").html(listaEstados);
    //console.log(listaEstados);
}

function listarEstadosSolicitacao(id_servico){
    var listaEstados = chamaBanco("http://jobexpert.com.br/app/php/listar_estados_solicitacao.php?id_servico="+id_servico);
    console.log("http://jobexpert.com.br/app/php/listar_estados_solicitacao.php?id_servico="+id_servico);
    $("#estados").html(listaEstados);
    //$("#estadosPrestador").html(listaEstados);
    //console.log(listaEstados);
}

function listarCidadesSolicitacao(id_estado){
	console.log(id_estado);
    var listaCidades = chamaBanco("http://jobexpert.com.br/app/php/listar_cidades_solicitacao.php?estado="+id_estado+"&id_servico="+id_servico);
    console.log("http://jobexpert.com.br/app/php/listar_cidades_solicitacao.php?estado="+id_estado+"&id_servico="+id_servico);
    $("#cidades").html(listaCidades);
}

function listarCidades(id_estado, i){
	//console.log(id_estado);

    var listaCidades = chamaBanco("http://jobexpert.com.br/app/php/listar_cidades.php?estado="+id_estado);
    $("#cidades").html(listaCidades);
    var id = "cidadesPrestador"+i;
    $("#"+id).html(listaCidades);
}

function listarHistoricoUsuario(){
    var historicoUsuario = chamaBanco("http://jobexpert.com.br/app/php/historico_usuario.php?id_usuario="+window.localStorage.getItem("usuario"));
    $("#historicoUsuario").html(historicoUsuario);	
}

function listarHistoricoPrestador(){
    var historicoPrestador = chamaBanco("http://jobexpert.com.br/app/php/historico_prestador.php?id_usuario="+window.localStorage.getItem("usuario"));
    $("#historicoPrestador").html(historicoPrestador);	
}

function apagarSolicitacao(id_solicitacao){
	function onConfirm(buttonIndex) {
		if(buttonIndex == 2){			
			var resposta = chamaBanco("http://jobexpert.com.br/app/php/apagar_solicitacao.php?id_solicitacao="+id_solicitacao);
			if(resposta == 1){
			 	navigator.notification.alert(
		            'Solicitação apagada com sucesso',  // message
		            null,         // callback
		            'Apagado!',            // title
		            'Fechar'                  // buttonName
		        );
		        if(window.localStorage.getItem("status") == 1){
		        	window.location.href='historico_usuario.html';
		        }else{
		        	window.location.href='historico_prestador.html';
		        }
		        
			}else{
				navigator.notification.alert(
		            'Ocorreu algo errado',  // message
		            null,         // callback
		            'ops!',            // title
		            'Fechar'                  // buttonName
		        );
			}
		}else{
			return
		}
	}
	navigator.notification.confirm(
	    'Realmente deseja apagar o serviço?', // message
	     onConfirm,            // callback to invoke with index of button pressed
	    'Cancelar serviço',           // title
	    ['Cancelar','Confirmar']     // buttonLabels
	);	 
}

function recusarServico(id_solicitacao){
	var resposta = chamaBanco("http://jobexpert.com.br/app/php/recusar_servico.php?id_solicitacao="+id_solicitacao);
    console.log("http://jobexpert.com.br/app/php/recusar_servico.php?id_solicitacao="+id_solicitacao);
    if(resposta == 1){
    	navigator.notification.alert(
            'Solicitação recusada com sucesso',  // message
            null,         // callback
            'Recusada!',            // title
            'Fechar'                  // buttonName
        );
        location.reload();
	}
}

function mandarPushSolicitacao(titulo, mensagem, id){   
    var push = chamaBanco("http://jobexpert.com.br/app/php/push_solicitacao.php?titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
    console.log("http://jobexpert.com.br/app/php/push_solicitacao.php?titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
}

function mandarPushInteressado(titulo, mensagem, id){   
    var push = chamaBanco("http://jobexpert.com.br/app/php/push_interessado.php?titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
    console.log("http://jobexpert.com.br/app/php/push_interessado.php?titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
}

