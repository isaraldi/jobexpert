var senhaConfirmacao;
function mostrarInformacoes(){
    if(window.localStorage.getItem("status") == 1){
        var resposta = chamaBanco("http://jobexpert.com.br/app/php/mostrar_perfil.php?id_usuario="+window.localStorage.getItem("usuario"));
        resposta = JSON.parse(resposta);
        $("#nome").val(resposta.nome);
        $("#email").val(resposta.email);
        if(resposta.senha == ""){
            $("#senha").css("display","none");
            $("#novaSenha").css("display","none");
            $("#confirmarNovaSenha").css("display","none");
        }
    }else{
        var resposta = chamaBanco("http://jobexpert.com.br/app/php/mostrar_perfil_prestador.php?id_usuario="+window.localStorage.getItem("usuario"));
        resposta = JSON.parse(resposta);
        //console.log(resposta);
        $("#nome").val(resposta.nome);
        $("#email").val(resposta.email);
        $("#servico").html(resposta.html);
        senhaConfirmacao = resposta.senha;
    }
}

function editarPerfil(cliente){

    if(cliente.senhaNova != ""){
        if(cliente.senha != cliente.senhaConfirmacao){
            navigator.notification.alert(
                "Senha incorreta",  // message
                null,
                'Ops',            // title
                'Ok'                  // buttonName
            );
            $("#senha").focus();
            return;
        }

        if(cliente.senhaNova != cliente.confirmacao){
            navigator.notification.alert(
                "Senhas diferentes",  // message
                null,
                'Ops',            // title
                'Ok'                  // buttonName
            );
            $("#senha").val("");
            $("#novaSenha").val("");
            $("#confirmarNovaSenha").focus();
            return;
        }
    }

    var re = /\S+@\S+\.\S+/;
    if( !re.test(cliente.email)){
        navigator.notification.alert(
            "Email deve ser no formato usuario@email.com",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        $("#email").focus();
        return;
    }

    var json = JSON.stringify(cliente);
    if(window.localStorage.getItem("status") == 1){
        var banco = chamaBanco("http://jobexpert.com.br/app/php/editar_perfil.php?dados="+json);
    }else{
        console.log("http://jobexpert.com.br/app/php/editar_perfil_prestador.php?dados="+json+"&servicos="+$("#servico").val());
        var banco = chamaBanco("http://jobexpert.com.br/app/php/editar_perfil_prestador.php?dados="+json+"&servicos="+$("#servico").val());
    }
    if(banco == 2){
        navigator.notification.alert(
            "Senha atual incorreta",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        popupAnimation('editarInformacoes');
    }else if(banco==1){
        navigator.notification.alert(
            "Dados alterados com sucesso",  // message
            null,
            'Alteração feita',            // title
            'Fechar'                  // buttonName
        );
        if(window.localStorage.getItem("status") == 1){
            window.open("minha_conta.html");
        }else{
            window.open("minha_conta_prestador.html");
        }
    }else{
        navigator.notification.alert(
            "Ocorreu algo errado",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }
}


function validarDados() {
    var cliente = {
        id_usuario: window.localStorage.getItem("usuario"), 
        nome: $("#nome").val(),
        email: $("#email").val(),
        senha: $("#senha").val(),
        senhaNova: $("#novaSenha").val(),
        confirmacao: $("#confirmarNovaSenha").val()
    };

    if(cliente.nome == ""){
        $("#nome").css("border", "1px solid");
        $("#nome").css("border-color", "red");
        $("#nome").focus();

        $("#email").css("border", "0px");
        $("#senha").css("border", "0px");
        $("#confirmarNovaSenha").css("border", "0px");
    }else if(cliente.email == ""){        
        $("#email").css("border", "1px solid");
        $("#email").css("border-color", "red");
        $("#email").focus();

        $("#nome").css("border", "0px");
        $("#senha").css("border", "0px");
        $("#confirmarNovaSenha").css("border", "0px");
    }else if(cliente.senha == "" && $("#senha").css("display") != "none") {
        navigator.notification.alert(
            "É necessário inserir a senha para alterar informações do perfil",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        $("#senha").css("border", "1px solid");
        $("#senha").css("border-color", "red");
        $("#senha").focus();

        $("#nome").css("border", "0px");
        $("#email").css("border", "0px");
        $("#confirmarNovaSenha").css("border", "0px");
    }else{
        editarPerfil(cliente);
    }
}

function validarDadosPrestador() {
    var cliente = {
        id_usuario: window.localStorage.getItem("usuario"), 
        nome: $("#nome").val(),
        email: $("#email").val(),
        senha: $("#senha").val(),
        senhaNova: $("#novaSenha").val(),
        confirmacao: $("#confirmarNovaSenha").val()
    };

    if(cliente.nome == ""){
        $("#nome").css("border", "1px solid");
        $("#nome").css("border-color", "red");
        $("#nome").focus();

        $("#email").css("border", "0px");
        $("#senha").css("border", "0px");
        $("#servico").css("border", "0px");
        $("#confirmarNovaSenha").css("border", "0px");
    }else if(cliente.email == ""){        
        $("#email").css("border", "1px solid");
        $("#email").css("border-color", "red");
        $("#email").focus();

        $("#nome").css("border", "0px");
        $("#senha").css("border", "0px");
        $("#servico").css("border", "0px");
        $("#confirmarNovaSenha").css("border", "0px");
    }else if(cliente.servico == ""){        
        $("#servico").css("border", "1px solid");
        $("#servico").css("border-color", "red");
        $("#servico").focus();

        $("#email").css("border", "0px");
        $("#nome").css("border", "0px");
        $("#senha").css("border", "0px");
        $("#confirmarNovaSenha").css("border", "0px");
    }else if(cliente.senha == "" && $("#senha").css("display") != "none") {
        navigator.notification.alert(
            "É necessário inserir a senha para alterar informações do perfil",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        $("#senha").css("border", "1px solid");
        $("#senha").css("border-color", "red");
        $("#senha").focus();

        $("#nome").css("border", "0px");
        $("#email").css("border", "0px");
        $("#confirmarNovaSenha").css("border", "0px");
    }else{
        editarPerfil(cliente);
    }
}