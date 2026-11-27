<?php
// Cargo la cabecera.php con las constatnes de los colores y las funciones de guardarCookie() y coloresActuales().
include_once(dirname(__FILE__) . "/../../cabecera.php");

// ---------------------------- CONTROLADOR ----------------------------

//Barra de ubi
$barraUbi = [
    ["TEXTO" => "Inicio", "ENLACE" => "/index.php"],                                          
    ["TEXTO" => "LOGIN", "ENLACE" => "/aplicacion/acceso/login.php"]            
];

// ---------------------------- DIBUJO DE LA PÁGINA ----------------------------
inicioCabecera("LOGIN");   
cabecera();                       
finCabecera();                   
inicioCuerpo("Login", $barraUbi);
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
    <h2>LOGIN</h2>
    <hr>
    <form method="post" action="">

   
            <label for="usuario">Usuario:</label>   
            <input type="text" name="usu" id="usu" required>
            <br>
            <br>
            <label for="pass">Contraseña:</label>   
            <input name="pass" id="pass" type="password" required>

    
        <input type="submit" value="LOGIN">
    </form>
    
<?php
}