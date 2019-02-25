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
GALERIA ADMINISTRABLE          
======================================-->

<div id="galeria" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

<hr>

<p><span class="fa fa-arrow-down"></span>  Arrastra aquí tu imagen, (tamaño recomendado: 1024px * 768px, peso permitido 2mb)</p>
	
	<ul id="lightbox">
		<?php
			$galeria = new GestorGaleriaController();
			$galeria -> mostrarImagenesGaleriaController();
		?>
	</ul> 

	<button class="btn btn-warning pull-right" id="OrdenarGaleria" style="margin:10px 30px">Ordenar Imágenes</button>
	<button class="btn btn-primary pull-right" id="GuardarOrdenar" style="margin:10px 30px;display:none;">Guardar Orden</button>

</div>

<!--====  Fin de GALERIA ADMINISTRABLE  ====-->
