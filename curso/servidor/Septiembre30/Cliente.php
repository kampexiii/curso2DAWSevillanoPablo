<?php
require_once "Persona.php";  // Importa la clase Persona

class Cliente extends Persona {
    private $saldo = 0;

    // Constructor
    public function __construct($DNI, $nombre, $apellido, $saldo) {
        // Llamada al constructor de la clase padre (Persona)
        parent::__construct($DNI, $nombre, $apellido);
        $this->saldo = $saldo;
    }

    // --- Getter ---
    public function getSaldo() {
        return $this->saldo;
    }

    // --- Setter ---
    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    // --- Método mágico __toString ---
    public function __toString() {
        return "Cliente: " . $this->getNombre() . " " . $this->getApellido() . 
               " | DNI: " . $this->getDNI() . 
               " | Saldo: " . $this->saldo . " €";
    }
}
?>
