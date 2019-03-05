
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
MENSAJES        
======================================-->

<div id="bandejaMensajes" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
 
	 <div >
	    <h1 >Bandeja de Entrada</h1>
	    <hr>
	 </div>  

	 <?php 
		
		$mensajes = new GestorMensajesController();
		$mensajes -> mostrarMensajesController();
		$mensajes -> eliminarMensajeController();		

	 ?>

</div>

<div id="lecturaMensajes" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
 
	 <div>	  
	 	<br/>
	   <button class="btn btn-success" id="enviarMensajes">Enviar mensaje a todos los usuarios</button>
	    <hr>
	 </div>

	 <form action="" style="display:none" id="responderMensajes">

	 	<p>Para: Todos los usuarios</p>
	 	
	 	<input type="text" placeholder="Título del Mensaje" name="tituloTodos" class="form-control">

		<textarea name="mensajeTodos" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea>

		<input type="button" class="form-control btn btn-primary" id="enviarCorreoTodos" value="Enviar">

	 </form>

	 <div class="well well-sm" id="leerMensaje" style="display:none">	

	 <?php
	 	$responderMensaje = new GestorMensajesController();
	 	$responderMensaje->responderMensajesController();
	 ?>

	 </div>

</div>

<!--====  Fin de MENSAJES  ====-->