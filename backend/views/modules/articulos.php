<?php
	
	session_start();

	if (!$_SESSION["validar"]) {
		header ("location:ingreso");
		exit();
	}

	include "views/modules/Botonera.php";
	include "views/modules/Cabezote.php";

?>

<!--=====================================
ARTÍCULOS ADMINISTRABLE          
======================================-->

<div id="seccionArticulos" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
	
	<button id="ArticuloNuevo" class="btn btn-info btn-lg">Agregar Artículo</button>

	<!--==== AGREGAR ARTÍCULO  ====-->

	<div id="agregarArtículo">

		<form method="POST" enctype="multipart/form-data" onsubmit="validarForm()">

			<div class="alert alert-warning" id="errorArt" style="display:none;"><strong>Complete la información!</strong></div>
			
			<input type="text" name = "tituloAr" placeholder="Título del Artículo" class="form-control" id="titulo">

			<textarea name="introduccionAr" id="introduccion"  maxlength = "170" cols="30" rows="5" placeholder="Introducción del Articulo" class="form-control"></textarea>

			<input type="file" name="imagen" class="btn btn-default" id="subirFoto" required>

			<p>Tamaño recomendado: 800px * 400px, peso máximo 2MB</p>

			<div id="arrastreImagenArticulo">	
				
			</div>

			<textarea name="contenidoAr" id="contenido" cols="30" rows="10" placeholder="Contenido del Articulo" class="form-control"></textarea>

			<input type="submit" id="guardarArticulo" class="btn btn-primary" value="Guardar Artículo">
		
		</form>

	</div> 

	<!-- ALMACENANDO DATOS DEL ARTICULO
    //------------------------------------ -->

	<?php

		$datosArticulo = new GestorArticuloController();
		$datosArticulo -> cargarDatosArticuloController();
	
	?>

	<hr>

	<!--==== EDITAR ARTÍCULO  ====-->

	<ul id="editarArticulo">
		<?php

			$articulos = new GestorArticuloController();
			$articulos -> mostrarDatosArticulosController();
			$articulos -> borrarArticuloController();
			$articulos -> actualizarDatosArticuloController();

		?>

	</ul>

	<button class="btn btn-warning pull-right" id="OrdenArticulos" style="margin:10px 30px">Ordenar Artículos</button>
	<button class="btn btn-primary pull-right" id="GuardarOrdenArticulos" style="margin:10px 30px;display:none;">Guardar Orden Artículos</button>

</div>

<!--====  Fin de ARTÍCULOS ADMINISTRABLE  ====-->

<!--=====================================
ARTÍCULO MODAL         
======================================-->

<!--====  Fin de ARTICULO MODAL ====-->