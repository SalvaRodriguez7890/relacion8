<?php
include_once(dirname(__FILE__) . "/../../scripts/librerias/validacion.php");

class RegistroTexto {

    private DateTime $_fecha;
    private string $_cadena;

    /** 
     * Constructor 
     */
    public function __construct(string $cadena) {
    
    //declaro la cadena
    $this->_cadena = $cadena;
      
    //la hora la declaro 
    $this->_fecha = new DateTime();


    }


    /**
     * Métodos get
     */


    public function getFecha(): DateTime {

        return $this->_fecha;

    }

    public function getCadena(): string {

        return $this->_cadena;

    }


 }