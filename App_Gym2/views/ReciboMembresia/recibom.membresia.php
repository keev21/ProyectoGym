<?php
$cli_id = $_POST['cli_id'];
$men_id = $_POST['men_id'];
$men_fecha_inicio = $_POST['men_fecha_inicio'];
$men_fecha_fin = $_POST['men_fecha_fin'];
$estado = $_POST['estado'];

// Verificar si $estado es igual a "Activo"
if ($estado === "Activo") {
    $mysqli = new mysqli("localhost", "root", "", "db_gym_dos");

    if ($mysqli->connect_error) {
        die("Error en la conexión: " . $mysqli->connect_error);
    }

    // Sentencia preparada para evitar inyección SQL
    $stmt = $mysqli->prepare("INSERT INTO `membresia`(`cliente_id`, `tipo_id`, `men_fecha_inicio`, `men_fecha_fin`, `men_estado`) VALUES (?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    // Vincular los parámetros
    $stmt->bind_param("iisss", $cli_id, $men_id, $men_fecha_inicio, $men_fecha_fin, $estado);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "El registro se ha insertado correctamente.";
    } else {
        echo "Error al insertar el registro: " . $stmt->error;
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $mysqli->close();
} else {
    echo "La inserción solo se realizará si el estado es 'Activo'.";
}
?>






