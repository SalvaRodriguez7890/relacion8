<?php
// Cargo la cabecera.php con las constatnes de los colores y las funciones de guardarCookie() y coloresActuales().
include_once(dirname(__FILE__) . "/../../cabecera.php");

// ---------------------------- CONTROLADOR ----------------------------

$mensaje = "";   // Mensaje para la confirmación de que todo se ha hecho bien
$error   =  [];   // Array donde meto los erroes posibles

//Comprobamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Inicializo fondo y texto con lo que ha recogido el formulario
    $fondo = $_POST["fondo"] ?? "";
    $texto = $_POST["texto"] ?? "";

    
    // Valido por si acaso que el fondo elegido exista dentro de las constantes
    if (!array_key_exists($fondo, COLORESFONDO) || !array_key_exists($texto, COLORESTEXTO)) {

        $error["colorInvalido"] = "Has seleccionado un color no válido.";//si no existe creo el error

    // Comprobamos que el texto no tenga exactamente el mismo color CSS que el fondo,
    // porque sería invisible. Comparamos los valores CSS
    //AQUI ES DONDE COMPARO LOS COLORES, POR ESO PONGO OTRO COLOR DISTINTO EN EL RGB DEL ROJO
    //PORQUE AL COMPROBAR POR EL VALOR CSS, "red" es diferente de "rgb(255,0,0)" PERO AL FINAL
    //LOS DOS SON EL MISMO ROJO, POR ESO EL RGB LE METÍ OTRO ROJO MAS CLARO
    } elseif (COLORESFONDO[$fondo] === COLORESTEXTO[$texto]) {

        $error["colorIgual"] = "El color del texto no puede ser igual al del fondo."; //Si los dos son iguales pues le meto ese error

    } else {
        // Si todo sale bien creo las cookies con mi función que creé y metí en la cabecera
        guardarCookie("colorFondo", $fondo);
        guardarCookie("colorTexto", $texto);

        // setcookie() solo afecta a la SIGUIENTE petición: en esta, $_COOKIE sigue teniendo el valor viejo.
        // Como el enunciado quiere que esta misma página ya se vea con los nuevos colores,
        // actualizamos $_COOKIE a mano para que coloresActuales() lea los valores nuevos.
        $_COOKIE["colorFondo"] = $fondo;
        $_COOKIE["colorTexto"] = $texto;

        $mensaje = "Colores guardados correctamente.";   //inicializo el mensaje de confirmación que luego muestro
    }
}

// saco con mi funcion coloresActuales los colores que tiene la web (ya actualizados si se han guardado antes) para preseleccionar los combos.
// Si la funcion a detectado que no hay cookies creadas que es solo la primera vez que se accede a la web y no se han elegido colores pues 
//me va a devolver los colores por defecto que eran blanco y negro en un array($colores es un array)
$colores = coloresActuales();

// Barra de ubicación.
$barraUbi = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],
    ["TEXTO" => "Personalizar", "ENLACE" => "/aplicacion/personalizar/index.php"],
    ["TEXTO" => "Colores"]   
];

// ---------------------------- DIBUJO DE LA PÁGINA ----------------------------
inicioCabecera("PERSONALIZAR COLORES");  
cabecera();                              
finCabecera();                           
inicioCuerpo("Personalizar colores", $barraUbi);
cuerpo($colores, $mensaje, $error);       
finCuerpo();

// ---------------------------- VISTA ----------------------------

function cabecera() {}

// Funcion cuerpo
function cuerpo(array $colores, string $mensaje, array $error)
{
    //Lo primero compruebo que no existan errores, si existen los imprimo y si no existen no pasa nada
?>
    <h2>Personalizar colores</h2>

    
    <?php if (count($error)!=0) { 
      
        
        
        foreach ($error as $er){
            echo "<p class='mensajeError'>".PHP_EOL;
            
            echo $er.PHP_EOL;
            
            echo "</p>".PHP_EOL;

        }
        
        
     
     } ?>

    <?php if ($mensaje !== "") { ?>
        <p><strong><?php echo htmlspecialchars($mensaje); ?></strong></p>   <!-- Mensaje de que se a guardado -->
    <?php } ?>


    <form method="post" action="">

     
            <label for="fondo">Color de fondo:</label>   
            <select name="fondo" id="fondo">
                <?php foreach (COLORESFONDO as $nombre => $css) { ?>
                    <!--Recorro la constatne para mostrar los colores posibles para eñ fondo-->
                    <option value="<?php echo htmlspecialchars($nombre); ?>"
                        <?php echo ($nombre === $colores["NOMBREFONDO"]) ? "selected" : ""; ?>>
                        
                        <?php echo htmlspecialchars($nombre); ?>
                    </option>
                <?php } ?>
            </select>
      

       
            <label for="texto">Color del texto:</label>
            <select name="texto" id="texto">
                <?php foreach (COLORESTEXTO as $nombre => $css) { ?>
                    <!--Lo mismo que para el fondo pero con el texto -->
                    <option value="<?php echo htmlspecialchars($nombre); ?>"
                        <?php echo ($nombre === $colores["NOMBRETEXTO"]) ? "selected" : ""; ?>>
                        <?php echo htmlspecialchars($nombre); ?>
                    </option>
                <?php } ?>
            </select>
     

    
        <input type="submit" value="Guardar">
    </form>
<?php
}