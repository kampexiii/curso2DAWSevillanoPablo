<?php 

class Persona {
    private $DNI;
    private $nombre;
    private $apellido;

    // Constructor
    public function __construct($DNI, $nombre, $apellido) {
        $this->DNI      = $DNI;
        $this->nombre   = $nombre;
        $this->apellido = $apellido;
    }

    // --- Getters ---
    public function getDNI() {
        return $this->DNI;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    // --- Setters ---
    public function setDNI($DNI) {
        $this->DNI = $DNI;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    // --- Método mágico __toString ---
    public function __toString() {
        return "Persona: " . $this->DNI . " - " . $this->nombre . " " . $this->apellido;
    }

    // --- Método para mostrar en HTML ---
    public function mostrarHTML() {
        return "
        <ul>
            <li><strong>DNI:</strong> {$this->DNI}</li>
            <li><strong>Nombre:</strong> {$this->nombre}</li>
            <li><strong>Apellido:</strong> {$this->apellido}</li>
        </ul>";
    }
}

// ----------------------
// Ejemplo de uso
// ----------------------
$persona1 = new Persona("12345678A", "Pablo", "Sevillano");

// Usando __toString()
echo $persona1;   
// Salida: Persona: 12345678A - Pablo Sevillano

echo "<hr>";

// Usando mostrarHTML()
echo $persona1->mostrarHTML();
// Salida en lista HTML con DNI, Nombre y Apellido

?>
