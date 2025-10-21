<?php
$conn = mysqli_connect("localhost", "root", "", "almacen", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "✅ Conectado correctamente (puerto 3307)";
