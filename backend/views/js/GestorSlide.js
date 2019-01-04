
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

		$("#columnasSlide").before('<img src="views/images/status.gif" id="status">')

		datos.append("imagen", imagen);

		// $.ajax({
		// 	url: "views/ajax/GestorSlide.php",
		// 	method: "POST",
		// 	data: datos,
		// 	cache: false,
		// 	contentType: false,
		// 	// processData: function(){ $("#columnasSlide").before('<div class="alert alert-warning alerta text-center">la imagen es inferior a 1600px * 600px</div>"')},
		// 	success: function(res){ 

		// 		console.log(res);
		// 		/*if (res == 0) {
		// 			<img src="views/images/status.gif" id="status">
		// 			$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">la imagen es inferior a 1600px * 600px</div>"')		
		// 		}else {*/
					
		// 	}

		// });
	}

})

