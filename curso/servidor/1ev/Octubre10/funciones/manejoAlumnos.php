<?php
// carpeta donde guardo los txt
define("CARPETA_FICHAS", "fichasAlumnos");

// creo carpeta si no existe
if(!is_dir(CARPETA_FICHAS)) mkdir(CARPETA_FICHAS);

// guardar datos del alumno (ahora con SW y HW separados)
function guardaAlumno($nomComp, $dir, $tel, $exp1, $exp2, $sw, $hw) {
    $file = CARPETA_FICHAS . "/" . str_replace(" ", "_", $nomComp) . ".txt";

    // si no existe, cabecera inicial
    if(!file_exists($file)) file_put_contents($file, "=== FICHA DEL ALUMNO ===\n");

    $datos = "Nombre: $nomComp\n";
    $datos .= "Dir: $dir\n";
    $datos .= "Tel: $tel\n";
    $datos .= "Exp1: $exp1\n";
    $datos .= "Exp2: $exp2\n";
    $datos .= "SW: $sw\n";
    $datos .= "HW: $hw\n";
    $datos .= "--------------------\n";

    file_put_contents($file, $datos, FILE_APPEND);

    return $file; // devuelvo nombre
}

// leer archivo y mostrar
function leeArchivo($file) {
    if(!file_exists($file)){
        echo "no encontré el archivo ";
        return;
    }

    $lineas = file($file);
    echo "<pre>";
    foreach($lineas as $l) echo htmlspecialchars($l);
    echo "</pre>";
}

// validar txt
function esTxt($f){
    return $f['type'] === 'text/plain';
}
?>
