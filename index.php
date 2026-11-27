<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador
$barra=[
    [
    "TEXTO"=>"inicio",
    "ENLACE"=>"/index.php",
    "ADICIONAL" => ">>"
    ],
    [
    "TEXTO"=>"otro"
    ],
    [
    "TEXTO"=>"index",
    "ADDICIONAL" => "&copy;&copy;"
    ]
];

$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("RELACIÓN 8");
cabecera();
finCabecera();
inicioCuerpo("RELACIÓN 8", $barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{
    ?>
    <!--Comentario-->

    
    <?php

    
}

//vista
function cuerpo()
{
?>
            <br>
                <lu>
                    <hr>
                    <li><a href="./index.php">RECARGA-PAGINA</a></li>
                    <br>
                    <li><a href="./aplicacion/personalizar/index.php">Index - Personalizar</a></li>
                    <br>
                    <li><a href="./aplicacion/personalizar/personalizar.php">Personalizardocke - Personalizar</a></li>
                    <br>
                    <li><a href="./aplicacion/texto/verTextos.php">Ver Textos</a></li>
                    <br>
                </lu>

   
    
<?php
}
