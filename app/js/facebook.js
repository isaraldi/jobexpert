
function termos_face(control){
	window.localStorage.setItem("controle", control);
	window.location.href='termos_usuario_facebook.html';
}

function entrarFacebook(){
	facebookConnectPlugin.getLoginStatus(function onLoginStatus (response) {
    	console.log("current status: ", response);	
    	if(response.status === "connected"){
			facebookConnectPlugin.api(
			  "me/?fields=id,email,name", // graph path
			  [], // array of additional permissions
			  function(response) {
			    if (response.error) {
			      	alert("Uh-oh! " + JSON.stringify(response.error));
			    } else {				    	
			    	var imagem = "&imagem="+'https://graph.facebook.com/' + response.id + '/picture?type=large';
			    	var gcm_key = localStorage.getItem('registrationId');
			    	var json = JSON.stringify(response);
			    	var url = "http://jobexpert.com.br/app/php/cadastro_face.php?dados="+json+"&imagem"+imagem+"&gcm="+gcm_key;
			    	var id_usuario = chamaBanco(url);
			    	console.log(id_usuario);
			    	window.localStorage.setItem("usuario", id_usuario);
			    	window.localStorage.setItem("status", 1); 
			    	if(window.localStorage.getItem("controle") == 1){
				        var resposta = chamaBanco("http://jobexpert.com.br/app/php/adicionar_usuario.php?usuario="+id_usuario+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));

						console.log("http://jobexpert.com.br/app/php/adicionar_usuario.php?usuario="+id_usuario+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
						if(resposta == 1){
							mandarPushSolicitacao("Nova solicitacao", "Há uma nova solicitação que pode ser aceita!", window.localStorage.getItem("id_solicitacao"));
							navigator.notification.alert(
					            "Solicitação realizada com sucesso, quando houver um prestador diponível, você receberá uma notificação",  // message
					            null,
					            'Parabéns',            // title
					            'Fechar'                  // buttonName
					        );
					    	window.location.href='historico_usuario.html';
					    	return;
						}
					}
			        window.location.href='servicos.html'; 		    	    		
			    }
			});
		}else{
			facebookConnectPlugin.login(["email","public_profile","user_birthday","user_friends"], fbLoginSuccess, fbLoginFailure); // array of permissions
		}
	});

	
	

	function fbLoginSuccess(response) {
			if (response.status === "connected") {
				// contains the 'status' - bool, 'authResponse' - object with 'session_key', 'accessToken', 'expiresIn', 'userID'
				facebookConnectPlugin.api(
				  "me/?fields=id,email,name", // graph path
				  [], // array of additional permissions
				  function(response) {
				    if (response.error) {
				      	alert("Uh-oh! " + JSON.stringify(response.error));
				    } else {				    	
				    	var imagem = "&imagem="+'https://graph.facebook.com/' + response.id + '/picture?type=large';
				    	var gcm_key = localStorage.getItem('registrationId');
				    	var json = JSON.stringify(response);
				    	var url = "http://jobexpert.com.br/app/php/cadastro_face.php?dados="+json+"&imagem"+imagem+"&gcm="+gcm_key;
				    	var id_usuario = chamaBanco(url);
				    	console.log(id_usuario);
				    	window.localStorage.setItem("usuario", id_usuario);
				    	window.localStorage.setItem("status", 1); 
				    	if(window.localStorage.getItem("controle") == 1){
					        var resposta = chamaBanco("http://jobexpert.com.br/app/php/adicionar_usuario.php?usuario="+id_usuario+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));

							console.log("http://jobexpert.com.br/app/php/adicionar_usuario.php?usuario="+id_usuario+"&id_solicitacao="+window.localStorage.getItem("id_solicitacao"));
							if(resposta == 1){
								mandarPushSolicitacao("Nova solicitacao", "Há uma nova solicitação que pode ser aceita!", window.localStorage.getItem("id_solicitacao"));
								navigator.notification.alert(
						            "Solicitação realizada com sucesso, quando houver um prestador diponível, você receberá uma notificação",  // message
						            null,
						            'Parabéns',            // title
						            'Fechar'                  // buttonName
						        );
						    	window.location.href='historico_usuario.html';
						    	return;
							}
						}
				        window.location.href='servicos.html'; 		    	    		
				    }
				});
				//
			} else {
				console.log(response);
			}
		}

	function fbLoginFailure (error) {
	    console.error(error);
	    if(error.code == 4201){
	    	entrarFacebook();
	    }
	} 	
}

function mandarPushSolicitacao(titulo, mensagem, id){   
    var push = chamaBanco("http://jobexpert.com.br/app/php/push_solicitacao.php?titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
    console.log("http://jobexpert.com.br/app/php/push_solicitacao.php??titulo="+titulo+"&mensagem="+mensagem+"&solicitacao="+id);
}