<?php

class GestorArticuloController{

    
    // IMAGEN TEMPORAL PARA EL ARTICULO
    //---------------------------------------

    public function imagenTemporalArticuloController($datos){
        
        list($ancho, $alto) = getimagesize($datos);

        if($ancho < 800 || $alto < 400){
            echo 0;
        }else{

            $numAleatorio = mt_rand(100, 999);

            $ruta = "../../views/images/articulos/temp/articulo" . $numAleatorio . ".jpg";

            $origen = imagecreatefromjpeg($datos);			

            $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]);             

            imagejpeg($destino, $ruta);             
            
            echo $ruta;

        }

    }

    // ALMACENANDO DATOS DEL ARTICULO
    //------------------------------------

    public function cargarDatosArticuloController(){

        if(isset($_POST["tituloAr"])){

            $imagen = $_FILES["imagen"]["tmp_name"];
            $tituloArticulo = $_POST["tituloAr"];
            $introduccionArticulo = $_POST["introduccionAr"] . "...";        
            $contenidoArticulo = $_POST["contenidoAr"];

            $borrar = glob("views/images/articulos/temp/*");$borrar = glob("views/images/articulos/temp/*");

            foreach ($borrar as $file){
                unlink($file);
            }

            // GUARDAR IMAGEN EN EL SERVIDOR
            //-----------------------------------

            $numAleatorio = mt_rand(100, 999);

            $ruta = "views/images/articulos/articulo" . $numAleatorio . ".jpg";

            $origen = imagecreatefromjpeg($imagen);
            
            $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]); 
            
            imagejpeg($destino, $ruta);   

            // ENVIAR DATOS DEL ARTICULO AL MODELO
            //----------------------------------------

            $enviarDatos = array("ruta" => $ruta, "tituloArticulo" => $tituloArticulo, "introduccionArticulo" => $introduccionArticulo, "contenidoArticulo" => $contenidoArticulo);        
            
            $res = GestorArticuloModel::cargarDatosArticuloController("articulos", $enviarDatos);

            if($res){                
                echo'<script>

					swal({
						  title: "¡OK!",
						  text: "¡El artículo ha sido creado correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							    window.location = "articulos";
							  } 
					});


				</script>';
            }
        }

    }

    // MOSTRAR ARTICULOS ALMACENADOS
    //------------------------------------

    public function mostrarDatosArticulosController(){

        $res = GestorArticuloModel::mostrarDatosArticulosModel("articulos");

        foreach ($res as $row => $item){
            
            echo '<li id="'.$item["id"].'" class="bloqueArticulo">
					<span class="handleArticle">
					<a href="index.php?action=articulos&idBorrar='.$item["id"].'&rutaImagen='.$item["ruta"].'">
						<i class="fa fa-times btn btn-danger"></i>
					</a>
					<i class="fa fa-pencil btn btn-primary editarArticulo"></i>	
					</span>
					<img src="'.$item["ruta"].'" class="img-thumbnail">
					<h1>'.$item["titulo"].'</h1>
					<p>'.$item["introduccion"].'</p>
					<input type="hidden" value="'.$item["contenido"].'">
					<a href="#articulo'.$item["id"].'" data-toggle="modal">
					<button class="btn btn-default">Leer Más</button>
					</a>

					<hr>

				</li>

				<div id="articulo'.$item["id"].'" class="modal fade">

					<div class="modal-dialog modal-content">

						<div class="modal-header" style="border:1px solid #eee">
				        
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						 <h3 class="modal-title">'.$item["titulo"].'</h3>
			        
						</div>

						<div class="modal-body" style="border:1px solid #eee">
			        
							<img src="'.$item["ruta"].'" width="100%" style="margin-bottom:20px">
							<p class="parrafoContenido">'.$item["contenido"].'</p>
			        
						</div>

						<div class="modal-footer" style="border:1px solid #eee">
			        
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
						</div>

					</div>

				</div>';
                
        }

    }

    // BORRAR ARTICULO
    // ---------------------

    public function borrarArticuloController(){

        if(isset($_GET["idBorrar"])){

            $idArticulo = $_GET["idBorrar"];
            $imagenBorrar = $_GET["rutaImagen"];

            $res = GestorArticuloModel::borrarArticuloModel("articulos", $idArticulo);

            if($res){

                unlink($imagenBorrar);                

                echo'<script>

					swal({
						  title: "¡OK!",
						  text: "¡El artículo se elimino correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							    window.location = "articulos";
							  } 
					});


				</script>';
            }
        }
        
    }

    //ACTUALIZAR DATOS ARTICULO
    //----------------------------------------------------

    public function actualizarDatosArticuloController(){

        if(isset($_POST["editarTitulo"])){
            
            $id = $_POST["id"];
            $titulo = $_POST["editarTitulo"];
            $introduccion = $_POST["editarIntroduccion"];
            $contenido = $_POST["editarContenido"];
            $ruta = $_POST["fotoAntigua"];
     
            echo $_FILES["editarImagem"]["tmp_name"];


            //IMAGEN NUEVA
            //-----------------------------

            if(isset($_FILES["editarImagem"]["tmp_name"])){

                $imagen = $_FILES["editarImagem"]["tmp_name"];
                $imagenAntigua = $_POST["fotoAntigua"];

                //ELIMINAR IMAGENES TEMPORALES
                //----------------------------------
                $borar = glob("views/images/articulos/temp/*");
                foreach ($borar as $file){
                    unlink($file);
                }

                //ELIMINAR IMAGEN ACTIGUA
                //----------------------------------
                unlink($imagenAntigua);

                //CREAR IMAGEN NUEVA
                //----------------------------------
                $numAleatorio = mt_rand(100, 999);
                
                $ruta = "views/images/articulos/articulo". $numAleatorio . ".jpg";
                
                $origen = imagecreatefromjpeg($imagen);
            
                $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 800, "height" => 400]); 
            
                imagejpeg($destino, $ruta);   
            
            }

            $datos = array("id" => $id, "titulo" => $titulo, "introduccion" => $introduccion, "contenido" => $contenido, "ruta" => $ruta);

            $res = GestorArticuloModel::actualizarDatosArticuloModel("articulos", $datos);

            if($res){                             

                echo'<script>

					swal({
						  title: "¡OK!",
						  text: "¡El artículo se actualizo correctamente!",
						  type: "success",
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
					},

					function(isConfirm){
							 if (isConfirm) {	   
							    window.location = "articulos";
							  } 
					});


				</script>';
            }
            
        }

    }

    //ACTUALIZAR ORDEN ARTICULOS
    //-----------------------------------------

    public function actualizarOrdenArticulosController($datos){

        $res = GestorArticuloModel::actualizarOrdenArticulosModel("articulos", $datos);

        if($res){
            echo "bien";
        }else{
            echo "mal";
        }
    }
}