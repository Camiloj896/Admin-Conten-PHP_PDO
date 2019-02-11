
//----------------------
// AGREGAR ARTUCULO
//----------------------

$("#ArticuloNuevo").click(function(){  
    $("#agregarArtículo").toggle(400);    
});

//----------------------------------
//SUBIR IMAGEN A TRAVÉZ DEL INPUT
//----------------------------------

$("#subirFoto").change(function(){

    imagen = this.files[0];

    console.log(imagen);

    imagesize = imagen.size;
    imagentype = imagen.type;

    if(Number(imagesize) > 2000000){
        $("#subirFoto").before('<div class="alert alert-warning" id="alert"><strong>la imagen excede el tamaño!</strong></div>');
    }else{
        $("#alert").remove();        
    }

    if (imagentype == "image/jpeg" || imagentype == "image/png") {
        $("#alert").remove(); 
    }else{
        $("#subirFoto").before('<div class="alert alert-warning" id="alert"><strong>formato incorrecto!</strong></div>');        
    }

    if(Number(imagesize) <= 2000000 && (imagentype == "image/jpeg" || imagentype == "image/png")){

        datosImage = new FormData();

        datosImage.append("imagen", imagen);

        $.ajax({
            url: "../../ajax/GestorArticulo.php",
            method: "POST",
            data: datosImage,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(res){
                console.log(res);
                if (res == 0){
                    $("#subirFoto").before('<div class="alert alert-warning" id="alert"><strong>tamaño incorrecto!</strong></div>'); 
                }else{
                    $("#alert").remove();
                    $("#arrastreImagenArticulo").append('<div id="imagenArticulo"><img src="' + res["ruta"].slice(6) + '" class="img-thumbnail id="idImage'+res["id"]+'"></div>');
                }
            }
        });

    } 

});

//----------------------------
//VALIDAR DATOS DEL ARTICULO
//----------------------------

// $("#guardarArticulo").click(function(){
        
//     tituloArticulo = $("#titulo").val();
//     introArticulo = $("#introduccion").val();
//     contenidoArticulo = $("#contenido").val();

//     if(tituloArticulo == "" || introArticulo == "" || contenidoArticulo == ""){

//         if(tituloArticulo == ""){ $("#titulo").css({"border-color":"red"}); }else{ $("#titulo").css({"border-color":"#ccc"}); }
//         if(introArticulo == ""){ $("#introduccion").css({"border-color":"red"}); }else{ $("#introduccion").css({"border-color":"#ccc"}); }
//         if(contenidoArticulo == ""){ $("#contenido").css({"border-color":"red"}); }else{ $("#contenido").css({"border-color":"#ccc"}); }

//         $("#errorArt").toggle(100);
//     }
     
//     valImage = $("#imagenArticulo").children("img").attr("id");
    
//     console.log(valImage);
    

// });