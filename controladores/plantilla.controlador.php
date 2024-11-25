<?php

class ControladorPlantilla
{

    public function ctrMostrarPlantilla()
    {

        include 'vistas/plantilla.php';
    }

    //url del sistema

    static public function url()
    {

        return "http://localhost/TpFinal/";
    }
}
