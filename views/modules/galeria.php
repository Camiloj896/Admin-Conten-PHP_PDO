<div class="row" id="galeria">

	<hr>
	
	<h1 class="text-center text-info"><b>GALERÍA DE IMÁGENES</b></h1>

	<hr>

	<ul>
			<?php

				$galeria = new GestorGaleriaController();
				$galeria -> mostrarImagenesGaleriaController();

			?>
			
	</ul>

</div>

		<!--====  Fin de GALERIA  ====-->

		<!-- <li>
				<a rel="grupo" href="views/images/galeria/photo02.jpg">
				<img src="views/images/galeria/photo02.jpg">
				</a>
			</li> -->