<?php

require_once('../models/DocumentosModels.php');
class DocumentosControllers
{

    public static  function getDatos()
    {
        $datos = DocumentosModels::mostrarDatos();
        return $datos;
    }

}
