<?php
require_once 'config.php';
$column = [
    "no_empleado ",
    "fecha_nacimiento",
    "nombre",
    "apellido",
    "fecha_ingreso"
];

$table = "empleados";
$campo = isset($_['campo']) ? $conn->real_escape_string($_POST['campo']) : null;