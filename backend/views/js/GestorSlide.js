
// AREA DE DESCARGA / ARRASTRE DE IMAGENES 

console.log($("#columnasSlide").html());

if ($("#columnasSlide").html() == 0 ) {

	$("#columnasSlide").css({"height":"100px"});

}else{

	$("#columnasSlide").css({"height":"auto"});
}

// SUBIR IMAGEN
$("#columnasSlide").on("dragover", function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"url(views/images/Textura.jpg)"});

})

// SOLTAR IMAGEN
$("#columnasSlide").on("drop", function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"white"});

	var archivo = e.originalEvent.dataTransfer.files;
	var imagen = archivo[0];
	
	// VALIDAR TAMAÑO DE IMAGEN
	var imagensize = imagen.size;	

	if (Number(imagensize) > 2000000) {
		$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">el archivo excede el peso permitido,200kb</div>"')
	}else {
		$(".alerta").remove();
	}

	// VALIDAR TIPO DE IMAGEN

	var imagentype = imagen.type;
	if (imagentype == "image/jpeg" || imagentype == "image/png") {
		$(".alerta").remove();
	}else {
		$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">el archivo debe ser formato jpg o png</div>"')		
	}


	//SUBIR IMAGEN AL SERVIDOR

	if (Number(imagensize) < 2000000 && imagentype == "image/jpeg" || imagentype == "image/png"){

		var datos = new FormData();		
		
		datos.append("imagen", imagen);

		$.ajax({
			url: "views/ajax/GestorSlide.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			beforeSend: function(){
				$("#columnasSlide").before('<img src="views/images/status.gif" id="status" style="height:100px;width:100px">')
			},
			success: function(res){
				
				$("#status").remove();

				if(res == 0){				

					$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">la imagen no cumple con la resolución</div>"')		

				}else{
					
					$("#columnasSlide").css({"height":"auto"});

					$("#columnasSlide").prepend('<li class="bloqueSlide" <span class="fa fa-times"></span> <img src="' + res["ruta"].slice(6) +'" class="handleImg"></li>');					

					$("#ordenarTextSlide").append('<li><span class="fa fa-pencil" style="background:blue"></span> <img src="' + res["ruta"].slice(6) + '" style="float:left; margin-bottom:10px" width="80%"> <h1>' + res["titulo"] + '</h1> <p>' + res["descripcion"] + '</p> </li>');
					
				}		
			}
		});
	}

})

