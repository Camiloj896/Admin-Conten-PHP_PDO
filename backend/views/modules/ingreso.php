<!--=====================================
INGRESO       
======================================-->

<div  id="backIngreso">

	<form method="post" id="formIngreso" onsubmit="return validaringreso()">

		<h1 id="tituloFormIngreso">INGRESO AL PANEL DE CONTROL</h1>

		<?php
			$ingreso = new Ingreso();
			$ingreso -> IngresoController();
		?>
		
		<input class="form-control formIngreso" type="text" placeholder="Ingrese su Usuario" id = "usuarioIngreso" name="usuarioIngreso">
		<input class="form-control formIngreso" type="password" placeholder="Ingrese su Contraseña" id = "passwordIngreso" name="passwordIngreso">
		<input class="form-control formIngreso btn btn-primary" type="submit" value="Enviar">

	</form>
	
</div>

