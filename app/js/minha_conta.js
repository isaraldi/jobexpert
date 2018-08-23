function dadosMinhaConta(){
	

	var id_usuario = window.localStorage.getItem("usuario");
	console.log(window.localStorage.getItem("usuario"));
	console.log(window.localStorage.getItem("status"));
	if(id_usuario!=0){
		if(window.localStorage.getItem("status") == 1){
			var url = "http://jobexpert.com.br/app/php/minha_conta.php?id_usuario="+id_usuario;
			var cliente = JSON.parse(chamaBanco(url));
			$("#foto_perfil").attr("src", cliente.foto);
			$("#nome_cliente").text(cliente.nome);
			$("#avaliacao").html(cliente.avaliacao);
		}else{
			var url = "http://jobexpert.com.br/app/php/minha_conta_prestador.php?id_usuario="+id_usuario;
			var cliente = JSON.parse(chamaBanco(url));		
			//console.log(cliente);
			$("#foto_perfil").attr("src", cliente.foto);
			$("#nome_cliente").text(cliente.nome);
			$("#avaliacao").html(cliente.avaliacao);
		}
	}else{

	}
}

function logout(){
	function onConfirm(buttonIndex) {
		if(buttonIndex == 2){
			facebookConnectPlugin.getLoginStatus(function onLoginStatus (response) {
    			console.log("current status: ", response);	
    			if(response.status === "connected"){
    				facebookConnectPlugin.logout(function onLogoutStatus (response) {
    					console.log(response);
    				})
    			}
    		});

			window.localStorage.removeItem("usuario");
			window.open("index.html");
		}


		
	}
	navigator.notification.confirm(
	    'Realmente deseja sair?', // message
	     onConfirm,            // callback to invoke with index of button pressed
	    'Logout',           // title
	    ['Cancelar','Confirmar']     // buttonLabels
	);

}
