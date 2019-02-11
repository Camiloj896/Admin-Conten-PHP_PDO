<?php

class slideController{

    // --------------------------------------------
    // MOSTRAR IMAGENES PARA EL SLICE
    // --------------------------------------------

    public function mostrarImagesSlideVista(){

        $res = SlideModel::MostrarImagesVistaModel("slide");

        foreach($res as $row => $item){
            echo '<li>
                    <img src="./backend'. substr($item["ruta"], 5) .'">
                    <div class="slideCaption">
                        <h3>'. $item["titulo"] .'</h3>
                        <p>'. $item["descripcion"] .'</p>
                    </div>
                </li>';
        }

    }
}
