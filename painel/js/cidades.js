function cidades(id_estado){
	var cidades = chamaBanco("php/cidades.php?id_estado="+id_estado);	
	$("#listaCidades").html(cidades);
}
