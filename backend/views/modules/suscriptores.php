
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
SUSCRIPTORES         
======================================-->

<div id="suscriptores" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
 
 <div>

	<table id="tablaSuscriptores" class="table table-striped dt-responsive nowrap">
    <thead>
      <tr>
        <th>Nombre</th>        
        <th>Email</th>
        <th>Acciones</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
        $suscriptores = new GestorSuscriptoresController();
        $suscriptores -> mostrarSuscriptoresController();
        $suscriptores -> eliminarSuscriptorController();
      ?>
    </tbody>
  </table>

  <button class="btn btn-warning pull-right" style="margin:20px;">Imprimir Suscriptores</button>
  </div>

</div>

<!--====  Fin de SUSCRIPTORES  ====-->