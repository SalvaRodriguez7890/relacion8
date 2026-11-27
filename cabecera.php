<?php 

define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO","desarrollo"); //en "produccion o en desarrollo


if (MODO_TRABAJO=="produccion"){
    error_reporting(0);
    date_default_timezone_set("Europe/Madrid");
}
    else 
        error_reporting(E_ALL);  

spl_autoload_register(function ($clase){
    $ruta=RUTABASE."/scripts/clases/";
    $fichero=$ruta."$clase.php";
    
    if (file_exists($fichero))
        {
            require_once($fichero);
        }
      else
        {
            throw new Exception("La clase $clase no se ha encontrado.");
        }
});
include(RUTABASE."/aplicacion/plantilla/plantilla.php");



//Le meto el archivo de la clase RegistroTexto
require_once(RUTABASE . "/aplicacion/clases/RegistroTexto.php");

//Incicio la sesión

session_start();

//creo la instancia del ACLArray que voy a llamar instACLArray
$insACLArray = new ACLArray(); 

//ahora tambien creo la instancia del acceso
$acceso = new Acceso();




// ============================================================================
// Variables colores de fondo y de texto en la cabecera, coo la cabecera se importa en todo
// estas variables también estarán
// ============================================================================

// Constante con los colores de FONDO posibles. 
const COLORESFONDO = [
    "Blanco"   => "white",              
    "Rojo"     => "red",                
    "Verde"    => "green",              
    "Amarillo" => "yellow",             
    "Azul"     => "blue",
    "Azul Claro"     => "lightblue",          
    "Gris"     => "rgb(200, 200, 200)"  // Gris con el RGB
];                                

// Constante con los colores de TEXTO posibles.
const COLORESTEXTO = [
    "Negro" => "black",                 
    "Azul"  => "blue",                 
    "Azul Claro" => "lightblue",
    "Blanco"=> "white",
    "Rojo"  => "red",                
    "RojoRGB"  => "rgb(253, 132, 132)",        //Creo un Rojo "RGB" distinto del otro, y le meto un poco de los demás colorores para que se diferencie 
                                            //cuando elegimos letras y fondo con este RGB 
    "Verde" => "darkgreen"              
];                                    

//Constantes para los colores por defecto nada mas abrir la pagina
const FONDO_POR_DEFECTO = "Blanco";
const  TEXTO_POR_DEFECTO = "Negro";  

// Duración de las cookies le meto 30 días en segundos (60 s * 60 min * 24 h * 30 días).
// Si no le metemos duración la cookie se borra al cerrar el navegador y queremos que se guarde
define("DURACION_COOKIE", 60 * 60 * 24 * 30);

// Creo aquí una una funcion para crear cookies a la que le pasamos el nombre y el valor, así le meto siempre el mismo tiempo y mismos parametros
// La centralizo aquí para no repetir las opciones en el contador y en el personalizador.
function guardarCookie(string $nombre, string $valor): void
{
    // Le meto la duración
    //el path es para que la cookie valga en todos los directorios y se vean en todas las paginas
    //el httponly es para que JS no la pueda ver
    //y el samesite es para que se envíe en peticiones cruzadas de otros sitios.
    setcookie($nombre, $valor, ["expires"  => time() + DURACION_COOKIE,"path"=> "/", "httponly" => true, "samesite" => "Lax"]);
}

// Devuelve los colores que hay que aplicar (los de la cookie o, si no hay/son inválidos, los de por defecto).
// Es una función porque la necesitan la plantilla (para pintar el <style>) y personalizar.php (para preseleccionar los combos).
function coloresActuales(): array
{
    $fondo = $_COOKIE["colorFondo"] ?? FONDO_POR_DEFECTO;  //Si no se a creado o no existe la cookie le meto el fondo por defecto que metimos en la variable
    $texto = $_COOKIE["colorTexto"] ?? TEXTO_POR_DEFECTO;  // Lo mismo con el color para las letras


    //Compruebo que el color que está en la cookie exista dentro del array y que sea un STRING, si no es asi le meto el valor
    //por defecto para evitar eerroes
    if (!is_string($fondo) || !array_key_exists($fondo, COLORESFONDO)) {
        $fondo = FONDO_POR_DEFECTO;   // El color esinválido le meto por defecto.
    }
    if (!is_string($texto) || !array_key_exists($texto, COLORESTEXTO)) {
        $texto = TEXTO_POR_DEFECTO;   // El color esinválido le meto por defecto.
    }

    //devuelvo un array con los colores, donde los nombre serán en español y los otros dos su equivalente en ingles o RGB
    return ["NOMBREFONDO" => $fondo, "NOMBRETEXTO" => $texto,"FONDO"=> COLORESFONDO[$fondo],  "TEXTO"=> COLORESTEXTO[$texto]];
}
