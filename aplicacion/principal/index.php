<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$barraUbi = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Index Relacion 8", "ENLACE" => "/aplicacion/index.php"]
];



// ---- DIBUJO DE LA PÁGINA ----
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Index Relación 8", $barraUbi);
cuerpo();
finCuerpo();

// vista
function cabecera() {}

function cuerpo()
{

}
