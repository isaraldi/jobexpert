function cadastrarUsuario(usuario){
     if(validarCPF(usuario.cpf) == false){
        navigator.notification.alert(
            "CPF inválido!",  // message
            null,
            'Ops',            // title
            'Ok'                  // buttonName
        );
        $("#cpf").focus();
        return;
    }

    if(usuario.senha != usuario.confirmacao){
        navigator.notification.alert(
            "Senhas diferentes",  // message
            null,
            'Ops',            // title
            'Ok'                  // buttonName
        );

        $("#senhaCadastro").val("");
        $("#confirmarSenha").val("");
        $("#senhaCadastro").focus();
        return;
    }

    var re = /\S+@\S+\.\S+/;
    if( !re.test(usuario.email)){
        navigator.notification.alert(
            "Email deve ser no formato usuario@email.com",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        $("#emailCadastro").focus();
        return;
    }

    var json = JSON.stringify(usuario);
    var banco = chamaBanco("http://jobexpert.com.br/app/php/cadastro.php?dados="+json);
    console.log("http://jobexpert.com.br/app/php/cadastro.php?dados="+json);
    console.log(banco);
    if(banco==-1){
        navigator.notification.alert(
            "CPF já cadastrado!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }else if(banco==-2){
        navigator.notification.alert(
            "E-mail já cadastrado!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }else if(banco==0){
        navigator.notification.alert(
            "Ocorreu algo errado",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );        
    }else{
        window.localStorage.setItem("usuario", banco);
        window.localStorage.setItem("status", 1); 
        if(window.localStorage.getItem("controle") == 1){
            var resposta = chamaBanco("http://jobexpert.com.br/app/php/adicionar_usuario.php?usuario="+window.localStorage.getItem("usuario")+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));

            console.log("http://jobexpert.com.br/app/php/adicionar_usuario.php?usuario="+window.localStorage.getItem("usuario")+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
            if(resposta == 1){
                mandarPushSolicitacao("Nova solicitacao", "Há uma nova solicitação que pode ser aceita!", window.localStorage.getItem("id_solicitacao"));
                chamaBanco("http://jobexpert.com.br/app/php/verificacao_email.php?id_usuario="+window.localStorage.getItem("usuario"));
                window.localStorage.removeItem("usuario");
                window.open("termos_usuario.html");
                return;
            }
        }
        chamaBanco("http://jobexpert.com.br/app/php/verificacao_email.php?id_usuario="+window.localStorage.getItem("usuario"));
        window.localStorage.removeItem("usuario");
        window.open("termos_usuario.html");

    }
}


function validarDados(controle) {
    window.localStorage.setItem("controle", controle);
    var usuario = {
        nome: $("#nome").val(),
        email: $("#emailCadastro").val(),
        cpf: $("#cpf").val(),
        senha: $("#senhaCadastro").val(),
        confirmacao: $("#confirmarSenha").val(),
        gcm: localStorage.getItem('registrationId')
    };

    if(usuario.nome == ""){
        $("#nome").css("border-bottom", "1px solid red");
        $("#nome").focus();

        $("#emailCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpf").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenha").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else if(usuario.email == ""){        
        $("#emailCadastro").css("border-bottom", "1px solid red");
        $("#emailCadastro").focus();

        $("#nome").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpf").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenha").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else if(usuario.cpf == ""){
        $("#cpf").css("border-bottom", "1px solid red");
        $("#cpf").focus();

        $("#nome").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#emailCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenha").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else if(usuario.senha == ""){
        $("#senhaCadastro").css("border-bottom", "1px solid red");
        $("#senhaCadastro").focus();

        $("#nome").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#emailCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpf").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenha").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else if(usuario.confirmacao == ""){
        $("#confirmarSenha").css("border-bottom", "1px solid red");
        $("#confirmarSenha").focus();

        $("#nome").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#emailCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpf").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else{
        cadastrarUsuario(usuario);
    }
}

function cadastrarPrestador(prestador){

    if(validarCPF(prestador.doc) == false && validarCNPJ(prestador.doc) == false){
        navigator.notification.alert(
            "CPF ou CNPJ inválido!",  // message
            null,
            'Ops',            // title
            'Ok'                  // buttonName
        );
        $("#cpfPrestador").focus();
        return;
    }

    if(prestador.senha != prestador.confirma){
        navigator.notification.alert(
            "Senhas diferentes",  // message
            null,
            'Ops',            // title
            'Ok'                  // buttonName
        );

        $("#senhaCadastroPrestador").val("");
        $("#confirmarSenhaPrestador").val("");
        $("#senhaCadastroPrestador").focus();
        return;
    }

    var re = /\S+@\S+\.\S+/;
    if( !re.test(prestador.email)){
        navigator.notification.alert(
            "Email deve ser no formato prestador@email.com",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
        $("#emailPrestador").focus();
        return;
    }
    var servicos = $("#servicosCadastro").val();
    console.log("http://jobexpert.com.br/app/php/cadastro_prestador.php?dados="+JSON.stringify(prestador)+"&servicos="+servicos);
    var banco = chamaBanco("http://jobexpert.com.br/app/php/cadastro_prestador.php?dados="+JSON.stringify(prestador)+"&servicos="+servicos);
    if(banco==-1){
        navigator.notification.alert(
            "CPF já cadastrado!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }else if(banco==-2){
        navigator.notification.alert(
            "E-mail já cadastrado!",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }else if(banco!=0){
        window.localStorage.setItem("usuario", banco);
        window.localStorage.setItem("status", 2);

        window.localStorage.setItem("auxiliarEstados", 0);

        document.getElementById('cadastroPrestador').style.display = "none";
        document.getElementById('cadastroLocalPrestador').style.display = "";
        $('.fundo').css('filter', 'blur(5px)');
        $('.fundo').css('pointer-events', 'none');
        $(".popup").css('animation','popup linear 0.5s');
        adicionarEstado();
    }else{
        navigator.notification.alert(
            "Ocorreu algo errado",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }
}

function popupLocal(){
    document.getElementById('cadastroPrestador').style.display = "none";
        document.getElementById('cadastroLocalPrestador').style.display = "";
        $('.fundo').css('filter', 'blur(5px)');
        $('.fundo').css('pointer-events', 'none');
        $(".popup").css('animation','popup linear 0.5s');
        adicionarEstado();
}

function validarDadosPrestador() {
    var prestador = {
        nome : $("#nomePrestador").val(),
        email : $("#emailPrestador").val(),
        doc : $("#cpfPrestador").val(),
        senha : $("#senhaCadastroPrestador").val(),
        confirma : $("#confirmarSenhaPrestador").val(),
        servicos : $("#servicosCadastro").val(),
        gcm: localStorage.getItem('registrationId')
    };
    console.log(JSON.stringify(prestador));

    if(prestador.nome == ""){
        $("#nomePrestador").css("border-bottom", "1px solid red");
        $("#nomePrestador").focus();

        $("#emailPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpfPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastroPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenhaPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#estadosPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cidadesPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#servicosCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else if(prestador.email == ""){        
        $("#emailPrestador").css("border-bottom", "1px solid red");
        $("#emailPrestador").focus();

        $("#nomePrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpfPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastroPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenhaPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#estadosPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cidadesPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#servicosCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else if(prestador.doc == ""){
        $("#cpfPrestador").css("border-bottom", "1px solid red");
        $("#cpfPrestador").focus();

        $("#nomePrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#emailPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastroPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenhaPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#estadosPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cidadesPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#servicosCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else if(prestador.senha == ""){
        $("#senhaCadastroPrestador").css("border-bottom", "1px solid red");
        $("#senhaCadastroPrestador").focus();

        $("#nomePrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#emailPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpfPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenhaPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#estadosPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cidadesPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#servicosCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else if(prestador.confirma == ""){
        $("#confirmarSenhaPrestador").css("border-bottom", "1px solid red");
        $("#confirmarSenhaPrestador").focus();

        $("#nomePrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#emailPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpfPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastroPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#estadosPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cidadesPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#servicosCadastro").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    
    }else if(prestador.servico == ""){
        $("#servicosCadastro").css("border-bottom", "1px solid red");
        $("#servicosCadastro").focus();

        $("#nomePrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#emailPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cpfPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#senhaCadastroPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#confirmarSenhaPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#estadosPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
        $("#cidadesPrestador").css("border-bottom", "1px solid rgba(255,255,255,.5)");
    }else{
        cadastrarPrestador(prestador);
    }
}

function cadastrarLocal(i){
    console.log(i);
    // estado = $("#estadosPrestador").val();
    // cidades = $("#cidadesPrestador").val();
    var id_estados = "estadosPrestador";
    var id_cidades = "cidadesPrestador";
    var estado = "";

    for(j = 0 ; j < i ; j++){
        estado = $("#estadosPrestador"+j).val(); 
        cidades = $("#cidadesPrestador"+j).val();

        if(estado == "" || cidades == null){
            navigator.notification.alert(
                "Selecione todos os estados e cidades em que você presta serviço",  // message
                null,
                'Ops',            // title
                'Fechar'                  // buttonName
            );
            return;
        }

        console.log(estado);  
        console.log(cidades);
        
        var banco = chamaBanco("http://jobexpert.com.br/app/php/cadastro_local_prestador.php?estado="+estado+"&cidades="+cidades+"&id_prestador="+window.localStorage.getItem("usuario"));
        console.log("http://jobexpert.com.br/app/php/cadastro_local_prestador.php?estado="+estado+"&cidades="+cidades+"&id_prestador="+window.localStorage.getItem("usuario"));   
    }
     if(banco == 1){ 
        window.open(".html");
        
        chamaBanco("http://jobexpert.com.br/app/php/verificacao_email.php?id_prestador="+window.localStorage.getItem("usuario"));
        window.localStorage.removeItem("usuario");
        window.open("termos_prestador.html");
    }else{
        navigator.notification.alert(
            "Ocorreu algo errado",  // message
            null,
            'Ops',            // title
            'Fechar'                  // buttonName
        );
    }

}

function aceitarTermosUsuario(){
    navigator.notification.alert(
        "Verifique seu e-mail para ativar a sua conta!",  // message
        null,
        'Cadastrado com sucesso',            // title
        'Fechar'                  // buttonName
    );
    window.location.href='index.html';
}

function aceitarTermosPrestador(){
    navigator.notification.alert(
        "Verifique seu e-mail para ativar a sua conta!",  // message
        null,
        'Cadastrado com sucesso',            // title
        'Fechar'                  // buttonName
    );
    window.location.href='index.html';
}

function recusar(){
    var resposta = chamaBanco("http://jobexpert.com.br/app/php/recusar_termos.php?id="+window.localStorage.getItem("usuario")+"&status="+window.localStorage.getItem("status"));
    if(resposta == 1){
        window.location.href='index.html';
    }
}


function adicionarEstado(){

    var html = chamaBanco("http://jobexpert.com.br/app/php/adicionar_estado.php?aux="+window.localStorage.getItem("auxiliarEstados"));

    var id = "adicionarEstado"+window.localStorage.getItem("auxiliarEstados");
    console.log(id);
    $("#"+id).html(html);
    var aux = window.localStorage.getItem("auxiliarEstados");
    aux++;
    window.localStorage.setItem("auxiliarEstados", aux);
}

function cancelarLocal(){
    function onConfirm(buttonIndex) {
        if(buttonIndex == 2){           
            var resposta = chamaBanco("http://jobexpert.com.br/app/php/cancelar_local.php?id_prestador="+window.localStorage.getItem("usuario"));
            if(resposta == 1){

                document.getElementById('cadastroPrestador').style.display = "";
                document.getElementById('cadastroLocalPrestador').style.display = "none";
                $('.fundo').css('filter', 'blur(5px)');
                $('.fundo').css('pointer-events', 'none');
                $(".popup").css('animation','popup linear 0.5s');
                $("#adicionarEstado0").html("");
                i = 0;
            }            
        }
    }
    navigator.notification.confirm(
        'Realmente deseja cancelar?', // message
         onConfirm,            // callback to invoke with index of button pressed
        'Cancelar',           // title
        ['Não','Sim']     // buttonLabels
    );

   
    
}

function validarCPF(cpf) {
    console.log(cpf);  
    cpf = cpf.replace(/[^\d]+/g,'');    
    if(cpf == '') return false; 
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999")
            return false;       
    // Valida 1o digito 
    add = 0;    
    for (i=0; i < 9; i ++)       
        add += parseInt(cpf.charAt(i)) * (10 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11)     
            rev = 0;    
        if (rev != parseInt(cpf.charAt(9)))     
            return false;       
    // Valida 2o digito 
    add = 0;    
    for (i = 0; i < 10; i ++)        
        add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
        rev = 0;    
    if (rev != parseInt(cpf.charAt(10)))
        return false;       
    return true;   
}

function validarCNPJ(cnpj) {
    console.log(cnpj);
    cnpj = cnpj.replace(/[^\d]+/g,'');

    if(cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // LINHA 10 - Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false; // LINHA 21

    // Valida DVs LINHA 23 -
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false; // LINHA 49

    return true; // LINHA 51

}
