<?php
require_once 'config.php';

$column = [
    "no_emp",
    "fecha_nacimiento",
    "nombre",
    "apellido",
    "fecha_ingreso"
];

$table = "empleados";
$campo = isset($_POST['campo']) ? ($_POST['campo']) : null;

$sql = "SELECT " . implode(", ", $column) . " FROM $table";
$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;

$html = "";

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $html .= "<tr>";
        $html .= "<td>" . $row['no_emp'] . "</td>";
        $html .= "<td>" . $row['fecha_nacimiento'] . "</td>";
        $html .= "<td>" . $row['nombre'] . "</td>";
        $html .= "<td>" . $row['apellido'] . "</td>";
        $html .= "<td>" . $row['fecha_ingreso'] . "</td>";
        $html .= "<td><a href='#'>Editar</a></td>";
        $html .= "<td><a href='#'>Eliminar</a></td>";
        $html .= "</tr>";
    }
} else {
    $html .= "<tr>";
    $html .= "<td colspan='7'>No hay registros</td>";
    $html .= "</tr>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>