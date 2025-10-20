<?php
require_once 'config.php';

// Definir columnas válidas
$columns = [
    "no_empleado",
    "fecha_nacimiento",
    "nombre",
    "apellido",
    "fecha_ingreso"
];

$table = "empleados";

// Validar el campo de búsqueda
$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

// Construir la consulta base
$sql = "SELECT " . implode(", ", $columns) . " FROM $table";

// Si hay búsqueda, agregar condición
if ($campo != null && $campo != '') {
    $sql .= " WHERE nombre LIKE '%$campo%' OR apellido LIKE '%$campo%' OR no_empleado LIKE '%$campo%'";
}

// Ejecutar consulta
$resultado = $conn->query($sql);

$html = "";

// Verificar si hay resultados
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $html .= "<tr>";
        $html .= "<td>" . $row['no_empleado'] . "</td>";
        $html .= "<td>" . $row['nombre'] . "</td>";
        $html .= "<td>" . $row['apellido'] . "</td>";
        $html .= "<td>" . $row['fecha_nacimiento'] . "</td>";
        $html .= "<td>" . $row['fecha_ingreso'] . "</td>";
        $html .= "<td><a href='#'>Editar</a></td>";
        $html .= "<td><a href='#'>Eliminar</a></td>";
        $html .= "</tr>";
    }
} else {
    $html .= "<tr><td colspan='7'>No hay registros</td></tr>";
}

// Imprimir resultados
echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>