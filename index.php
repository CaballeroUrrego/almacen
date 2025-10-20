<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen</title>

    <link rel="stylesheet" href="css/styles.css">
</head>

<body>



    <h2>Empleados</h2>

    <form action="" method="post">
        <label for="campo">Buscar:</label>
        <input type="text" name="campo" id="campo">



    </form>

    <p>
    </p>


    <table>
        <thead>
            <th>Num.empleado</th>

            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha nacimiento</th>
            <th>Fecha ingreso</th>
            <th></th>
            <th></th>



        </thead>
        <tbody id="content">

        </tbody>
    </table>


    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Almacén</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>

        <h2>Empleados</h2>

        <form id="formulario" method="post">
            <label for="campo">Buscar:</label>
            <input type="text" name="campo" id="campo" placeholder="Ingrese nombre o número de empleado">
        </form>

        <table>
            <thead>
                <tr>
                    <th>Num. empleado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha nacimiento</th>
                    <th>Fecha ingreso</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="content"></tbody>
        </table>

        <!-- Aquí enlazamos el JavaScript -->
        <script src="js/script.js"></script>

    </body>

    </html>

</body>

</html>