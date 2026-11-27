<?php
// Cargo la cabecera.php con las constatnes de los colores y las funciones de guardarCookie() y coloresActuales().
include_once(dirname(__FILE__) . "/../../cabecera.php");

// ---------------------------- CONTROLADOR ----------------------------

// Leemos el contador anterior de la cookie "visitas". Si no existe (porque es la primera vez) usamos 0.
//le meto un "int" por si acaso para forzara que sea número, la cookie siempre llega como texto
$visitas = (int)($_COOKIE["visitas"] ?? 0);

//Ahora sea 0 o tenga ya un valor la aumento en 1 mas
$visitas++;

// Guardo el nuevo lo primero de todo usando otra vez mi funcion de guardaCookie
// (string)porque guardarCookie() espera texto.
guardarCookie("visitas", (string)$visitas);

//Barra de ubi
$barraUbi = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],                                          
    ["TEXTO" => "Personalizar", "ENLACE" => "/aplicacion/personalizar/index.php"]            
];

// ---------------------------- DIBUJO DE LA PÁGINA ----------------------------
inicioCabecera("PERSONALIZAR");   
cabecera();                       
finCabecera();                   
inicioCuerpo("Personalizar", $barraUbi);
cuerpo($visitas);               
finCuerpo();                      

// ---------------------------- VISTA ----------------------------
//funcion cabecera
function cabecera() {
}

//Funcion cuerpo
function cuerpo(int $visitas)
{
?>
    <h2>Información de la página</h2>
   
    <p>Esta página se muestra con los colores que hayas elegido en la sección de personalización.</p>
    <p>La cookie se ha puesto a 30 dias, por lo que hasta dentro de 30 dias sin cambiar de color no se va a borrar.</p>

    <!-- Contador de veces que he entrado -->
    <p><strong>Has accedido a esta página <?php echo $visitas; ?> <?php echo ($visitas === 1) ? "vez" : "veces"; ?>.</strong></p>
    <!-- Le pongo el ? para saber si es 1 y poner vez y si no es 1 pues ya es plura veces -->

    <!-- Enlace de los colores -->
    <p><a href="/aplicacion/personalizar/personalizar.php">Cambiar los colores</a></p>
<?php
}