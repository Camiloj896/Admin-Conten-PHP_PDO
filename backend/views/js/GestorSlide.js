

//---------------------------------------------
//   AREA DE DESCARGA / ARRASTRE DE IMAGENES 
//---------------------------------------------

if ($("#columnasSlide").html() == 0 ) {

	$("#columnasSlide").css({"height":"100px"});

}else{

	$("#columnasSlide").css({"height":"auto"});
}
// -----------------
// SUBIR IMAGEN
// -----------------

$("#columnasSlide").on("dragover", function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"url(views/images/Textura.jpg)"});

})

// -----------------
// SOLTAR IMAGEN
// -----------------

$("#columnasSlide").on("drop", function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"white"});

	var archivo = e.originalEvent.dataTransfer.files;
	var imagen = archivo[0];

	// ----------------------------
	// VALIDAR TAMAÑO DE IMAGEN
	// ----------------------------

	var imagensize = imagen.size;	

	if (Number(imagensize) > 2000000) {
		$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">el archivo excede el peso permitido,200kb</div>"');
	}else {
		$(".alerta").remove();
	}

	// ----------------------------
	// VALIDAR TIPO DE IMAGEN
	// ----------------------------

	var imagentype = imagen.type;
	if (imagentype == "image/jpeg" || imagentype == "image/png") {
		$(".alerta").remove();
	}else {
		$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">el archivo debe ser formato jpg o png</div>"');		
	}

	// ----------------------------
	//SUBIR IMAGEN AL SERVIDOR
	// ----------------------------

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
				$("#columnasSlide").before('<img src="views/images/status.gif" id="status" style="height:100px;width:100px">');
			},
			success: function(res){

				console.log(res);

			 	$("#status").remove();

			 	if(res == 0){				

			 		$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">la imagen no cumple con la resolución</div>"');	

			 	}else{			
			
			 		$("#columnasSlide").css({"height":"auto"});
					
					//----------------------------------------------
					//estos elementos sobran si recargamos la pagina
					//----------------------------------------------

			 		//$("#columnasSlide").prepend('<li class="bloqueSlide"><span class="fa fa-times EliminarSlide"></span> <img src="' + res["ruta"].slice(6) +'" class="handleImg"></li>');					
					//$("#ordenarTextSlide").append('<li id="item '+ res["id"] +'"><span class="fa fa-pencil" style="background:blue"></span> <img src="' + res["ruta"].slice(6) + '" style="float:left; margin-bottom:10px" width="80%"> <h1>' + res["titulo"] + '</h1> <p>' + res["descripcion"] + '</p> </li>');					
					
					//----------------------------------------------					
					//----------------------------------------------

					swal({
						title: "¡OK!",
						text: "¡La imagen subio correctamente!",
						type: "success",
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						},
						function(isConfirm){
				
							if (isConfirm){				
								window.location = "slide";
							}
					});
			 	}		
			}
		});
	}	

});

//--------------------------------
//     ELIMINAR ITEM SLIDE 
//--------------------------------

 $(".EliminarSlide").click(function(){

 	if($(".eliminarSlide").length == 1){
 		$("#columnasSlide").css({"height":"100px"});
	 }
	 
	idslide = $(this).parent().attr("id");	
	rutaSlide = $(this).parent().attr("ruta");

	var BorrarId = new FormData();
	 
 	BorrarId.append("idslide",idslide);	
 	BorrarId.append("rutaSlide",rutaSlide);	

	$.ajax({
 		url: "views/ajax/GestorSlide.php",
 		method: "POST",
 		data: BorrarId,
 		cache: false,
 		contentType: false,
 		processData: false,			
 		success: function(res){				
						
			swal({
				title: "¡OK!",
				text: "¡La imagen se elimino correctamente!",
				type: "success",
				confirmButtonText: "Cerrar",
				closeOnConfirm: false
				},
				function(isConfirm){
		
					if (isConfirm){				
						window.location = "slide";
					}
			});				
		} 		 
 	});
});

//---------------------
//EDITAR ITEM SLIDE
//---------------------

$(".editarSlide").click(function(){

	editarIdSlide = $(this).parent().attr("id");
	
	//obtener información del elemento seleccionado
	imgItemSlide = $(this).parent().children("img").attr("src");
	tituloItemSlide = $(this).parent().children("h1").html();
	infoItemSlide = $(this).parent().children("p").html();

	$(this).parent().html('<img src="' + imgItemSlide + '" class="img-thumbnail"><input type="text" class="form-control" id = "titulo' + editarIdSlide +'" placeholder="Título" value="' + tituloItemSlide + '"><textarea row="5" class="form-control" id = "Descripcion' + editarIdSlide +'" placeholder="Descripción">' + infoItemSlide + '</textarea><button class="btn btn-info pull-right" id = "guardar' + editarIdSlide +'" style="margin:10px">Guardar</button>');

	//GUARDAR INFORMACIÓN DEL ITEM

	$("#guardar"+editarIdSlide).click(function(){

		cargarTituloItem = $("#titulo"+editarIdSlide).val();
		cargarDescripcionItem = $("#Descripcion"+editarIdSlide).val();

		//VALIDAR INFORMACIÓN
		if(cargarTituloItem == "" || cargarDescripcionItem == ""){
			//ALERTA SI NO TENEMOS NINGUN VALOR			
			if(cargarTituloItem == ""){										
				$("#titulo"+editarIdSlide).css({"border-color":"red"});
			}else{
				$("#titulo"+editarIdSlide).css({"border-color":"rgb(204, 204, 204)"});
			}

			if(cargarDescripcionItem == ""){								
				$("#Descripcion"+ editarIdSlide).css({"border-color":"red"});
			}else{
				$("#Descripcion"+ editarIdSlide).css({"border-color":"rgb(204, 204, 204)"});
			}	
		}else{

			var GuardarDatos = new FormData();
			GuardarDatos.append("idItem",editarIdSlide.slice(4));
			GuardarDatos.append("tituloItemSlide",cargarTituloItem);
			GuardarDatos.append("infoItemSlide",cargarDescripcionItem);

			$.ajax({
				url: "views/ajax/GestorSlide.php",
				method: "POST",
				data: GuardarDatos,
				cache: false,
				contentType: false,
				processData: false,
				success: function(res){
			
					if(res == "bien"){
						swal({
							title: "¡OK!",
							text: "¡se  actualizo correctamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							},
							function(isConfirm){
					
								if (isConfirm){				
									window.location = "slide";
								}
						});		
					}else{
						swal({
							title: "Error!",
							text: "¡La información no se actualizo!",
							type: "error",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							},
							function(isConfirm){
					
								if (isConfirm){				
									window.location = "slide";
								}
						});
					}
				}
			});

		}		

	});

});

//---------------------
//ORDENAR ITEM SLIDE
//---------------------

var almacenarOrdenId = new Array();
var ordenItem = new Array();

$("#ordenarSlide").click(function(){
	
	$("#ordenarSlide").hide();
	$("#guardarSlide").show();

	$( "#columnasSlide").css({"cursor":"move"});
	$( "#columnasSlide span").hide();
		
	$( "#columnasSlide").sortable({
		revert: true,
		connectWith: ".bloqueSlide",
		handle: ".handleImg",	
		stop: function(event) {

			for(var i= 0; i < $( "#columnasSlide li").length; i++){

				almacenarOrdenId[i] = event.target.children[i].id;
				ordenItem[i] = i+1;

			}
		}
	
	});

});

$("#guardarSlide").click(function(){
	
	$("#guardarSlide").hide();
	$("#ordenarSlide").show();

	$("#columnasSlide").css({"cursor":"auto"});
	$( "#columnasSlide span").show();

	for(var i= 0; i < $( "#columnasSlide li").length; i++){

		var almacenarOrden = new FormData();
		
		almacenarOrden.append("idItemOrden", almacenarOrdenId[i]);
		almacenarOrden.append("ordenItem", ordenItem[i]);

		$.ajax({
			url: "views/ajax/GestorSlide.php",
			method: "POST",
			data: almacenarOrden,
			cache: false,
			contentType: false,
			processData: false,
			success: function(res){				
				if( i == $( "#columnasSlide li").length){
					swal({
						title: "¡OK!",
						text: "¡se  actualizo correctamente!",
						type: "success",
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						},
						function(isConfirm){
				
							if (isConfirm){				
								window.location = "slide";
							}
					});	
				}
			}
		});

	}


});
