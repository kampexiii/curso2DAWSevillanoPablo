<!--Ejemplo para evitar vulnerabilidades... usando la BD del ejercicio 1 -->
<?php
session_start();

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Pillamos la BD activa de la sesion... igual que en el ejercicio 1
    $dbActiva = $_SESSION['db_activa'] ?? null;
    if (!$dbActiva) {
        throw new mysqli_sql_exception(
            "No hay BD activa en sesión. Ve a ejercicio1/menu.php y pulsa 'Crear BD' y 'Conectar'."
        );
    }

    // Conectamos a la BD...
    $mysqli = new mysqli("localhost", "root", "", $dbActiva);

    // Imaginamos que viene de un form... ?nombre=...
    $nombre = $_GET['nombre'] ?? '';

    // Consulta segura a la tabla producto...
    $stmt = $mysqli->prepare("SELECT * FROM producto WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();

    $resultado = $stmt->get_result();
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila['id'] . " - ";
        echo "Nombre: " . htmlspecialchars($fila['nombre']) . " - ";
        echo "Precio: " . number_format((float)$fila['precio'], 2) . " € - ";
        echo "Stock: " . (int)$fila['cant'] . "<br>";
    }

    $stmt->close();
    $mysqli->close();
} catch (mysqli_sql_exception $e) {
    echo "Error ……….: " . $e->getMessage();
}
?>