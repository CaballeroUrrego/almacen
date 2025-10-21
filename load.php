<?php


require_once 'config.php'; // Asume que $conn es una instancia de mysqli

// Columnas a mostrar
$columns = [
    "no_emp",
    "nombre",
    "apellido",
    "fecha_nacimiento",
    "fecha_ingreso"
];

$table = "empleados";
// Obtener el campo de búsqueda. Ya NO se usa real_escape_string() aquí.
$campo = isset($_POST['campo']) ? $_POST['campo'] : '';

$html = "";
$bindParams = [];
$bindTypes = '';

// 1. Construcción de la consulta SQL con marcadores de posición (?)
$sql = "SELECT " . implode(", ", $columns) . " FROM $table";

// Si hay búsqueda, preparar la cláusula WHERE de forma segura
if (!empty($campo)) {
    // Usamos marcadores de posición (?) en la consulta
    $sql .= " WHERE nombre LIKE ? OR apellido LIKE ? OR no_emp LIKE ?";

    // Preparamos el valor de búsqueda para bind_param
    $param = "%" . $campo . "%";

    // Configuramos los parámetros: 'sss' significa tres cadenas (strings)
    $bindParams = [$param, $param, $param];
    $bindTypes = 'sss';
}

// 2. Preparación de la sentencia
if ($stmt = $conn->prepare($sql)) {

    // 3. Vinculación de parámetros (si existen)
    if (!empty($bindParams)) {
        // Necesario para pasar un array de referencias a bind_param
        $a_params = array();
        $a_params[] = &$bindTypes;
        for ($i = 0; $i < count($bindParams); $i++) {
            $a_params[] = &$bindParams[$i];
        }
        call_user_func_array(array($stmt, 'bind_param'), $a_params);
    }

    // 4. Ejecución de la sentencia
    $stmt->execute();
    $resultado = $stmt->get_result(); // Obtener el resultado de la ejecución

    // 5. Generación segura del HTML
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $html .= "<tr>";
            // Usamos htmlspecialchars() para prevenir XSS al mostrar los datos
            $html .= "<td>" . htmlspecialchars($row['no_emp']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['nombre']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['apellido']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['fecha_nacimiento']) . "</td>";
            $html .= "<td>" . htmlspecialchars($row['fecha_ingreso']) . "</td>";

            // Enlaces de acción (usa el no_emp en la URL)
            $html .= "<td><a href='editar.php?id=" . urlencode($row['no_emp']) . "'>Editar</a></td>";
            $html .= "<td><a href='eliminar.php?id=" . urlencode($row['no_emp']) . "'>Eliminar</a></td>";
            $html .= "</tr>";
        }
    } else {
        $html .= "<tr><td colspan='7'>No se encontraron registros.</td></tr>";
    }

    $stmt->close();
} else {
    // Manejo de errores en la preparación (útil para depuración)
    $html .= "<tr><td colspan='7'>Error al preparar la consulta.</td></tr>";
}

// 6. Devolver el resultado
// Ya que en tu HTML corregido usamos response.text(), devolvemos la cadena HTML directamente.
echo $html;
// ANTES (incorrecto para tu JS corregido): echo json_encode($html, JSON_UNESCAPED_UNICODE);
