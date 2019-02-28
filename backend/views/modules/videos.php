
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
VIDEOS ADMINISTRABLE          
======================================-->

<div id="videos" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

<hr>

<p><span class="fa fa-arrow-down"></span>  seleccione su video, (peso permitido maximo 50mb, formato .mp4)</p>

<form method="post" enctype="multipart/form-data">

	<input type="file" name="video" class="btn btn-default" id="subirVideo" required>
	
	<input type="submit" value="Subir Video" class="btn btn-info">

</form>

<ul id="galeriaVideo">	
	<?php
		$videos = new GestorVideosController();
		$videos -> mostrarVideosController();
	?>
</ul>


	<button class="btn btn-warning" style="margin:10px 30px;" id="ordenarVideos">Ordenar Videos</button>
	<button class="btn btn-primary" style="margin:10px 30px;display:none;" id="guardarOrden">Guardar Orden</button>

</div>

<!-- <li>
		<span class="fa fa-times"></span>
		<video controls>
			<source src="views/videos/video01.mp4" type="video/mp4">
			</video>	
	</li>

	<li>
		<span class="fa fa-times"></span>
		<video controls>
			<source src="views/videos/video02.mp4" type="video/mp4">
			</video>	
	</li>

	<li>
		<span class="fa fa-times"></span>
		<video controls>
			<source src="views/videos/video03.mp4" type="video/mp4">
			</video>	
	</li>

	<li>
		<span class="fa fa-times"></span>
		<video controls>
			<source src="views/videos/video04.mp4" type="video/mp4">
			</video>	
	</li> -->


<!--====  Fin de VIDEOS ADMINISTRABLE  ====-->