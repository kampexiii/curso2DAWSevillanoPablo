<?php
include 'funciones/manejoAlumnos.php';

$msg = "";
$archAlumno = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nomComp = $_POST['nombreCompleto'] ?? '';
    $dir = $_POST['direccion'] ?? '';
    $tel = $_POST['telefono'] ?? '';
    $exp1 = $_POST['exp1'] ?? '';
    $exp2 = $_POST['exp2'] ?? '';
    $sw = $_POST['sw'] ?? '';
    $hw = $_POST['hw'] ?? '';

    if($nomComp){
        $archAlumno = guardaAlumno($nomComp,$dir,$tel,$exp1,$exp2,$sw,$hw);
        $msg = "datos guardados en $archAlumno 😉";
    }

    // subir archivo
    if(isset($_FILES['archivoTxt']) && $_FILES['archivoTxt']['name']){
        if(esTxt($_FILES['archivoTxt'])){
            if(!is_dir('uploads')) mkdir('uploads'); 
            $dest = "uploads/".basename($_FILES['archivoTxt']['name']);
            move_uploaded_file($_FILES['archivoTxt']['tmp_name'],$dest);
            $msg .= "<br>txt subido: $dest 👍";
        } else $msg .= "<br>solo txt man ⚠️";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Formulario Alumno</title>
<link rel="stylesheet" href="resources/css/estilo.css">
</head>
<body>

<h2>Formulario Alumno</h2>

<form method="post" enctype="multipart/form-data">
    Nombre completo: <input type="text" name="nombreCompleto" required><br>
    Dirección: <input type="text" name="direccion"><br>
    Teléfono: <input type="text" name="telefono"><br>
    Experiencia 1ª: <input type="text" name="exp1"><br>
    Experiencia 2ª: <input type="text" name="exp2"><br>

    <b>Habilidades Software:</b><br>
    <input type="radio" name="sw" value="PHP"> PHP<br>
    <input type="radio" name="sw" value="JS"> JS<br>
    <input type="radio" name="sw" value="HTML/CSS"> HTML/CSS<br>
    <input type="radio" name="sw" value="Python"> Python<br>
    <input type="radio" name="sw" value="Java"> Java<br>

    <b>Habilidades Hardware:</b><br>
    <input type="radio" name="hw" value="Arduino"> Arduino<br>
    <input type="radio" name="hw" value="Raspberry Pi"> Raspberry Pi<br>
    <input type="radio" name="hw" value="Microcontroladores"> Microcontroladores<br>
    <input type="radio" name="hw" value="Sensores"> Sensores<br>
    <input type="radio" name="hw" value="FPGA"> FPGA<br>

    Subir txt: <input type="file" name="archivoTxt"><br>
    <input type="submit" value="Enviar">
</form>

<p><?php echo $msg; ?></p>

<?php
if($archAlumno){
    echo "<h3>Contenido guardado:</h3>";
    leeArchivo($archAlumno);
}
?>

</body>
</html>
