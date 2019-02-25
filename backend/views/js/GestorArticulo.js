
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

        var datosImage = new FormData();

        datosImage.append("imagen", imagen);

        $.ajax({
            url: "views/ajax/GestorArticulo.php",
            method: "POST",
            data: datosImage,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $("#subirFoto").before('<img src="views/images/status.gif" id="status" style="height:100px;width:100px">')
            },
            success: function(res){            
                 if (res == 0){
                    $("#subirFoto").before('<div class="alert alert-warning" id="alert"><strong>tamaño incorrecto!</strong></div>'); 
                }else{
                    $("#alert").remove();
                    $("#status").remove();
                    $("#arrastreImagenArticulo").html('<div id="imagenArticulo"><img src="' + res.slice(6) + '" class="img-thumbnail"></div>');                    
                }
            }
        });

    } 

});

//VALIDAR DATOS DEL ARTICULO
//----------------------------

 $("#guardarArticulo").click(function validarForm(){
        
    tituloArticulo = $("#titulo").val();
    introArticulo = $("#introduccion").val();
    contenidoArticulo = $("#contenido").val();

    if(tituloArticulo == "" || introArticulo == "" || contenidoArticulo == ""){

        if(tituloArticulo == ""){ $("#titulo").css({"border-color":"red"}); }else{ $("#titulo").css({"border-color":"#ccc"}); }
        if(introArticulo == ""){ $("#introduccion").css({"border-color":"red"}); }else{ $("#introduccion").css({"border-color":"#ccc"}); }
        if(contenidoArticulo == ""){ $("#contenido").css({"border-color":"red"}); }else{ $("#contenido").css({"border-color":"#ccc"}); }

        $("#errorArt").toggle(100);

        return false
    } 
    
    return true;      

});


//EDITAR ARTICULO
//-------------------------

$(".editarArticulo").click(function(){   

    idArticulo = $(this).parent().parent().attr("id");   
    rutaImagen = $("#"+idArticulo).children("img").attr("src");
    titulo = $("#"+idArticulo).children("h1").html()
    introduccion = $("#"+idArticulo).children("p").html()
    contenido = $("#"+idArticulo).children("input").val();

    $("#"+idArticulo).html('<form method="post" enctype="multipart/form-data"><span><input style="width:10%; padding:5px 0; margin-top:4px" type="submit" class="btn btn-primary pull-right" value="Guardar"></span><div id="editarImagen"><input style="display:none" type="file" id="subirNuevaFoto" class="btn btn-default"><div id="nuevaFoto"><span class="fa fa-times cambiarImagen"></span><img src="'+rutaImagen+'" class="img-thumbnail"></div></div><input type="text" value="'+titulo+'" name="editarTitulo"><textarea cols="30" rows="5" name="editarIntroduccion">'+introduccion+'</textarea><textarea name="editarContenido" id="editarContenido" cols="30" rows="10">'+contenido+'</textarea><input type="hidden" value="'+idArticulo+'" name="id"><input type="hidden" value="'+rutaImagen+'" name="fotoAntigua"><hr></form>');

    //CAMBIAR IMAGEN
    //-------------------------------------------

    $(".cambiarImagen").click(function(){
        $("#subirNuevaFoto").show();
        $("#subirNuevaFoto").css({"width":"90%"});

        var imagenActual = $("#nuevaFoto").children("img").attr("src");

        $("#nuevaFoto").html("");        
        $("#subirNuevaFoto").attr("name","editarImagem");
        $("#subirNuevaFoto").attr("required", true);

        $("#subirNuevaFoto").change(function(){
            imagen = this.files[0];

            imagesize = imagen.size;
            imagentype = imagen.type;

            // VALIDAR FORMATO IMAGEN
            //------------------------------
            if (imagentype == "image/jpeg" || imagentype == "image/png") {
                $("#alert").remove();   
            }else{
                $("#subirNuevaFoto").parent().parent().before('<div class="alert alert-warning" id="alert"><strong>Seleccione una imagen!</strong></div>');
            }

            // VALIDAR TAMAÑO IMAGEN
            //------------------------------
            if(Number(imagesize) > 2000000){
                $("#subirNuevaFoto").parent().parent().before('<div class="alert alert-warning" id="alert"><strong>la imagen excede el tamaño!</strong></div>');
            }else{
                $("#alert").remove();        
            }

            //ACTUALIZANDO IMAGEN
            //-----------------------------

            if ((imagentype == "image/jpeg" || imagentype == "image/png") && Number(imagesize) <= 2000000){
                
                var datosImagen = new FormData();
                datosImagen.append("imagen", imagen);                

                $.ajax({
                    url: "views/ajax/GestorArticulo.php",
                    method: "POST",
                    data: datosImagen,
                    cache: false,                    
                    contentType: false,
                    processData: false,
                    success: function(res){
                        if(res == 0){
                            $("#subirNuevaFoto").parent().parent().before('<div class="alert alert-warning" id="alert"><strong>la imagen no cumple el tamaño minimo 800 * 400!</strong></div>');
                        }else{
                            $("#alert").remove();
                            $("#nuevaFoto").html('<img src="'+res.slice(6)+'" class="img-thumbnail">');                             
                        }
                    }
                })

            }
        })
    })
})

 //ORDENAR ARTICULOS 
//---------------------------------------

var almacenarOrdenId = new Array();
var ordenItem = new Array();

$("#OrdenArticulos").click(function(){
    
    $("#OrdenArticulos").hide();
    $("#GuardarOrdenArticulos").show();

    $("#editarArticulo").css({"cursor":"move"});
    $("#editarArticulo span i").hide();
    $("#editarArticulo button").hide();
    $("#editarArticulo img").hide();
    $("#editarArticulo p").hide();
    $("#editarArticulo hr").hide();
    $("#editarArticulo div").remove();

    $(".bloqueArticulo h1").css({"font-size":"14px","position":"absolute","top":"-15px","padding":"10px"});    
    $(".bloqueArticulo").css({"padding":"2px"});
    $("#editarArticulo span").html('<i class="glyphicon glyphicon-move" style="padding:8px;"></i>');

    $("body, html").animate({

        scrollTop:$("body").offset().top

    }, 500);

    $("#editarArticulo").sortable({

        revert: true,
        connectwith: ".bloqueArticulo",
        handle: ".handleArticle",
        stop: function(event){
            for(var i=0; i < $("#editarArticulo li").length; i++){
                almacenarOrdenId[i] = event.target.children[i].id;
                ordenItem[i] = i+1;
            }
        }
    })


    $("#GuardarOrdenArticulos").click(function(){
        $("#OrdenArticulos").show();
        $("#GuardarOrdenArticulos").hide();

        for(var i=0; i < $("#editarArticulo li").length; i++){

            var actualizarOrden = new FormData();
            actualizarOrden.append("idItemArticulos", almacenarOrdenId[i]);
            actualizarOrden.append("actualizarOrdenArticulos", ordenItem[i]);
                        
            $.ajax({
                url: "views/ajax/GestorArticulo.php",
                method: "POST",
                data: actualizarOrden,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res){
                    console.log(res);
                    if(res == "bien" && i == $("#editarArticulo li").length){
                        swal({
                            title: "¡OK!",
                            text: "¡El orden de los articulos se actualizo correctamente!",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function(isConfirm){
                                if (isConfirm) {	   
                                    window.location = "articulos";
                                } 
                        });
                    }
                }    
            })
        }
    })
})