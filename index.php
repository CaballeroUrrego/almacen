<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacén de Empleados</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <h2>Gestión de Empleados</h2>

    <div class="search-container">
        <label for="campo">Buscar Empleado:</label>
        <input type="text" name="campo" id="campo" onkeyup="getData()">
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Num. empleado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha nacimiento</th>
                    <th>Fecha ingreso</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody id="content">
            </tbody>
        </table>
    </div>

    <script>
        /**
         * Realiza una solicitud POST a load.php para obtener los datos de empleados.
         * Se activa con cada tecleo en el campo de búsqueda y al cargar la página.
         */
        const getData = () => {
            const input = document.getElementById("campo").value;
            const content = document.getElementById("content");
            const url = "load.php";

            // Usamos FormData para enviar el campo de búsqueda como POST
            const formData = new FormData();
            formData.append('campo', input);

            fetch(url, {
                    method: "POST",
                    body: formData
                })
                // 1. Manejar la respuesta. Esperamos TEXTO (HTML) de PHP.
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error HTTP: ${response.status}`);
                    }
                    return response.text();
                })
                // 2. Insertar el HTML devuelto por PHP en el cuerpo de la tabla
                .then(data => {
                    content.innerHTML = data;
                })
                // 3. Capturar y notificar cualquier error de la conexión o del servidor
                .catch(err => {
                    console.error("Error al cargar los datos:", err);
                    content.innerHTML = `<tr><td colspan="7">Error al cargar datos: ${err.message}</td></tr>`;
                });
        }

        // Cargar los datos de los empleados automáticamente al inicio de la página
        getData();
    </script>

</body>

</html>