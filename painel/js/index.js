function login(){
	var login = document.getElementById('login').value;
	var senha = document.getElementById('senha').value;
	var resposta = chamaBanco("php/login.php?usuario="+login+"&senha="+senha);	
	if(resposta == 1){
		window.location.href = "inicio.html";
	}
	else{
		alert(resposta);
	}
	
}