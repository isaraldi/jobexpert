var variavel_global; 

function AjaxF(){
    var ajax;
    try{
        ajax = new XMLHttpRequest();
    }catch(e){
        try{
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e){
            try{
                ajax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(e){
                alert("Seu browser não da suporte à AJAX!");
                return false;
            }
        }
    }
    return ajax;
}

function chamaBanco(url){
    
    var ajax = AjaxF();
    ajax.onreadystatechange = function(){ 
        if(ajax.readyState == 4){
            variavel_global = ajax.responseText;
           // alert("salvo com sucesso");
        }       
    }
    ajax.open("GET", url, false);
    ajax.setRequestHeader("Content-Type", "text/html");
    ajax.send();
    return variavel_global;
};