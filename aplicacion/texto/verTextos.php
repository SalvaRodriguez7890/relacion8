<?php

// Cargo la cabecera.php con las constantes de los colores y las funciones de guardarCookie() y coloresActuales().
include_once(dirname(__FILE__) . "/../../cabecera.php");

// ---------------------------- CONTROLADOR ----------------------------

// Inicializo el array textos
$textos = $_SESSION["textos"] ?? [];

// Array de errores
$errores = [];

// Miro si se ha iniciado la petición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $texto = trim($_POST["texto"] ?? "");

    // CORREGIDO: "registrar" en minúscula para coincidir con el name del input HTML
    if (isset($_POST["registrar"])) {
        // Compruebo que no esté vacío
        if ($texto == "") {
            $errores["textoVacio"] = "Ingresa algún texto";
        } else {
            // Si no hay error, creo el nuevo objeto y lo meto al array
            $nuvRegTexto = new RegistroTexto($texto);
            $textos[] = $nuvRegTexto;
        }
    }

    // Compruebo si se ha pulsado en limpiar
    if (isset($_POST["limpiar"])) {
        $textos = []; // Bórrame el array
    }
    
    // Ahora actualizo la sesión con el arraytextos con los nuevo que se la metido para cuando sse vuelva a cargar la pagina
    $_SESSION["textos"] = $textos;
}

// Barra de ubicación.
$barraUbi = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "texto", "ENLACE" => "/aplicacion/texto/verTextos.php"],
    ["TEXTO" => "Ver Textos"]   
];

// ---------------------------- DIBUJO DE LA PÁGINA ----------------------------
inicioCabecera("Ver Textos");  
cabecera();                              
finCabecera();                           
inicioCuerpo("Ver Textos", $barraUbi);
cuerpo($errores, $textos);       
finCuerpo();

// ---------------------------- VISTA ----------------------------

function cabecera() {}

// Función cuerpo
function cuerpo(array $errores, array $textos)
{
    // Primero compruebo que no existan errores
    if (count($errores) != 0) { 
        foreach ($errores as $er) {
            echo "<p class='mensajeError'>".PHP_EOL;
            echo $er.PHP_EOL;
            echo "</p>".PHP_EOL;
        }
     } 
    ?>
    <br>
    
    <form method="post" action="">
        <!-- CORREGIDO: Se cambia el id para evitar duplicados -->
        <label for="campo_texto">Ingresa Texto</label>
        <input type="text" name="texto" id="campo_texto">
        <input type="submit" name="registrar" value="Registrar">
        <br>
        <br>
        <hr> 

     
        <h2>Textos Guardados</h2>

      
        <textarea rows="25" cols="50" readonly><?php
            // Recorro los textos existentes (sin saltos de línea extra dentro del textarea para que se vea limpio)
            if (count($textos) == 0) {
                echo "No hay ningun texto guardado".PHP_EOL;
            } else {
                foreach ($textos as $tex) {
                    echo $tex->getFecha()->format('d/m/Y H:i:s') . " - " . $tex->getCadena() . PHP_EOL;
                }
            }
        ?></textarea>
        
        <hr>
        <input type="submit" name="limpiar" value="Limpiar">
    </form>
    <?php
}